<?php

namespace App\Models;

use CodeIgniter\Model;

class FacilitiesTypeModel extends Model
{
    protected $table = 'FacilitiesType';
    protected $primaryKey = 'facility_type_id';
    protected $allowedFields = ['facility_type_id','name','description','status','created_at', 'updated_at'];
}
