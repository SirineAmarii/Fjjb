<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Nom de la table utilisée par ce modèle
    protected $table = 'users';
    // Clé primaire de la table
    protected $primaryKey = 'id_user';

  // Champs autorisés à être insérés ou modifiés
    protected $allowedFields = [
        'first_name',      // Prénom
        'last_name',       // Nom
        'email',           // Email
        'password',        // Mot de passe hashé
        'photo',           // URL ou nom du fichier de la photo de profil
        'belt',            // Couleur de la ceinture (niveau)
        'role',            // Rôle de l'utilisateur (admin, club, user...)
        'club_id',         // Clé étrangère vers la table des clubs
        'created_at',      // Date de création du compte
        'updated_at'       // Date de dernière mise à jour
    ];

    protected $returnType = 'array';
    protected $useTimestamps = true;
}



   

  

    
