<?php

namespace App\Models;

use CodeIgniter\Model;

class CompetitionModel extends Model
{
    protected $table = 'competitions';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'date',
        'ville',
        'lieu',
        'categorie',
        'image',
        'visible'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = false; // ou true si tu as `created_at` / `updated_at`
}
