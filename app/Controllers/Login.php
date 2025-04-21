<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Email\Email;
use App\Models\UserModel;
use App\Models\OtpModel;

class Login extends Controller
{
    public function index()
    {           
        $session = session();
        if ($session->get('login')) {
            return redirect()->to('/dashboard');
        }
        helper(['form']);
        return view('login', ['title' => 'Login Page']);
    }

    public function auth()
    {
        $session = session();
        $model = new UserModel();
        $otpModel = new OtpModel(); 
        $db = \Config\Database::connect(); 
        $email = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            if($verify_pass){
                if($data['status'] == "inactive"){
                    return $this->response->setJSON(["status" => "error", "message" => "We apologize, your account is currently suspended. Please contact the administrator"]);
                }
                 // Generate OTP code (6-digit)                 
                $otp_code = rand(100000, 999999);
                date_default_timezone_set('Asia/Jakarta');
                $expired_at = date('Y-m-d H:i:s', strtotime('+10 minutes')); // OTP valid for 5 minutes                 
                $otp = $otpModel->where('email', $email)->first();
                $otpData = [
                    'email'     => $email,
                    'otp_code'  => $otp_code,
                    'expired_at'=> $expired_at
                ];
                
                if ($otp) {
                    // Update OTP if available
                    $otpModel->update($otp['id'], $otpData);
                } else {
                    // Insert OTP baru
                    $otpModel->insert($otpData);
                }
                
                $ses_data = [
                    'email'     => $data['email']
                ];
                $session->set($ses_data);

                 // Send OTP to email
                 $emailService = \Config\Services::email();
                 $emailService->setFrom('hello@demomailtrap.co', 'Office Facility Reservation System');
                 $emailService->setTo($data['email']);
                 $emailService->setSubject('Your OTP Code');
                 $emailService->setMessage('Your OTP code is: ' . $otp_code);
                 if (!$emailService->send()) {
                    // debugging email
                    return $this->response->setJSON([
                        "status" => "error",
                        "message" => "Failed to send OTP email",
                        "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
                    ]);
                }
                
                return $this->response->setJSON(["status" => "success", "email" => $email, "message" => "Login successful"]);
            }else{
                return $this->response->setJSON(["status" => "error", "message" => "Wrong Password"]);
            }
        }else{
            return $this->response->setJSON(["status" => "error", "message" => "Email not Found"]);
        }
    }

    public function forgotpassword()
    {
        $model = new UserModel();
        $db = \Config\Database::connect(); 
        $email = $this->request->getVar('email');        
        $cekEmail = $model->where('email', $email)->first();
        if ($cekEmail) {
            $words = generate_string("", 10);
            $newPassword = password_hash($words, PASSWORD_DEFAULT);
            $submit = $model->update($cekEmail['user_id'], ['password' => $newPassword]);
            // Send Reset Password to email
            $emailService = \Config\Services::email();
                 $emailService->setFrom('hello@demomailtrap.co', 'Office Facility Reservation System');
                 $emailService->setTo($cekEmail['email']);
                 $emailService->setSubject('Reset Password');
                 $emailService->setMessage('Please use this word for login: ' . $words);
                 if (!$emailService->send()) {
                // Print debugging email if error occurs
                    return $this->response->setJSON([
                        "status" => "error",
                        "message" => "Failed to reset password, Please contact our administrator for help!",
                        "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
                    ]);
                } else { 
                    return $this->response->setJSON(["status" => "success", "message" => '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong>Success!</strong><br>Password reset successfully, please check your email to get new password!</div>']);
                }
        } else {
            return $this->response->setJSON(["status" => "error", "message" => '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><strong>Oh Sorry!</strong><br>Account not found. Please check again!</div>']);
          
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function verify()
    {
        $session = session();
        if ($session->get('login')) {
            return redirect()->to('/dashboard');
        }
        $email = $this->request->getGet('email');
        $data = [
            'email' => $email, 
        ];
        return view('login_verify', $data);
    }

    public function checkOTP()
    {
        $session = session();              
        date_default_timezone_set('Asia/Jakarta');
        $db = \Config\Database::connect(); 
        $emailInput = $this->request->getPost('email');   
        $otpInput = $this->request->getPost('otp-code');      
         
        if($this->request->getPost('email')){
           $email = $this->request->getPost('email');      
        } else if ($session->get('email')) {     
            $email = $session->get('email'); // Retrieve user email from session             
        } else {            
            return $this->response->setJSON(["status" => "error", "message" => "Session expired, please login again."]);
        }
        $model = new UserModel();
        $otpModel = new OtpModel(); 
        $otp = $otpModel->where('email', $email)->first();
        if ($otp && $otp['otp_code'] == $otpInput) {      
            if($otp['expired_at'] <= date('Y-m-d H:i:s')){                
                return $this->response->setJSON(["status" => "error", "message" => "OTP Expired, Please request again!"]);
            }
            // OTP is correct, delete OTP from database and mark user as verified
            $otpModel->update($otp['id'], ['otp_code' => null]);
            
            $data = $model->where('email', $email)->first();
            if($data['status'] == "pending"){
                $model->update($data['user_id'], ['status' => 'active']);
            }
            $ses_data = [
                'user_id'  => $data['user_id'],
                'department_id'  => $data['department_id'],
                'role'      => $data['role'],
                'name'      => $data['name'],
                'email'     => $data['email'],
                'login'     => TRUE
            ];
            $session->set($ses_data);
            return $this->response->setJSON(["status" => "success", "message" => "OTP verified successfully."]);
      
        } else {
            return $this->response->setJSON(["status" => "error", "message" => "Invalid OTP. Please try again."]);
        }
    }

    public function resendOTP(){
        
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $db = \Config\Database::connect(); 
        $email = $session->get('email'); // Retrieve user email from session        
        $otpModel = new OtpModel(); 
        $otp_code = rand(100000, 999999);
        $expired_at = date('Y-m-d H:i:s', strtotime('+5 minutes')); // OTP valid for 5 minutes                 
        $otp = $otpModel->where('email', $email)->first();
        if($otp){
        $otpModel->update($otp['id'], [
            'otp_code'  => $otp_code,
            'expired_at'=> $expired_at,
        ]);
        } else {
        // Insert OTP code into database
        $otpData = [
            'email'     => $otp['email'],
            'otp_code'  => $otp_code,
            'expired_at'=> $expired_at,
        ];
        $otpModel->save($otpData);
        }

        // Send OTP to email
        $emailService = \Config\Services::email();
        $emailService->setFrom('hello@demomailtrap.co', 'Office Facility Reservation System');
        $emailService->setTo($otp['email']);
        $emailService->setSubject('Your OTP Code');
        $emailService->setMessage('Your OTP code is: ' . $otp_code);
        if (!$emailService->send()) {
        // Print debugging email if error occurs
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Failed to send OTP email",
                "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
            ]);
        } else {            
            return $this->response->setJSON(["status" => "success", "message" => "OTP already sent to Email."]);
        }
    }

    public function register(){
        $session = session();
        date_default_timezone_set('Asia/Jakarta');
        $model = new UserModel();
        $db = \Config\Database::connect(); 
        $email = $this->request->getVar('email');        
        $fullname = $this->request->getVar('fullname');   
        $password = $this->request->getVar('password');   
        $repassword = $this->request->getVar('repassword');  
        $cekEmail = $model->where('email', $email)->first();
        if ($cekEmail) {
            return $this->response->setJSON(["status" => "error", "message" => "Email already registered."]);
        }
        if ($password != $repassword) {
            return $this->response->setJSON(["status" => "error", "message" => "Repeat password is not the same as the password."]);
        }

        $userData = [
            'email' => $email,
            'name' => $fullname,
            'role' => 'Regular User',
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'status' => 'Pending',            
            'created_at' => date('Y-m-d H:i:s')
        ];
        $submit = $model->insert($userData);
        if (!$submit) {
            return $this->response->setJSON([
                "status" => "error", 
                "message" => '<div class="alert alert-danger"><strong>Insert Failed!</strong> Please try again.</div>'
            ]);
        } 
        $ses_data = [
            'email'     => $email
        ];
        $session->set($ses_data);
        $otpModel = new OtpModel(); 
        $otp_code = rand(100000, 999999);
        $expired_at = date('Y-m-d H:i:s', strtotime('+30 minutes')); // OTP valid for 5 minutes                 
        $otp = $otpModel->where('email', $email)->first();
        if($otp){
            $otpModel->update($otp['id'], [
                'otp_code'  => $otp_code,
                'expired_at'=> $expired_at,
            ]);
        } else {
            // Insert OTP code into database
            $otpData = [
                'email'     => $email,
                'otp_code'  => $otp_code,
                'expired_at'=> $expired_at,
            ];
            $otpModel->save($otpData);
        }

        // Send OTP to email
        $emailService = \Config\Services::email();        
        $emailService->setFrom('hello@demomailtrap.co', 'Office Facility Reservation System');
        $emailService->setTo($email);
        $emailService->setSubject('Your OTP Code');
        $emailService->setMessage('Your OTP code is: ' . $otp_code);
        if (!$emailService->send()) {
        // Print debugging email if error occurs
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Failed to send OTP email",
                "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
            ]);
        } else {            
            return $this->response->setJSON(["status" => "success","email" => $email, "message" => "User created successfully, Please check your email for verfication."]);
        }
        
    }
}

