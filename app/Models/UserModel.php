<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'Users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['name','email','department_id','password','role','phone_number','status','created_at','updated_at'];


}