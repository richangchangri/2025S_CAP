<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityModel extends Model
{
    protected $table = 'Notifications';
    protected $primaryKey = 'notification_id';
    protected $allowedFields = ['user_id','reservation_id','message','type','sent_at','is_read'];
}
