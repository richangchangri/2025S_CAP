<?php

namespace App\Models;

use CodeIgniter\Model;

class UserRoleModel extends Model
{
    protected $table = 'user_role';
    protected $primaryKey = 'user_role_id';
    protected $allowedFields = ['user_role_id','user_role_name'];
}
