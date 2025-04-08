<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use \Hermawan\DataTables\DataTable;
use App\Models\UserModel;
use App\Models\BuildingModel;
use App\Models\FacilityModel;
use App\Models\ReservationModel;

class Data extends Controller
{

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
        $userModel->select('Users.name, Users.email, department.department_name, Users.created_at, Users.user_id')
            ->join('department', 'department.department_id = Users.department_id','left')
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