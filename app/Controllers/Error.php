<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Error extends Controller
{
    public function show404()
    {
        return view('errors/html/error_404');
    }
}

