<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BuildingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Building extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $buildingModel = new BuildingModel();
        $availableCount = $buildingModel->where('status', 'available')->countAllResults();
        $maintenanceCount = $buildingModel->where('status', 'under maintenance')->countAllResults();
        $totalCount = $buildingModel->countAll();
        $data = [
            'availableCount' => $availableCount, 
            'maintenanceCount' => $maintenanceCount,
            'totalCount' => $totalCount,
        ];
        return view('building', $data);
    }

    public function detail(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $id = $this->request->getUri()->getSegment(3);
        $buildingModel = new BuildingModel();
        $building = $buildingModel->select('Buildings.*, Buildings.name as building_name')
                        ->join('Facilities', 'Facilities.building_id = Buildings.building_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->where('Buildings.building_id', $id)
                        ->first();

        if(!$building){
            throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'building' => $building
        ];
        return view('building_detail', $data);
    }

    public function add(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $buildingId = $this->request->getUri()->getSegment(3);
        $buildingModel = new BuildingModel(); 
        $building = $buildingModel->select('Buildings.*')
                        ->first();
        
        $data = [
            'building' => $building,
        ];
        return view('building_add', $data);
    }

    public function edit(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $buildingId = $this->request->getUri()->getSegment(3);
        $buildingModel = new BuildingModel(); 
        $building = $buildingModel->select('Buildings.*')
                        ->where('Buildings.building_id', $buildingId)
                        ->first();

        if(!$building){
            throw new PageNotFoundException("Page not found");
        } 
        
        $data = [
            'building' => $building,
        ];
        return view('building_edit', $data);
    }

    public function save()
    {
        $model = new BuildingModel(); 
        $building_id = $this->request->getVar('building_id');
        $name = $this->request->getVar('name');
        $address = $this->request->getVar('address');
        $floors = $this->request->getVar('floors');
        $contactPerson = $this->request->getVar('contact_person');
        $status = $this->request->getVar('status');

        $building = $model->where('building_id', $building_id)->first();
        $buildingData = [
            'name' => $name,
            'address' => $address,
            'floors' => $floors,
            'contact_person' => $contactPerson,
            'status' => !empty($status) ? $status : 'under maintenance'
        ];

        if ($building) {
            // Update building
            $buildingData['updated_at'] = date('Y-m-d H:i:s');  
            $submit = $model->update($building['building_id'], $buildingData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Update Failed!</strong> Please try again.</div>'
                ]);
            } 
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> Builidng updated successfully.</div>'
            ]);
        } else {
            // Insert new building
            $buildingData['created_at'] = date('Y-m-d H:i:s');
            $submit = $model->insert($buildingData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Insert Failed!</strong> Please try again.</div>'
                ]);
            } 
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> Building created successfully.</div>'
            ]);
        }
    }


    public function delete($building_id)
    {
        $model = new BuildingModel();
        // Check if building exists
        $building = $model->where('building_id', $building_id)->first();
        if (!$building) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => 'Error! Building not found.'
            ]);
        }

        // Delete Building
        $deleted = $model->where('building_id', $building_id)->delete();
        if (!$deleted) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => 'Failed to delete building.'
            ]);
        }

        return $this->response->setJSON([
            "status" => "success",
            "message" => 'Success!</strong> Building deleted successfully.'
        ]);
    }
}

