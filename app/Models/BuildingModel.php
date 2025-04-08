<?php

namespace App\Models;

use CodeIgniter\Model;

class BuildingModel extends Model
{
    protected $table = 'Buildings';
    protected $primaryKey = 'building_id';
    protected $allowedFields = ['building_id','name','address','floors','contact_person','building_id','status'];
}
