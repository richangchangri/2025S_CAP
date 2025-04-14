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

    public function detail(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $id = $this->request->getUri()->getSegment(3);
        $feedbackModel = new FacilityModel();
        $feedback = $feedbackModel->select('Feedbacks.*, FacilitiesType.name as facilities_type_name, Buildings.name as building_name')
                        ->join('Reservations', 'Reservations.reservation_id = Feedbacks.reservation_id', 'left')
                        ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->join('Buildings', 'Buildings.building_id = Facilities.building_id', 'left')
                        ->where('Facilities.facility_id', $id)
                        ->first();

        if(!$feedback){
            throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'feedback' => $feedback
        ];
        return view('feedback_detail', $data);
    }
}

