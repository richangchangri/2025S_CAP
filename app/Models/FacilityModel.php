<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilityModel extends Model
{
    protected $table = 'Facilities';
    protected $primaryKey = 'facility_id';
    protected $allowedFields = ['facility_id','name','description','capacity','location','facility_type_id','building_id','status'];
}
