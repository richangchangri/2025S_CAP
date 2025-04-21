<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FacilityModel;
use App\Models\FeedbackModel;
use App\Models\FacilitiesTypeModel;
use App\Models\BuildingModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Feedback extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        
        return view('feedback');
    }

    
}

