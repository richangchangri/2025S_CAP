<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class OtpModel extends Model{
    protected $table = 'AuthenticationUsers';    
    protected $primaryKey = 'id';
    protected $allowedFields = ['email','otp_code','expired_at'];
}