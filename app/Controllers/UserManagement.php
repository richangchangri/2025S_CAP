<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\DepartmentModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class UserManagement extends Controller
{
    public function index()
    {
        return view('user_management', ['title' => 'User Management']);
    }

    public function profile(){
        $userid = $this->request->getUri()->getSegment(3);
        // echo $userid;
        $userModel = new UserModel();
        $user = $userModel->select('Users.*, department.department_name, Users.role')
                        ->join('department', 'department.department_id = Users.department_id', 'left')
                        ->where('Users.user_id', $userid)
                        ->first();

        if(!$user){
            throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'user' => $user,
            'gravatar_url' => get_gravatar($user['email'], 200)
        ];
        return view('user_profile', $data);
    }

    public function edit(){
        $userid = $this->request->getUri()->getSegment(3);
        // echo $userid;
        $userModel = new UserModel(); 
        $user = $userModel->select('Users.*, department.department_name')
                        ->join('department', 'department.department_id = Users.department_id', 'left')
                        ->where('Users.user_id', $userid)
                        ->first();

        if(!$user){
            throw new PageNotFoundException("Page not found");
        } 
        
        $departmentModel = new DepartmentModel();
        $department = $departmentModel->findAll();
        $data = [ 
            'user' => $user,
            'department' => $department,   
            'gravatar_url' => get_gravatar($user['email'], 200)
        ];
        return view('user_edit', $data);
    }

    public function save()
    {
        $model = new UserModel(); 
        $user_id = $this->request->getVar('user_id');
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
            'role' => $userRole,
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
        $model = new UserModel();

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

