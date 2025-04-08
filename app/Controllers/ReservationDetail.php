<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ReservationDetail extends Controller
{
    public function index()
    {
        return view('reservation_detail', ['title' => 'Reservation Detail']);
    }
}