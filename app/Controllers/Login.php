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
        // echo $db->getLastQuery();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // echo "Hash dari password '1234567890': " . $hashedPassword . "<br>";
            if($verify_pass){
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
                    'user_id'  => $data['user_id'],
                    'department_id'  => $data['department_id'],
                    'role'  => $data['role'],
                    'name'      => $data['name'],
                    'email'     => $data['email'],
                    'login'     => TRUE
                ];
                $session->set($ses_data);
                // $ses_data = [
                //     'email'    => $data['email']
                // ];
                 // Send OTP to email
                //  $emailService = \Config\Services::email();
                //  $emailService->setFrom('michaelnaibahocapstone@gmail.com', 'Booking ROOM Apps');
                //  $emailService->setTo($data['email']);
                //  $emailService->setSubject('Your OTP Code');
                //  $emailService->setMessage('Your OTP code is: ' . $otp_code);
                //  if (!$emailService->send()) {
                //     // Cetak debugging email jika terjadi error
                //     return $this->response->setJSON([
                //         "status" => "error",
                //         "message" => "Failed to send OTP email",
                //         "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
                //     ]);
                // }
                
                return $this->response->setJSON(["status" => "success", "message" => "Login successful"]);
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
            if($otp['expired_at'] > date('Y-m-d H:i:s')){                
                return $this->response->setJSON(["status" => "error", "message" => "OTP Expired, Please request again!"]);
            }
            // OTP benar, hapus OTP dari database dan tandai user sebagai terverifikasi
            $otpModel->update($otp['id'], ['otp_code' => null, 'is_verified' => 1]);
            
            $data = $model->where('email', $email)->first();
            $ses_data = [
                'user_id'  => $data['user_id'],
                'department_id'  => $data['department_id'],
                'role'  => $data['role'],
                'name'      => $data['user_id'],
                'email'     => $data['email'],
                'login'     => TRUE
            ];
            $session->set($ses_data);
            return $this->response->setJSON(["status" => "success", "message" => "OTP verified successfully."]);
      
        } else {
            return $this->response->setJSON(["status" => "error", "message" => "Invalid OTP. Please try again."]);
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
        return view('login_verify', ['title' => 'Login Page']);
    }

    public function checkOTP()
    {
        $session = session();              
        date_default_timezone_set('Asia/Jakarta');
        $db = \Config\Database::connect(); 
        $otpInput = $this->request->getPost('otp-code');      
            date_default_timezone_set('Asia/Jakarta');
        $email = $session->get('email'); // Ambil email pengguna dari sesi

        if (!$email) {            
            return $this->response->setJSON(["status" => "error", "message" => "Session expired, please login again."]);
        }
        $model = new UserModel();
        $otpModel = new OtpModel(); 
        $otp = $otpModel->where('email', $email)->first();
        //echo $db->getLastQuery();
        if ($otp && $otp['otp_code'] == $otpInput) {      
            if($otp['expired_at'] <= date('Y-m-d H:i:s')){                
                return $this->response->setJSON(["status" => "error", "message" => "OTP Expired, Please request again!"]);
            }
            // OTP benar, hapus OTP dari database dan tandai user sebagai terverifikasi
            $otpModel->update($otp['id'], ['otp_code' => null]);
            
            $data = $model->where('email', $email)->first();
            $ses_data = [
                'user_id'  => $data['user_id'],
                'department_id'  => $data['department_id'],
                'role'  => $data['role'],
                'name'      => $data['user_id'],
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
        
        $db = \Config\Database::connect(); 
        $email = $session->get('email'); // Ambil email pengguna dari sesi        
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
        $emailService->setFrom('noreply@cni.net.id', 'Booking ROOM Apps');
        $emailService->setTo($otp['email']);
        $emailService->setSubject('Your OTP Code');
        $emailService->setMessage('Your OTP code is: ' . $otp_code);
        if (!$emailService->send()) {
        // Cetak debugging email jika terjadi error
            return $this->response->setJSON([
                "status" => "error",
                "message" => "Failed to send OTP email",
                "debug" => $emailService->printDebugger(['headers', 'subject', 'body'])
            ]);
        } else {            
            return $this->response->setJSON(["status" => "success", "message" => "OTP already sent to Email."]);
        }
    }
}

