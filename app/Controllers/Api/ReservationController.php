<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ReservationModel;

class ReservationController extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ReservationModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->response->setJSON(['status' => true, 'data' => $data]);
    }

    public function byFacility($facility = null)
    {
        if (!$facility) {
            return $this->response->setStatusCode(400)->setJSON(['status' => false, 'message' => 'Facility not found']);
        }

        $data = $this->model->getByFacilityApprove($facility);

        if ($data) {
            return $this->response->setJSON(['status' => true, 'data' => $data]);
        }

        return $this->response->setJSON(['status' => true, 'message' => 'No Event Available']);
    }



    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            return $this->response->setJSON(['status' => true, 'data' => $data]);
        }
        return $this->response->setStatusCode(404)->setJSON(['status' => false, 'message' => 'Reservasi tidak ditemukan']);
    }

    public function create()
    {
        $json = $this->request->getJSON(true); // ambil data JSON

        if (!$this->model->insert($json)) {
            return $this->response->setStatusCode(400)->setJSON(['status' => false, 'errors' => $this->model->errors()]);
        }

        return $this->response->setStatusCode(201)->setJSON(['status' => true, 'message' => 'Reservasi berhasil ditambahkan']);
    }

    public function update($id = null)
    {
        $json = $this->request->getJSON(true);

        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['status' => false, 'message' => 'Reservasi tidak ditemukan']);
        }

        if (!$this->model->update($id, $json)) {
            return $this->response->setStatusCode(400)->setJSON(['status' => false, 'errors' => $this->model->errors()]);
        }

        return $this->response->setJSON(['status' => true, 'message' => 'Reservasi berhasil diupdate']);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->response->setStatusCode(404)->setJSON(['status' => false, 'message' => 'Reservasi tidak ditemukan']);
        }

        $this->model->delete($id);
        return $this->response->setJSON(['status' => true, 'message' => 'Reservasi berhasil dihapus']);
    }
}
