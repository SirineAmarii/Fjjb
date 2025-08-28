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
                    return redirect()->to('admin-dashboard');
                } elseif ($user['role'] === 'club') {
                    return redirect()->to('club-dashboard');
                } else {
                    return redirect()->to('user-dashboard');
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

    // Affiche le formulaire d'inscription licencié
    public function registerUser()
    {
        $clubModel = new ClubModel();
        $data['clubs'] = $clubModel->findAll();

        return view('auth/register_view', $data);
    }

    // Traite l'inscription d'un licencié
    public function createUser()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        // Définition des règles de validation
        $rules = [
            'first_name' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Le prénom est obligatoire.']
            ],
            'last_name' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Le nom est obligatoire.']
            ],
'email' => [
    'rules'  => 'required|valid_email|is_unique[users.email]',
    'errors' => [
        'required'   => 'L\'adresse email est obligatoire.',
        'valid_email'=> 'L\'email n\'est pas valide.',
        'is_unique'  => 'Cette adresse email est déjà associée à un compte.'
    ]
],



            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required'   => 'Le mot de passe est obligatoire.',
                    'min_length' => 'Le mot de passe doit contenir au moins 6 caractères.'
                ]
            ],
            'belt' => [
                'rules'  => 'required',
                'errors' => ['required' => 'La ceinture est obligatoire.']
            ],
            'club_id' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Le choix du club est obligatoire.']
            ],
            'photo' => [
                'rules'  => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/png,image/jpg,image/jpeg]',
                'errors' => [
                    'uploaded' => 'La photo de profil est obligatoire.',
                    'is_image' => 'Le fichier doit être une image.',
                    'mime_in'  => 'Formats acceptés : PNG, JPG, JPEG.'
                ]
            ],
        ];

        // Si la validation échoue
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        // Traitement de l'upload de la photo
        $photo = $this->request->getFile('photo');
        $newName = $photo->getRandomName();
        $photo->move(ROOTPATH . 'public/uploads/users', $newName);

        // Insertion du nouvel utilisateur en base
        $userModel = new UserModel();
        $userModel->insert([
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'belt'       => $this->request->getPost('belt'),
            'club_id'    => $this->request->getPost('club_id'),
            'photo'      => $newName,
            'role'       => 'licencié' // Par défaut, chaque inscrit est un utilisateur simple
        ]);

        return redirect()->to('connexion')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }

    // Déconnexion de l'utilisateur
public function logout()
{
    $session = session();
    $session->destroy(); // Supprime toutes les données de session

    return redirect()->to('connexion')->with('success', 'Vous avez été déconnecté.');
}

}
