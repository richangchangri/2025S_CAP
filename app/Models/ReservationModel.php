<?php 

namespace App\Models;

use CodeIgniter\Model;
 
class ReservationModel extends Model{
    protected $table = 'Reservations';    
    protected $primaryKey = 'reservation_id';
    protected $allowedFields = ['user_id','facility_id','start_time','end_time','status','purpose','created_at'];

    public function getByFacilityApprove($facilityCode)
    {
        return $this->select('Reservations.*, Facilities.name as facility_name, Facilities.location')
                    ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id')
                    ->where('Facilities.facility_code', $facilityCode)
                    ->where('Reservations.status', 'Approved')
                    ->where('DATE(Reservations.start_time)', date('Y-m-d'))
                    ->orWhere('DATE(Reservations.end_time)', date('Y-m-d'))
                    ->findAll();
    }

}