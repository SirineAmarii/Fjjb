<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClubModel;
use CodeIgniter\Controller;

class AuthController extends BaseController


{
    // Affiche le formulaire de connexion
    public function login()
    {
        return view('auth/login_view.php');
    }

    // Traite la tentative de connexion
    public function loginPost()
    {
        $session = session();
        $userModel = new UserModel();

        // Récupère les données du formulaire
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Recherche de l'utilisateur en base de données
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Vérifie si le mot de passe est correct
            if (password_verify($password, $user['password'])) {
                // Stocke les informations utilisateur dans la session
                $sessionData = [
                    'id_user'    => $user['id_user'],
                    'first_name' => $user['first_name'],
                    'last_name'  => $user['last_name'],
                    'email'      => $user['email'],
                    'role'       => $user['role'],
                    'isLoggedIn' => true
                ];
                $session->set($sessionData);

                // Redirection en fonction du rôle
                if ($user['role'] === 'admin') {
                    return redirect()->to('admin/dashboard');
                } elseif ($user['role'] === 'club') {
                    return redirect()->to('club/dashboard');
                } else {
                    return redirect()->to('user/dashboard');
                }
            } else {
                $session->setFlashdata('error', 'Mot de passe incorrect');
                return redirect()->to('connexion');
            }
        } else {
            $session->setFlashdata('error', 'Aucun utilisateur trouvé avec cet email');
            return redirect()->to('connexion');
        }
    }

    public function register()
    {
        helper(['form']);
    
        $clubModel = new \App\Models\ClubModel();
        $clubs = $clubModel->findAll();
    
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'first_name' => [
                    'label' => 'Prénom',
                    'rules' => 'required|min_length[2]'
                ],
                'last_name' => [
                    'label' => 'Nom de famille',
                    'rules' => 'required|min_length[2]'
                ],
                'email' => [
                    'label' => 'Adresse e-mail',
                    'rules' => 'required|valid_email|is_unique[users.email]'
                ],
                'password' => [
                    'label' => 'Mot de passe',
                    'rules' => 'required|min_length[6]'
                ],
                'confirm_password' => [
                    'label' => 'Confirmation du mot de passe',
                    'rules' => 'required|matches[password]'
                ],
                'club_id' => [
                    'label' => 'Club',
                    'rules' => 'required|integer'
                ],
                'photo' => [
                    'label' => 'Photo de profil',
                    'rules' => 'uploaded[photo]|is_image[photo]|max_size[photo,2048]'
                ],
            ];
    
            if (!$this->validate($rules)) {
                return view('auth/register_view', [
                    'validation' => $this->validator,
                    'clubs' => $clubs
                ]);
            }
    
            // Gestion de l'image
            $photo = $this->request->getFile('photo');
            $photoName = null;
    
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {
                $photoName = $photo->getRandomName();
                $photo->move(FCPATH . 'uploads/users/', $photoName); // ✅ chemin corrigé
            }
    
            $userModel = new \App\Models\UserModel();
    
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name' => $this->request->getPost('last_name'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'belt' => 'blanche',
                'role' => 'licencié',
                'club_id' => $this->request->getPost('club_id'),
                'photo' => $photoName,
            ];
    
            $userModel->save($data);
    
            return redirect()->to('/connexion')->with('success', 'Inscription réussie.');
        }
    
        return view('auth/register_view', ['clubs' => $clubs]);
    }
    
    // Déconnexion de l'utilisateur
public function logout()
{
    $session = session();
    $session->destroy(); // Supprime toutes les données de session

    return redirect()->to('connexion')->with('success', 'Vous avez été déconnecté.');
}

}
