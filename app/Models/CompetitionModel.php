<?php

namespace App\Models;

use CodeIgniter\Model;

class CompetitionModel extends Model
{
    protected $table = 'competitions';
    protected $primaryKey = 'id_competition';

    protected $allowedFields = [
        'name',
        'event_date',
        'city',
        'venue',
        'category',
        'image',
        'visible'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false; 
}