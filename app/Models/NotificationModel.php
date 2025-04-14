<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class NotificationModel extends Model{
    protected $table = 'Notifications';
    protected $allowedFields = ['user_id','reservation_id','message','type','sent_at','is_read'];
}