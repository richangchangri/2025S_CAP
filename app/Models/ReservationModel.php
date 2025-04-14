<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class ReservationModel extends Model{
    protected $table = 'Reservations';    
    protected $primaryKey = 'reservation_id';
    protected $allowedFields = ['user_id','facility_id','start_time','end_time','status','purpose','created_at'];
}