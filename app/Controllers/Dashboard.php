<?php

namespace App\Controllers; 

use CodeIgniter\Controller; 
use App\Models\FacilityModel;
use App\Models\UserModel;
use App\Models\FeedbackModel;
use App\Models\UserApprovalModel;
use App\Models\ActivityModel;

class Dashboard extends Controller 
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        
        $data = [
            'title' => 'Dashboard',
            'styles' => [
                base_url('assets/plugins/dropify/dist/css/dropify.min.css'),
                'https://cdn.jsedelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.css'
            ],
            'scripts' => [
                base_url('assets/plugins/dropify/dist/js/dropify.min.js'),
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js',
                base_url('assets/plugins/jquery-validate/jquery.validate.min.js'),
                base_url('assets/js/modul/dashboard.js')
            ]

        ];
        return view('dashboard',$data);
    }
}