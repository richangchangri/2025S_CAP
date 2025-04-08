<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityTypesModel extends Model
{
    protected $table = 'FacilityTypes';
    protected $primaryKey = 'facility_type_id';
    protected $allowedFields = ['facility_type_id','name','description'];
}
