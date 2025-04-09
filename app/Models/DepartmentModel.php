<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'Department';
    protected $primaryKey = 'department_id';
    protected $allowedFields = ['department_id','department_name'];
}
