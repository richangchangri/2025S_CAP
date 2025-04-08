<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Reservation extends Controller
{
    public function index()
    {
        return view('reservation', ['title' => 'Reservation']);
    }
}