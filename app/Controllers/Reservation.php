<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\FacilityModel;
use App\Models\ReservationModel;
use App\Models\ApprovalsModel;
use App\Models\SchedulesModel;
use App\Models\NotificationModel;
use App\Models\FeedbackModel;
use App\Models\UsageLogModel;
use CodeIgniter\Exceptions\PageNotFoundException;


class Reservation extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        return view('reservation', ['title' => 'Reservation']);
    }

    public function add()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->where('status', 'available')->findAll();
        $data = [ 
            'facility' => $facility
        ];
        return view('reservation_add', $data);
    }

    public function detail(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $id = $this->request->getUri()->getSegment(3);
        $reservationModel = new ReservationModel();
        $reservation = $reservationModel->select('Reservations.*, Facilities.name as facilities_name, FacilitiesType.name as facilities_type_name')
                         ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->where('Reservations.reservation_id', $id)
                        ->first();

        if(!$reservation){
            throw new PageNotFoundException("Page not found");
        } 
        $facilityModel = new FacilityModel();
        $facility = $facilityModel->where('status', 'available')->findAll();
        $data = [
            'reservation' => $reservation,
            'facility' => $facility
        ];
        return view('reservation_detail', $data);
    }

    public function edit(){
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $id = $this->request->getUri()->getSegment(3);
        $reservationModel = new ReservationModel();
        $reservasi = $reservationModel->select('Reservations.*, Facilities.name as facilities_name, FacilitiesType.name as facilities_type_name')
                         ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->where('Reservations.reservation_id', $id)
                        ->first();

        $facilityModel = new FacilityModel();
        $facility = $facilityModel->where('status', 'available')->findAll();

        if(!$reservasi){
            throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'facility' => $facility,
            'reservation' => $reservasi
        ];
        return view('reservation_edit', $data);
    }

    public function save()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $reservationModel = new ReservationModel(); 
        $facilityModel = new FacilityModel(); 
        $notificationModel = new NotificationModel(); 
    
        $reservation_id = $this->request->getVar('reservation_id');
        $facility = $this->request->getVar('facility');
        $start_time = $this->request->getVar('start_time');
        $end_time = $this->request->getVar('end_time');
        $purpose = $this->request->getVar('purpose');
        $location = $this->request->getVar('location');
        $status = $this->request->getVar('status');    
        $user_id = $this->request->getVar('user_id');
        if (!$user_id) {
            return $this->response->setJSON([
                "status" => "error", 
                "message" => "User not authenticated."
            ]);
        }
    
        $reservation = $reservationModel->where('reservation_id', $reservation_id)->first();        
        $facilities = $facilityModel->where('facility_id', $facility)->first();
    
        if (!$facilities) {
            return $this->response->setJSON([
                "status" => "error", 
                "message" => "Invalid facility selected."
            ]);
        }
    
        $reservationData = [
            'facility_id' => $facility,
            'start_time' => date('Y-m-d H:i:s', strtotime($start_time)),
            'end_time' => date('Y-m-d H:i:s', strtotime($end_time)),
            'purpose' => $purpose,
            'user_id' => $user_id,
            'status' => !empty($status) ? $status : 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
    
        if ($reservation) {
            // Update reservation
            $submit = $reservationModel->update($reservation['reservation_id'], $reservationData);
            if (!$submit) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Update Failed!</strong> Please try again.</div>'
                ]);
            } 
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> Reservation updated successfully.</div>'
            ]);
        } else {
            // Insert new reservation
            $submit = $reservationModel->insert($reservationData);
            $id = $reservationModel->getInsertID(); 
    
            if (!$submit || !$id) {
                return $this->response->setJSON([
                    "status" => "error", 
                    "message" => '<div class="alert alert-danger"><strong>Insert Failed!</strong> Please try again.</div>'
                ]);
            }
    
            // Insert notification
            $notificationData = [                
                'user_id' => $user_id,
                'reservation_id' => $id,
                'message' => 'You just made a reservation for the '. $facilities['name'] .' on '. date('F d, Y H:i', strtotime($start_time)),
                'type' => 'Booking Confirmation',
                'is_read' => 0
            ];
            $notificationModel->insert($notificationData);
    
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> Reservation created successfully.</div>'
            ]);

        }
    }

    public function approval(){
        $session = session();
        $reservation_id = $this->request->getVar('reservation_id');
        $status = $this->request->getVar('status');
        $notes =  $this->request->getVar('notes');
        $reservationModel = new ReservationModel(); 
        $reservation = $reservationModel->select('Reservations.*, Facilities.name as facilities_name, FacilitiesType.name as facilities_type_name')
        ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id', 'left')
       ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
       ->where('Reservations.reservation_id', $reservation_id)
       ->first();  
        
        if($reservation){           
            $userid = $session->get('user_id');
            $approvalsModel = new ApprovalsModel();
            $approvalsData = [
                'reservation_id' => $reservation_id,
                'approver_id' => $userid,
                'decision' => $status,
                'notes' => $notes
            ];
            $submit = $approvalsModel->insert($approvalsData);
            $reservationData = [ 'status' => $status ];
            $submit = $reservationModel->update($reservation['reservation_id'], $reservationData);
            if($status == "Approved"){                
                $schedulesModel = new SchedulesModel(); 
                $schedulesData = [
                    'reservation_id' => $reservation_id,
                    'status' => 'as_schedule'
                ];
                $submit = $schedulesModel->insert($schedulesData);

                $usageLogModel = new UsageLogModel();
                $actualUsage = calculate_actual_usage($reservation['start_time'], $reservation['end_time']);
                $usageLogData = [
                    'facility_id' => $reservation['facility_id'],
                    'user_id' => $userid,
                    'check_in_time' => $reservation['start_time'],
                    'check_out_time' => $reservation['end_time'],
                    'actual_usage  ' => $actualUsage
                ];
                $submit = $usageLogModel->insert($usageLogData);
            }
            
            $notificationModel = new NotificationModel();  
            $notificationData = [
                'user_id' => $userid,
                'reservation_id' => $reservation_id,
                'message' => 'Your reservation for '. $reservation['facilities_name'].' has been '. $status,
                'type'  => 'Booking Confirmation',
                'is_read' => 0
            ];             
            $submit = $notificationModel->insert($notificationData);
            return $this->response->setJSON([
                "status" => "success", 
                "message" => '<div class="alert alert-success"><strong>Success!</strong> Approval Reservation successfully.</div>'
            ]);
        }
       
    }
    
    public function feedback($id)
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/login');
        }
        $reservationModel = new ReservationModel();
        $reservation = $reservationModel->select('Reservations.*, Facilities.name as facilities_name, FacilitiesType.name as facilities_type_name')
                         ->join('Facilities', 'Facilities.facility_id = Reservations.facility_id', 'left')
                        ->join('FacilitiesType', 'FacilitiesType.facility_type_id = Facilities.facility_type_id', 'left')
                        ->where('Reservations.reservation_id', $id)
                        ->first();

        if(!$reservation){
            throw new PageNotFoundException("Page not found");
        } 
        $data = [
            'facility' => $reservation,
            'reservation_id' => $id
        ];
        return view('reservation_feedback', $data);
    }

    public function submit_feedback()
    {
        $feedbackModel = new FeedbackModel(); 
        $db = \Config\Database::connect();
        $reservationModel = new ReservationModel(); 
        $reservation = $reservationModel->where('Reservations.reservation_id', $this->request->getPost('reservation_id'))->first();

        if (!$reservation) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Reservation not found.'
            ]);
        }
        $rating = $this->request->getPost('score');
        $feedback = $this->request->getPost('feedback');
        $user_id = $this->request->getPost('user_id');
        $reservation_id = $this->request->getPost('reservation_id');
       
        // Save to database
        $data = [
            'reservation_id' => $reservation_id,
            'user_id' => $user_id,
            'rating' => $rating,
            'comment' => $feedback,
            'submitted_at' => date('Y-m-d H:i:s')
        ];

        $feedbackModel->insert($data);
        $reservationData = [
            'status' => 'Completed'
        ];  
        $submit = $reservationModel->update($reservation['reservation_id'], $reservationData);
        // Show query
        // echo $feedbackModel->db->getLastQuery();
        return $this->response->setJSON([
            "status" => "success", 
            "message" => '<div class="alert alert-success"><strong>Success!</strong> Feedback submitted successfully.</div>'
        ]);
    }

    public function cancel()
    {
        $model = new ReservationModel();
        $facilityModel = new FacilityModel(); 
        $notificationModel = new NotificationModel(); 
    
        $reservation_id = $this->request->getPost('reservation_id');
        $status = $this->request->getPost('status');    

        // Check if reservation exists
        $reservation = $model->where('reservation_id', $reservation_id)->first();
        if (!$reservation) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => 'Error! Reservation not found.'
            ]);
        }

        $reservationData = [
            'status' => 'Cancelled',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Cancel reservation
        $submit = $model->update($reservation['reservation_id'], $reservationData);
        if (!$submit) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => 'Error! Failed to cancel reservation.'
            ]);
        }

        return $this->response->setJSON([
            "status" => "success",
            "message" => 'Success! Reservation canceled successfully.'
        ]);
    }

}