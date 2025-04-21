<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;
use App\Models\BuildingModel;
use App\Models\FacilityModel;
use App\Models\FeedbackModel;
use App\Models\ApprovalsModel;
use App\Models\ActivityModel;
use App\Models\FacilitiesTypeModel;
use App\Models\ReservationModel;
use App\Models\SchedulesModel;

class Data extends Controller
{

    //Get Data Dashboard
    public function dashboardSummary(){
        // Facility data
        $facilityModel = new FacilityModel();
        $usedCount = $facilityModel->where('status', 'used')->countAllResults();
        $availableCount = $facilityModel->where('status', 'available')->countAllResults();
        $totalFacility = $facilityModel->countAll();

        // User data
        $userModel = new UserModel();
        $activeUser = $userModel->where('status', 'active')->countAllResults();
        $inactiveUser = $userModel->where('status', 'inactive')->countAllResults();
        $totalUser = $userModel->countAll();

        // Feedback data
        $feedbackModel = new FeedbackModel();
        $feedbackThisWeek = $feedbackModel
            ->where('submitted_at >=', date('Y-m-d', strtotime('-7 days')))
            ->countAllResults();
        $feedbackTotal = $feedbackModel->countAll();

        // New user approvals
        $approvalModel = new ApprovalsModel();
        $pending = $approvalModel->where('decision', 'Pending')->countAllResults();
        $approved = $approvalModel->where('decision', 'Approved')->countAllResults();
        $rejected = $approvalModel->where('decision', 'Rejected')->countAllResults();

        // Recent activities (last 4)
        $activityModel = new ActivityModel();
        $activities = $activityModel->select('Notifications.user_id, Notifications.reservation_id, Notifications.message, Notifications.type, Notifications.sent_at,Notifications.is_read,Users.name, Users.email')
            ->join('Users', 'Notifications.user_id = Users.user_id','left')
            ->orderBy('Notifications.sent_at', 'DESC')
            ->findAll(4);
       
        foreach ($activities as &$activity) {
            $activity['gravatar_url'] = get_gravatar($activity['email'], 200);
        }
        unset($activity); // good practice after reference foreach

        $lastUsers = $userModel->select('Users.user_id, Users.name, Users.email, Users.role, Department.department_name,Users.created_at')
        ->join('Department', 'Department.department_id = Users.department_id','left')
        ->orderBy('Users.created_at', 'DESC')
        ->findAll(4);

        foreach ($lastUsers as &$lastUser) {
            $lastUser['gravatar_url'] = get_gravatar($lastUser['email'], 200);
        }
        unset($lastUser); // good practice after reference foreach

        return $this->response->setJSON([
            'facilities' => [
                'used' => $usedCount,
                'available' => $availableCount,
                'total' => $totalFacility,
            ],
            'users' => [
                'active' => $activeUser,
                'inactive' => $inactiveUser,
                'total' => $totalUser,
            ],
            'feedback' => [
                'this_week' => $feedbackThisWeek,
                'total' => $feedbackTotal,
            ],
            'approvals' => [
                'pending' => $pending,
                'approved' => $approved,
                'rejected' => $rejected,
            ],
            'activities' => $activities,           
            'lastUsers' => $lastUsers
        ]);
    }
    
    //Get Data User
    public function userManagement() {
        $userModel = new UserModel();
        $db = \Config\Database::connect(); 
        $status = $this->request->getUri()->getSegment(3); 
        if ($status === "active") {
            $statusFilter = "active";
        } elseif ($status === "inactive") {
            $statusFilter = "inactive";
        } else {
            $statusFilter = "pending";
        }
    
        // Query builder with filter status
        $userModel->select('Users.user_id, Users.name, Users.email, Department.department_name, Users.phone_number, Users.created_at')
            ->join('Department', 'Department.department_id = Users.department_id','left')
            ->where('Users.status', $statusFilter)
            ->orderBy('Users.name', 'ASC');
    
        // show query for debugging
        // echo $db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($userModel)->toJson();
    }

