<?php

namespace App\Controllers;

use App\Models\CategoryModel;


class CategoryController extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->session = \Config\Services::session();
    }
    public function index()
    {
        $data = array();
        $data['title'] = "Category";

        $model = new CategoryModel();
        $data['category'] = $model->findAll();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = array(
                    'name' => $this->request->getVar('name'),
                );

                if ($model->insert($newData)) {
                    $message = ['class' => 'primary mt-3', 'message' => 'Category insert successfully'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/category');
                } else {
                    $message = ['class' => 'danger mt-3', 'message' => 'Category not inserted'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/category');
                }
            }
        }

        return view('/category', $data);
    }


    public function editcategory($id)
    {
        $data = array();
        $model = new CategoryModel();
        $data['title'] = " Edit Category";
        $data['category'] = $model->findAll();
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'name' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $newData = array(
                    'name' => $this->request->getVar('name'),
                );
                if ($model->update($id, $newData)) {
                    $message = ['class' => 'primary mt-3', 'message' => 'Category updated successfully'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/category');
                } else {
                    $message = ['class' => 'danger mt-3', 'message' => 'Category not updated'];
                    $this->session->setFlashdata('Flash_message', $message);
                    return redirect()->to('/category');
                }
            }
        }

        $data['editcategory'] = $model->where('id', $id)->first();

        return view('category', $data);
    }

    public function deletecategory($id)
    {
        $model = new CategoryModel();
        if ($model->where('id', $id)->delete()) {
            $message = ['class' => 'primary mt-3', 'message' => 'Category deleted successfully'];
            $this->session->setFlashdata('Flash_message', $message);
            return redirect()->to('/category');
        } else {
            $message = ['class' => 'danger mt-3', 'message' => 'Category not deleted '];
            $this->session->setFlashdata('Flash_message', $message);
            return redirect()->to('/category');
        }
    }
}
