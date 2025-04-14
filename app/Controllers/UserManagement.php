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
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel();
        $activeCount = $userModel->where('status', 'active')->countAllResults();
        $inactiveCount = $userModel->where('status', 'inactive')->countAllResults();
        $pendingCount = $userModel->where('status', 'pending')->countAllResults();
        $totalCount = $userModel->countAll();
        $data = [
            'activeCount' => $activeCount, 
            'inactiveCount' => $inactiveCount,
            'pendingCount' => $pendingCount,
            'totalCount' => $totalCount,
        ];
        return view('user_management', $data);
    }

    public function profile(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $userid = $this->request->getUri()->getSegment(3);
        $userModel = new UserModel();
        $user = $userModel->select('Users.*, Department.department_name, Users.role')
                        ->join('Department', 'Department.department_id = Users.department_id', 'left')
                        ->where('Users.user_id', $userid)
                        ->first();

        if(!$user){
            throw new PageNotFoundException("Page not found");
        } 

        $session = session();
        if ($session->get('role') == "Regular User") {
            $readonly = 'readonly';
        } else {
            $readonly = '';
        }
        $data = [
            'readonly' =>  $readonly,
            'user' => $user,
            'gravatar_url' => get_gravatar($user['email'], 200)
        ];
        return view('user_profile', $data);
    }

    public function add(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $userModel = new UserModel(); 
        $user = $userModel->select('Users.*, Department.department_name')
                        ->join('Department', 'Department.department_id = Users.department_id', 'left')
                        ->first();
        
        $departmentModel = new DepartmentModel();
        $department = $departmentModel->findAll();
        $data = [ 
            'user' => $user,
            'department' => $department,   
            'gravatar_url' => get_gravatar($user['email'], 200)
        ];
        return view('user_add', $data);
    }

    public function edit(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $userid = $this->request->getUri()->getSegment(3);
        $userModel = new UserModel(); 
        $user = $userModel->select('Users.*, Department.department_name')
                        ->join('Department', 'Department.department_id = Users.department_id', 'left')
                        ->where('Users.user_id', $userid)
                        ->first();

        if(!$user){
            throw new PageNotFoundException("Page not found");
        } 
        
        $departmentModel = new DepartmentModel();
        $department = $departmentModel->findAll();
        $session = session();
        if ($session->get('role') == "Regular User") {
            $readonly = 'readonly';
        } else {
            $readonly = '';
        }
        $data = [ 
            'readonly' => $readonly,
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
        $phoneNumber = $this->request->getVar('phone_number');
        $userRole = $this->request->getVar('userRole');
        $status = $this->request->getVar('status');
        $password = $this->request->getVar('password');

        $user = $model->where('user_id', $user_id)->first();
        $userData = [
            'email' => $email,
            'department_id' => $department,
            'phone_number' => $phoneNumber,
            'role' => $userRole,
            'name' => $name,
            'status' => !empty($status) ? $status : 'active'
        ];

        if ($user) {
            // Update user
            $userData['updated_at'] = date('Y-m-d H:i:s');  

            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

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
            $model = new UserModel();
            $cekEmail = $model->where('email', $email)->first();
            if ($cekEmail) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Email already registered.</div>']);
            }
            $userData['created_at'] = date('Y-m-d H:i:s');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $password = generate_string("", 8);
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
           

            $submit = $model->insert($userData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Insert Failed!</strong> Please try again.</div>'
                ]);
            } 
            $message = "Your Login information is: \n\nUsername: $email\n\nPassword: $password";            
            // Send notification create user to email
            $emailService = \Config\Services::email();        
            $emailService->setFrom('hello@demomailtrap.co', 'Office Facility Reservation System');
            $emailService->setTo($email);
            $emailService->setSubject('Your Login Information');
            $emailService->setMessage($message);
            if (!$emailService->send()) {
            // Print debugging email if error occurs
                return $this->response->setJSON([
                    "status" => "error",
                    "message" => "Failed to send OTP email",
                    "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
                ]);
            } else {            
                return $this->response->setJSON([
                    "status" => "success",
                    "email" => $email, 
                    "message" => '<div class="alert alert-success"><strong>User created successfully, Please check your email for credential.</div>']);
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
                "message" => 'User not found.'
            ]);
        }

        // Delete user
        $deleted = $model->where('user_id', $user_id)->delete();
        if (!$deleted) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => 'Failed to delete user.'
            ]);
        }

        return $this->response->setJSON([
            "status" => "success",
            "message" => 'User deleted successfully.'
        ]);
    }


}

