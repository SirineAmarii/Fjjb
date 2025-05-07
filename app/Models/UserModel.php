<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'prenom', 'nom', 'email', 'password', 'photo',
        'ceinture', 'club_id', 'role', 'created_at', 'updated_at'
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
}
