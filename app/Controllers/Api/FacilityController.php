<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\FacilityModel;

class FacilityController extends BaseController
{
    public function index()
    {
        $facilityModel = new FacilityModel();
        $facilities = $facilityModel->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $facilities
        ]);
    }

    public function show($id = null)
    {
        if (!$id) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'No facility code provided'
            ])->setStatusCode(400);
        }

        $facilityModel = new FacilityModel();

        // Cari berdasarkan UUID (facility_code)
        $facility = $facilityModel->where('facility_code', $id)->first();

        if ($facility) {
            return $this->response->setJSON([
                'status' => true,
                'data' => $facility
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Facility not found'
            ])->setStatusCode(404);
        }
    }


}
