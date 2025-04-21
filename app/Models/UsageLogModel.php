<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class UsageLogModel extends Model{
    protected $table = 'UsageLogs';
    protected $primaryKey = 'log_id';
    protected $allowedFields = ['facility_id','user_id','check_in_time','check_out_time','actual_usage'];


}