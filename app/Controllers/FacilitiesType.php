<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FacilityModel;
use App\Models\FacilitiesTypeModel;
use App\Models\BuildingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class FacilitiesType extends Controller
{
    public function index()
    {
        
        $facilitiesTypeModel = new FacilitiesTypeModel();
        $availableCount = $facilitiesTypeModel->where('status', 'available')->countAllResults();
        $maintenanceCount = $facilitiesTypeModel->where('status', 'maintenance')->countAllResults();
        $totalCount = $facilitiesTypeModel->countAll();
        $data = [
            'availableCount' => $availableCount, 
            'maintenanceCount' => $maintenanceCount,
            'totalCount' => $totalCount,
        ];
        return view('facilities_type', $data);
    }

    public function edit(){
        $id = $this->request->getUri()->getSegment(3);
        $facilitiesTypeModel = new FacilitiesTypeModel(); 
        $facilitiesType = $facilitiesTypeModel->select('FacilitiesType.*')
                        ->join('Facilities', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->where('FacilitiesType.facility_type_id', $id)
                        ->first();

        if(!$facilitiesType){
            throw new PageNotFoundException("Page not found");
        } 
        
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->findAll();
        $buildingModel = new BuildingModel();        
        $building = $buildingModel->findAll();
        $data = [
            'facilitiesType' => $facilitiesType,
            'facility' => $facility,
            'buildings' => $building
        ];
        return view('facilities_type_edit', $data);
    }

    public function save()
    {
        $model = new FacilitiesTypeModel(); 
        $facility_type_id = $this->request->getVar('facility_type_id');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $status = $this->request->getVar('status');

        $facilitiesType = $model->where('facility_type_id', $facility_type_id)->first();
        $facilitiesTypeData = [
            'name' => $name,
            'description' => $description,
            'status' => !empty($status) ? $status : 'under maintenance'
        ];

        if ($facilitiesType) {
            // Update facilities type
            $facilitiesTypeData['updated_at'] = date('Y-m-d H:i:s');  
            $submit = $model->update($facilitiesType['facility_type_id'], $facilitiesTypeData);
           
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
            // Insert new facilities type
            $facilitiesTypeData['created_at'] = date('Y-m-d H:i:s');
            $submit = $model->insert($facilitiesTypeData);
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
         echo $model->db->getLastQuery();
    }


    public function delete($facility_type_id)
    {
        $model = new FacilitiesTypeModel();

        // Check if facilities type exists
        $facilitiesType = $model->where('facility_type_id', $facility_type_id)->first();
        if (!$facilitiesType) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => '<div class="alert alert-danger"><strong>Error!</strong> Facility not found.</div>'
            ]);
        }

        // Delete facilities type
        $deleted = $model->where('facility_id', $facility_type_id)->delete();
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

