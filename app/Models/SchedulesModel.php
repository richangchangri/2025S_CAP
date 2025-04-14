<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class SchedulesModel extends Model{
    protected $table = 'Schedules';
    protected $primaryKey = 'schedule_id';
    protected $allowedFields = ['reservation_id','status'];
}