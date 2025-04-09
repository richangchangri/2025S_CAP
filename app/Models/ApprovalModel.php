<?php

namespace App\Models;

use CodeIgniter\Model;

class ApprovalModel extends Model
{
    protected $table = 'Approvals';
    protected $primaryKey = 'approval_id';
    protected $allowedFields = ['reservation_id','approver_id','decision','notes','decided_at'];
}
