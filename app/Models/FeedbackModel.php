<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedbackModel extends Model
{
    protected $table = 'Feedbacks';
    protected $primaryKey = 'feedback_id';
    protected $allowedFields = ['feedback_id', 'reservation_id','user_id','rating','comment','submitted_at'];
}
