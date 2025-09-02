<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'results';
    protected $primaryKey = 'id_result';
    protected $allowedFields = ['user_id', 'competition_id', 'category', 'position', 'club_name', 'belt_used'];
    protected $useTimestamps = true;
}
