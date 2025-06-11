<?php

namespace App\Models;

use CodeIgniter\Model;

class ClubModel extends Model
{
    protected $table = 'clubs';
    protected $primaryKey = 'id_club';

    protected $allowedFields = [
        'name', 'city', 'address', 'phone', 'email', 'visible', 'created_at', 'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
}
