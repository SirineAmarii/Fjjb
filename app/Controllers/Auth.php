<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    // Affiche le formulaire de connexion
    public function login()
    {
        // Affiche la vue de connexion
        return view('auth/login');
    }

    // Traite la tentative de connexion
    public function loginPost()
    {
        // Démarre la session utilisateur
        $session = session();

        // Initialise le modèle utilisateur
        $userModel = new UserModel();

        // Récupère les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Recherche un utilisateur avec l'email fourni
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Vérifie si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Crée les données de session à enregistrer
                $sessionData = [
                    'id_user'     => $user['id_user'],       // Identifiant utilisateur
                    'first_name'  => $user['first_name'],    // Prénom
                    'last_name'   => $user['last_name'],     // Nom
                    'email'       => $user['email'],         // Email
                    'role'        => $user['role'],          // Rôle (admin, club, etc.)
                    'isLoggedIn'  => true                    // Statut de connexion
                ];
                // Enregistre les données dans la session
                $session->set($sessionData);

                // Redirige selon le rôle de l'utilisateur
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($user['role'] === 'club') {
                    return redirect()->to('/club/dashboard');
                } else {
                    return redirect()->to('/user/dashboard');
                }
            } else {
                // Mot de passe incorrect : message d'erreur
                $session->setFlashdata('error', 'Incorrect password.');
                return redirect()->to('/login');
            }
        } else {
            // Aucun utilisateur trouvé avec cet email : message d'erreur
            $session->setFlashdata('error', 'No user found with this email.');
            return redirect()->to('/login');
        }
    }

    // Déconnecte l'utilisateur et détruit la session
    public function logout()
    {
        $session = session();           // Récupère la session active
        $session->destroy();           // Détruit la session
        return redirect()->to('/login'); // Redirige vers la page de connexion
    }
}
