<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;
use App\Models\BuildingModel;
use App\Models\FacilityModel;
use App\Models\FeedbackModel;
use App\Models\ApprovalModel;
use App\Models\ActivityModel;
use App\Models\FacilitiesTypeModel;
use App\Models\ReservationModel;

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
        $approvalModel = new ApprovalModel();
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
        // echo $status;
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
        echo $db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($userModel)->toJson();
    }

    public function building() {

        $buildingModel = new BuildingModel();
        $status = $this->request->getUri()->getSegment(3); 
        // echo $status;
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
    
        // Jika ada status filter, tambahkan
        if ($statusFilter !== null) {
            $builder->where('status', $statusFilter);
        }

        $builder->orderBy('name', 'ASC');

        // show query for debugging
        // echo $buildingModel->db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($buildingModel)->toJson();
    }

    public function facility()
    {
        $facilityModel = new FacilityModel();
        $status = $this->request->getUri()->getSegment(3); 
    
        // Tentukan status filter
        if ($status === "available") {
            $statusFilter = "available";
        } elseif ($status === "maintenance") {
            $statusFilter = "under maintenance";
        } else {
            $statusFilter = null; // semua data
        }
    
        // Gunakan Query Builder
        $builder = $facilityModel->select('facility_id, name, description, capacity, location, status');
    
        // Jika ada status filter, tambahkan
        if ($statusFilter !== null) {
            $builder->where('status', $statusFilter);
        }
    
        $builder->orderBy('name', 'ASC');    
        // Tampilkan query SQL untuk debugging (opsional)
        // echo $builder->getCompiledSelect(); exit;
    
        // Kembalikan dalam format DataTables JSON
        return DataTable::of($builder)->toJson();
    }

    public function facilities_type()
    {
        $facilitiesTypeModel = new FacilitiesTypeModel();
        $status = $this->request->getUri()->getSegment(3); 
    
        // Tentukan status filter
        if ($status === "available") {
            $statusFilter = "available";
        } elseif ($status === "maintenance") {
            $statusFilter = "under maintenance";
        } else {
            $statusFilter = null; // semua data
        }
    
        // Gunakan Query Builder
        $builder = $facilitiesTypeModel->select('facility_type_id, name, description, created_at');
    
        // Jika ada status filter, tambahkan
        if ($statusFilter !== null) {
            $builder->where('status', $statusFilter);
        }
    
        $builder->orderBy('name', 'ASC');    
        // Tampilkan query SQL untuk debugging (opsional)
        // echo $builder->getCompiledSelect(); exit;
    
        // Kembalikan dalam format DataTables JSON
        return DataTable::of($builder)->toJson();
    }

    //Get Data Reservation
    public function reservation() {
        $reservationModel = new ReservationModel();
        $db = \Config\Database::connect(); 
        $status = $this->request->getUri()->getSegment(3); 
        // echo $status;
        if ($status === "pending") {
            $statusFilter = "pending";
        } elseif ($status === "approved") {
            $statusFilter = "approved";
        } elseif ($status === "rejected") {
            $statusFilter = "rejected";
        } else {
            $statusFilter = "all";
        }
    
        // Query builder with filter status
        $reservationModel->select('room_id','reservation_start', 'user_id', 'reservation_id')
        ->where('status', $statusFilter)
        ->orderBy('reservation_id', 'ASC');
    
        // show query for debugging
        // echo $db->getLastQuery();
        // return output format DataTable JSON
        return DataTable::of($reservationModel)->toJson();
    }
}