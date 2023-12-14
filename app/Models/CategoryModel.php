<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $allowedFields = ['id', 'name', 'created_at', 'updated_at'];
    protected $primarykey = 'id';
}
    