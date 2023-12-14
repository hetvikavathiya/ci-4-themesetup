<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = ['id', 'username', 'email', 'password', 'mobile_no', 'city', 'created_at', 'updated_at'];
    protected $primarykey = 'id';

    // protected function  passwordHash(array $data)
    // {
    //     if (isset($data['data']['password']))
    //         $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
    //     return $data;
    // }
}
