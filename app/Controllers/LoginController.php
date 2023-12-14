<?php

namespace App\Controllers;

use App\Models\UsersModel;

class LoginController extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email'    => 'required|valid_email',
                'password'    => 'required|min_length[6]|max_length[6]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UsersModel();
                $admin = $model->where('email', $this->request->getVar('email'))
                    ->first();
                if ($admin == true) {
                    if (password_verify($this->request->getVar('password'), $admin['password'])) {
                        $this->setUserSession($admin);
                        $message = ['class' => 'primary mt-3', 'message' => 'loging successfully'];
                        $this->session->setFlashdata('Flash_message', $message);
                        return redirect()->to('/dashboard');
                    } else {
                        $message = ['class' => 'danger mt-3', 'message' => 'Enter Correct  password'];
                        $this->session->setFlashdata('Flash_message', $message);
                        return redirect()->to('/');
                    }
                } else {
                    $this->session->setFlashdata('Flash_message', 'Enter Correct mail address');
                    return redirect()->to('/');
                }
            }
        }
        return view('login', $data);
    }

    private function setUserSession($admin)
    {
        $data = [
            'id' => $admin['id'],
            'username' => $admin['username'],
            'mobile_no' => $admin['mobile_no'],
            'email' => $admin['email'],
            'password' => $admin['password'],
            'isLoggedIn' => true,
        ];
        session()->set($data);
        return true;
    }
}
