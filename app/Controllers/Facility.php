<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FacilityModel;
use App\Models\FacilitiesTypeModel;
use App\Models\BuildingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Facility extends Controller
{
    public function index()
    {
        
        $facilityModel = new FacilityModel();
        $availableCount = $facilityModel->where('status', 'available')->countAllResults();
        $maintenanceCount = $facilityModel->where('status', 'maintenance')->countAllResults();
        $totalCount = $facilityModel->countAll();
        $data = [
            'availableCount' => $availableCount, 
            'maintenanceCount' => $maintenanceCount,
            'totalCount' => $totalCount,
        ];
        return view('facility', $data);
    }

    public function detail(){
        $id = $this->request->getUri()->getSegment(3);
        // echo $userid;
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->select('Facilities.*, FacilitiesType.name as facilities_type_name, Buildings.name as building_name')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->where('Facilities.facility_id', $id)
                        ->first();

        // echo $facilityModel->db->getLastQuery();
        if(!$facility){
            // throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'facility' => $facility
        ];
        return view('facility_detail', $data);
    }

    public function add(){
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->select('Facilities.*, FacilitiesType.name as facilities_type_name, Buildings.name as building_name')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->first();

        $facilitiesTypeModel = new FacilitiesTypeModel();
        $facilitiesType = $facilitiesTypeModel->findAll();
        $buildingModel = new BuildingModel();        
        $building = $buildingModel->findAll();
        $data = [
            'facility' => $facility,
            'facilitiesType' => $facilitiesType,            
            'buildings' => $building
        ];
        return view('facility_add', $data);
    }

    public function edit(){
        $id = $this->request->getUri()->getSegment(3);
        $facilityModel = new FacilityModel(); 
        $facility = $facilityModel->select('Facilities.*, FacilitiesType.name as facilities_type_name, Buildings.name as building_name')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->where('Facilities.facility_id', $id)
                        ->first();

        if(!$facility){
            throw new PageNotFoundException("Page not found");
        } 
        
        $facilitiesTypeModel = new FacilitiesTypeModel();
        $facilitiesType = $facilitiesTypeModel->findAll();
        $buildingModel = new BuildingModel();        
        $building = $buildingModel->findAll();
        $data = [
            'facility' => $facility,
            'facilitiesType' => $facilitiesType,            
            'buildings' => $building
        ];
        return view('facility_edit', $data);
    }

    public function save()
    {
        $model = new FacilityModel(); 
        $facility_id = $this->request->getVar('facility_id');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $capacity = $this->request->getVar('capacity');
        $facilitiesType	= $this->request->getVar('facilitiesType');
        $location = $this->request->getVar('location');
        $status = $this->request->getVar('status');
        $building= $this->request->getVar('building');

        $facility = $model->where('facility_id', $facility_id)->first();
        $facilityData = [
            'name' => $name,
            'description' => $description,
            'capacity' => $capacity,
            'facility_type_id' => $facilitiesType,
            'location' => $location,
            'building_id' => $building,
            'status' => !empty($status) ? $status : 'under maintenance'
        ];

        if ($facility) {
            // Update facility
            $facilityData['updated_at'] = date('Y-m-d H:i:s');  
            $submit = $model->update($facility['facility_id'], $facilityData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Update Failed!</strong> Please try again.</div>'
                ]);
            } 
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> User updated successfully.</div>'
            ]);
        } else {
            // Insert new facility
            $facilityData['created_at'] = date('Y-m-d H:i:s');
            $submit = $model->insert($facilityData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Insert Failed!</strong> Please try again.</div>'
                ]);
            } 
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> User created successfully.</div>'
            ]);
        }
    }


    public function delete($facility_id)
    {
        $model = new FacilityModel();

        // Check if user exists
        $facility = $model->where('facility_id', $facility_id)->first();
        if (!$facility) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => '<div class="alert alert-danger"><strong>Error!</strong> Facility not found.</div>'
            ]);
        }

        // Delete user
        $deleted = $model->where('facility_id', $facility_id)->delete();
        if (!$deleted) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => '<div class="alert alert-danger"><strong>Error!</strong> Failed to delete facility.</div>'
            ]);
        }

        return $this->response->setJSON([
            "status" => "success",
            "message" => '<div class="alert alert-success"><strong>Success!</strong> User deleted successfully.</div>'
        ]);
    }
}

