<?php

namespace App\Controllers;

use App\Models\UsersModel;

class UserController extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $data = array();
        $data['title'] = "Dashboard";

        return view('/dashboard', $data);
    }

    public function users()
    {
        $model = new UsersModel();
        $data = [];
        $data['title'] = "Users";
        $data['users'] = $model->findAll();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required',
                'email' => 'required|valid_email',
                'mobile_no'    => 'required|min_length[10]|max_length[10]',
                'password'    => 'required|min_length[6]',
                'city' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = array(
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'mobile_no' => $this->request->getVar('mobile_no'),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'city' => $this->request->getVar('city'),

                );

                if ($model->insert($newData)) {
                    $message = ['class' => 'primary mt-3', 'message' => 'user insert successfully'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/users');
                } else {
                    $message = ['class' => 'danger mt-3', 'message' => 'user not inserted'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/users');
                }
            }
        }

        return view('users', $data);
    }

    public function deleteuser($id)
    {
        $model = new UsersModel();
        if ($model->where('id', $id)->delete()) {
            $message = ['class' => 'primary mt-3', 'message' => 'user deleted successfully'];
            $this->session->setFlashdata('Flash_message', $message);
            return redirect()->to('/users');
        } else {
            $message = ['class' => 'danger mt-3', 'message' => 'user not deleted '];
            $this->session->setFlashdata('Flash_message', $message);
            return redirect()->to('/users');
        }
    }


    public function edituser($id)
    {
        $data = array();
        $model = new UsersModel();
        $data['title'] = " Edit     Users";
        $data['users'] = $model->findAll();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'username' => 'required',
                'email' => 'required|valid_email',
                'mobile_no'    => 'required|min_length[10]|max_length[10]',
                // 'password'    => 'required|min_length[6]|max_length[6]',
                'city' => 'required',

            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = array(
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'mobile_no' => $this->request->getVar('mobile_no'),
                    // 'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'city' => $this->request->getVar('city'),

                );
                if ($model->update($id, $newData)) {
                    $message = ['class' => 'primary mt-3', 'message' => 'user updated successfully'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/users');
                } else {
                    $message = ['class' => 'danger mt-3', 'message' => 'user not updated'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/users');
                }
            }
        }

        $data['edituser'] = $model->where('id', $id)->first();

        return view('users', $data);
    }


    public function change_password()
    {
        $data = array();
        $data['title'] = 'Change Password';
        $model = new UsersModel();
        $id = session()->get('id');
        $rules = [
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|matches[password]',
        ];
        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $old_password = $this->request->getVar('old_password');
                $password = $this->request->getVar('password');
                $new = password_hash($password, PASSWORD_DEFAULT);

                if (password_verify($old_password, session()->get('password'))) {
                    $newData = array(
                        'password' => $new
                    );
                    if ($model->update($id, $newData)) {
                        session()->set('password', $new);
                        $message = ['class' => 'primary mt-3', 'message' => 'user not updated'];
                        $this->session->setFlashdata('Flash_message', $message);
                        $this->session->setFlashdata('Flash_message', 'user password updated successfully');
                        return redirect()->to('/change_password');
                    } else {
                        $message = ['class' => 'danger mt-3', 'message' => 'some problem accured'];
                        $this->session->setFlashdata('Flash_message', $message);
                        return redirect()->to('/change_password');
                    }
                } else {
                    $message = ['class' => 'danger mt-3', 'message' => 'old password not carrect'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/change_password');
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('change_password', $data);
    }


    public function logout()
    {
        // $logout = session()->destroy();
        // return redirect()->to("/");
        session()->remove('isLoggedIn');
        $message = ['class' => 'danger mt-3', 'message' => 'Logout successfully'];
        $this->session->setFlashdata('Flash_message', $message);
        return redirect()->to("/");
    }
}
