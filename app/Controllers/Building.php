<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BuildingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Building extends Controller
{
    public function index()
    {
        return view('building', ['title' => 'Building']);
    }

    public function detail(){
        $id = $this->request->getUri()->getSegment(3);
        // echo $userid;
        $buildingModel = new BuildingModel();
        $building = $buildingModel->select('Buildings.*, FacilityTypes.name as facilities_type_name, Buildings.name as building_name')
                        ->join('FacilityTypes', 'FacilityTypes.building_type_id = Facilities.building_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->where('Facilities.building_id', $id)
                        ->first();

        echo $buildingModel->db->getLastQuery();
        if(!$building){
            // throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'building' => $building
        ];
        return view('building_detail', $data);
    }

    public function edit(){
        $buildingId = $this->request->getUri()->getSegment(3);
        // echo $userid;
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
        $user_id = $this->request->getVar('user_id');
        $username = $this->request->getVar('username');
        $name = $this->request->getVar('name');
        $email = $this->request->getVar('email');
        $department = $this->request->getVar('department');
        $userRole = $this->request->getVar('userRole');
        $status = $this->request->getVar('status');
        $password = $this->request->getVar('password');

        $user = $model->where('user_id', $user_id)->first();
        $userData = [
            'email' => $email,
            'department_id' => $department,
            'user_role_id' => $userRole,
            'username' => $username,
            'name' => $name,
            'status' => !empty($status) ? $status : 'active'
        ];

        if (!empty($password)) {
            $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        if ($user) {
            // Update user
            $userData['updated_at'] = date('Y-m-d H:i:s');  
            $submit = $model->update($user['user_id'], $userData);
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
            // Insert new user
            $userData['created_at'] = date('Y-m-d H:i:s');
            $submit = $model->insert($userData);
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


    public function delete($user_id)
    {
        $model = new BuildingModel();

        // Check if user exists
        $user = $model->where('user_id', $user_id)->first();
        if (!$user) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => '<div class="alert alert-danger"><strong>Error!</strong> User not found.</div>'
            ]);
        }

        // Delete user
        $deleted = $model->where('user_id', $user_id)->delete();
        if (!$deleted) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => '<div class="alert alert-danger"><strong>Error!</strong> Failed to delete user.</div>'
            ]);
        }

        return $this->response->setJSON([
            "status" => "success",
            "message" => '<div class="alert alert-success"><strong>Success!</strong> User deleted successfully.</div>'
        ]);
    }
}