    public function building() {

        $buildingModel = new BuildingModel();
        $status = $this->request->getUri()->getSegment(3); 
        if ($status === "available") {
            $statusFilter = "available";
        } elseif ($status === "maintenance") {
            $statusFilter = "under maintenance";
        } else {
            $statusFilter = null;
        }
        // echo "statusFilter: ".  $statusFilter;
        // Query builder with filter status
        $builder = $buildingModel->select('Buildings.building_id, Buildings.name, Buildings.address, Buildings.floors, Buildings.contact_person');
    
        // If there is a filter status, add it.
        if ($statusFilter !== null) {
            $builder->where('status', $statusFilter);
        }

        $builder->orderBy('name', 'ASC');

        // show query for debugging
        // echo $buildingModel->db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($buildingModel)->toJson();
    }

    public function building_detail($buildingId, $status)
    {
        $buildingModel = new BuildingModel();    
      
        // Determine the filter status
        if ($status === "available") {
            $statusFilter = "available";
        } elseif ($status === "maintenance") {
            $statusFilter = "under maintenance";
        } else {
            $statusFilter = null; // semua data
        }
        
        // Use Query Builder
        $builder = $buildingModel->select('Facilities.facility_id, Facilities.name, Facilities.description, Facilities.capacity, Facilities.location, Facilities.status, Buildings.name as buildings_name, Facilities.status')
                        ->join('Facilities', 'Facilities.building_id = Buildings.building_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->where('Facilities.status', $statusFilter)
                        ->where('Buildings.building_id', $buildingId);
    
        $builder->orderBy('name', 'ASC');    
        // Show SQL query for debugging (optional)
        // $results = $builder->get()->getResult();
        // echo $builder->getLastQuery();   
    
        // Return in DataTables JSON format
        return DataTable::of($builder)->toJson();
    }

    //Get Data Summary User
    public function userSummary(){
        // User data
        $userModel = new UserModel();
        $active = $userModel->where('status', 'active')->countAllResults();
        $inactive = $userModel->where('status', 'inactive')->countAllResults();
        $pending = $userModel->where('status', 'pending')->countAllResults();
        $total = $userModel->countAll();
        return $this->response->setJSON([
            'active' => $active,
            'inactive' => $inactive,  
            'pending' => $pending,          
            'total' => $total
        ]);
    }

    //Get Data Summary Building
    public function buildingSummary(){
        // Building data
        $buildingModel = new BuildingModel();
        $available = $buildingModel->where('status', 'available')->countAllResults();
        $maintenance = $buildingModel->where('status', 'under maintenance')->countAllResults();
        $total = $buildingModel->countAll();
        return $this->response->setJSON([
            'available' => $available,       
            'maintenance' => $maintenance,    
            'total' => $total
        ]);
    }

    //Get Data Summary Building Detail
    public function buildingDetailSummary($buildingId){
        // Facility data
        $facilityModel = new FacilityModel();
        $maintenance = $facilityModel->where('status', 'under maintenance')->where('building_id', $buildingId)->countAllResults();
        $available = $facilityModel->where('status', 'available')->where('building_id', $buildingId)->countAllResults();
        $total = $facilityModel->where('building_id', $buildingId)->countAllResults();
        return $this->response->setJSON([
            'maintenance' => $maintenance,
            'available' => $available,           
            'total' => $total
        ]);
    }

    //Get Data Summary Facilities
    public function facilitySummary(){
        // Facility data
        $facilityModel = new FacilityModel();
        $maintenance = $facilityModel->where('status', 'under maintenance')->countAllResults();
        $available = $facilityModel->where('status', 'available')->countAllResults();
        $total = $facilityModel->countAll();
        return $this->response->setJSON([
            'maintenance' => $maintenance,
            'available' => $available,           
            'total' => $total
        ]);
    }

    public function facility()
    {
        $facilityModel = new FacilityModel();
        $status = $this->request->getUri()->getSegment(3);   
    
      
            // Determine the filter status
            if ($status === "available") {
                $statusFilter = "available";
            } elseif ($status === "maintenance") {
                $statusFilter = "under maintenance";
            } else {
                $statusFilter = null; // semua data
            }
        
            // Use Query Builder
            $builder = $facilityModel->select('Facilities.facility_id, Facilities.name, Facilities.description, Facilities.capacity, Facilities.location, Facilities.status, Buildings.name as buildings_name')
                                    ->join('Buildings', 'Buildings.building_id = Facilities.building_id','left');
        
            // If there is a filter status, add it.
            if ($statusFilter !== null) {
                $builder->where('Facilities.status', $statusFilter);
            }
        
            $builder->orderBy('Facilities.name', 'ASC');    
            // Show SQL query for debugging (optional)
            // echo $builder->getCompiledSelect(); exit;
    
        // Return in DataTables JSON format
        return DataTable::of($builder)->toJson();
    }

    public function getFeedback() {
        $session = session();
        $feedbackModel = new FeedbackModel(); 
        $db = \Config\Database::connect();
        
        // Use Query Builder
        $builder = $feedbackModel->select('Facilities.name as facilities_name, Buildings.address as location, Feedbacks.rating, Feedbacks.comment, DATE_FORMAT(Feedbacks.submitted_at, "%Y/%m/%d %H:%i") as submitted_at, Users.name as requester, Feedbacks.feedback_id,')
                                    ->join('Reservations', 'Reservations.reservation_id = Feedbacks.reservation_id','left')
                                    ->join('Users', 'Users.user_id = Feedbacks.user_id','left')
                                    ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id','left')
                                    ->join('Buildings', 'Buildings.building_id = Facilities.building_id','left');
    
        if ($session->get('role') == 'Regular User') {
            $builder->where('Feedbacks.user_id',  $session->get('user_id'));
        }
        $builder->orderBy('Feedbacks.submitted_at', 'DESC');    
      
        // show query for debugging
        // $results = $builder->get()->getResult();
        // echo $db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($builder)->toJson(); 
    }


    public function facilities_type()
    {
        $facilitiesTypeModel = new FacilitiesTypeModel();
        $status = $this->request->getUri()->getSegment(3);       
    
        // Use Query Builder
        $builder = $facilitiesTypeModel->select('facility_type_id, name, description, status, created_at');
    
        $builder->orderBy('name', 'ASC');    
    
        // Return in DataTables JSON format
        return DataTable::of($builder)->toJson();
    }

    //Get Summary Reservation
    public function reservationSummary(){
        $session = session();
        $reservationModel = new ReservationModel();

        if ($session->get('role') == 'Regular User') {
            $pending = $reservationModel->where('status', 'Pending')->where('user_id', $session->get('user_id'))->countAllResults();
            $approved = $reservationModel->where('status', 'Approved')->where('user_id', $session->get('user_id'))->countAllResults();
            $rejected = $reservationModel->where('status', 'Rejected')->where('user_id', $session->get('user_id'))->countAllResults();
            $cancel = $reservationModel->where('status', 'Cancelled')->where('user_id', $session->get('user_id'))->countAllResults();
            $total = $reservationModel->where('user_id', $session->get('user_id'))->countAllResults();
        } else {
            $pending = $reservationModel->where('status', 'Pending')->countAllResults();
            $approved = $reservationModel->where('status', 'Approved')->countAllResults();
            $rejected = $reservationModel->where('status', 'Rejected')->countAllResults();
            $cancel = $reservationModel->where('status', 'Cancelled')->countAllResults();
            $total = $reservationModel->countAllResults();
        }
        
        return $this->response->setJSON([
            'pending' => $pending,
            'approved' => $approved,
            'cancel' => $cancel,
            'rejected' => $rejected,            
            'total' => $total
        ]);
    }

    //Get Data Reservation
    public function reservation() {
        $session = session();
        $reservationModel = new ReservationModel();
        $status = $this->request->getUri()->getSegment(3); 
        $db = \Config\Database::connect();
        if ($status === "Pending") {
            $statusFilter = "pending";
        } elseif ($status === "Approved") {
            $statusFilter = "approved";
        } elseif ($status === "Rejected") {
            $statusFilter = "rejected";
        } elseif ($status === "Completed") {
            $statusFilter = "completed";
        } elseif ($status === "Cancelled") {
            $statusFilter = "cancelled";
        } else {
            $statusFilter = null;
        }
    
        // Use Query Builder
        $builder = $reservationModel->select('Reservations.reservation_id, Facilities.name as facilities_name, Reservations.purpose, DATE_FORMAT(Reservations.start_time, "%Y/%m/%d %H:%i") as start_time, Reservations.status, Feedbacks.rating, Feedbacks.comment, DATE_FORMAT(Reservations.end_time, "%Y/%m/%d %H:%i") as end_time, Users.name as requester, DATE_FORMAT(Reservations.created_at, "%Y/%m/%d %H:%i") as created_at')
                                    ->join('Users', 'Users.user_id = Reservations.user_id','inner')
                                    ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id','left')
                                    ->join('Feedbacks', 'Feedbacks.reservation_id = Reservations.reservation_id','left');
    
        // filter
        if ($statusFilter !== null) {
            $builder->where('Reservations.status', $statusFilter);
        }
        if ($session->get('role') == 'Regular User') {
            $builder->where('Reservations.user_id', $session->get('user_id'));
        }
        
        $builder->orderBy('Reservations.created_at', 'DESC');    
      
        // show query for debugging
        // $results = $builder->get()->getResult();
        // echo $db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($builder)->toJson(); 
    }

    //Agenda Load
    public function loadAgenda() {
        $db = \Config\Database::connect();
        $facilityId = $this->request->getUri()->getSegment(3); 
        $request = service('request');
        $start = $request->getGet('start');
        $end = $request->getGet('end');
        
        $schedulesModel = new SchedulesModel();
        $bookingload = $schedulesModel->select('Schedules.*,r.start_time as schedule_date_start, r.end_time as schedule_date_end,r.purpose, au.name as facility_name,vp.name as created_by_name')
                        ->join('Reservations r', 'r.reservation_id = Schedules.reservation_id', 'left')
                        ->join('Facilities au', 'au.facility_id = r.facility_id', 'left')
                        ->join('Users vp', 'r.user_id = vp.user_id', 'left')
                        ->where("r.facility_id",$facilityId)
                        ->where("DATE(r.start_time) >= '" . $start . "' AND DATE(r.end_time) <= '" . $end . "'")
                        ->get()->getResult();
        $resp = [];
        $i = 0;
    
        foreach ($bookingload as $r) {
            $i++;
            $startDate = date("Y-m-d H:i:s", strtotime($r->schedule_date_start));
            $timestamp_start = strtotime($startDate);
            $endDate = date("Y-m-d H:i:s", strtotime($r->schedule_date_end));
            $timestamp_end = strtotime($endDate);
            $diff = abs($timestamp_end - $timestamp_start);
    
            $days = floor($diff / (60 * 60 * 24)) + 1;
    
            // Color by duration
            if ($days == 1) {
                $color = '#525452';
            } elseif ($days > 1 && $days <= 15) {
                $color = '#6a00ff';
            } elseif ($days > 15 && $days <= 30) {
                $color = '#C0C0C0';
            } elseif ($days > 30 && $days <= 60) {
                $color = '#fa6800';
            } else {
                $color = '#f0a30a';
            }
    
            if (!empty($r->purpose)) {
                for ($j = 1; $j <= $days; $j++) {
                    $add_day = $j - 1;
                    $start = date('Y-m-d', strtotime("+{$add_day} day", $timestamp_start));
                    $created = $r->created_by_name;
                    $start_time = date("H:i", strtotime($r->schedule_date_start)); 
                    $end_time = date("H:i", strtotime($r->schedule_date_end));                    
                    $time = $start_time . ' - ' . $end_time;
                    $event_short_name = $r->purpose;
                    $start_time_full = $time . ' (' . $event_short_name . ')';
                    $place = $r->facility_name;
    
                    $resp[$start . '_' . $r->schedule_id . '_' . $j] = [
                        'id'      => $r->schedule_id,
                        'title'   => $event_short_name,
                        'desc'    => $start_time_full,
                        'start'   => $startDate,
                        'end'     => $endDate,
                        'fullday' => false,
                        'place'   => $place,
                        'created' => $created,
                        'color'   => $color,
                    ];
                }
            }
        }
    
        return $this->response->setJSON(array_values($resp));
    }

}