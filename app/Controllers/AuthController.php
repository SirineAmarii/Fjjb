<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    // Affiche le formulaire de connexion
    public function login()
    {
        // Affiche la vue de connexion
        return view('auth/login_view.php');
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
                    return redirect()->to('admin-dashboard');
                } elseif ($user['role'] === 'club') {
                    return redirect()->to('/club/dashboard');
                } else {
                    return redirect()->to('user-dashboard');
                }
            } else {
                // Mot de passe incorrect : message d'erreur
                $session->setFlashdata('error', 'Incorrect password.');
                return redirect()->to('connexion');
            }
        } else {
            // Aucun utilisateur trouvé avec cet email : message d'erreur
            $session->setFlashdata('error', 'No user found with this email.');
            return redirect()->to('connexion');
        }
    }

    public function chooseRegistration()
{
    return view('auth/choose_registration');
}

public function registerUser()
{
    return view('auth/register_user');
}

public function createUser()
{
    helper(['form']);
    $validation = \Config\Services::validation();

    $labels = [
        'first_name' => 'prénom',
        'last_name'  => 'nom',
        'email'      => 'adresse email',
        'password'   => 'mot de passe',
        'belt'       => 'ceinture',
    ];

    $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|valid_email|is_unique[users.email]',
        'password'   => 'required|min_length[6]',
        'belt'       => 'required',
         'photo'      => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/png,image/jpg,image/jpeg]',
    ];

  // Vérifie les règles de validation initiales
if (!$this->validate($rules)) {
    return redirect()->back()
        ->withInput()
        ->with('error', $this->validator->getErrors());
}

// Applique les libellés personnalisés pour chaque champ
foreach ($rules as $field => $rule) {
    // Si c'est le champ photo et qu'il n'est pas valide ou pas envoyé, on saute
    if ($field === 'photo') {
        $file = $this->request->getFile('photo');
        if (!$file || !$file->isValid()) {
            continue;
        }
    }

    // Vérifie que le label existe sinon en met un par défaut
    $label = isset($labels[$field]) ? $labels[$field] : ucfirst($field);

    $validation->setRule($field, $rule, [], ['label' => $label]);
}


// Relance la validation avec les règles et les labels
if (!$validation->withRequest($this->request)->run()) {
    return redirect()->back()
        ->withInput()
        ->with('error', $validation->getErrors());
}

// Traitement du fichier photo (si présent)
$photo = $this->request->getFile('photo');
$photoName = null;

if ($photo && $photo->isValid() && !$photo->hasMoved()) {
    $photoName = $photo->getRandomName();
    $photo->move('public/uploads/users', $photoName);
}


    $userModel = new \App\Models\UserModel();
    $userModel->save([
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'belt'       => $this->request->getPost('belt'),
        'role'       => 'licencié',
        'photo'      => $photoName,
    ]);

    return redirect()->to('connexion')->with('success', 'Inscription réussie ! Connectez-vous maintenant.');
}


public function registerClub()
{
    return view('auth/register_club');
}
 // Déconnecte l'utilisateur et détruit la session
    public function logout()
    {
        $session = session();           // Récupère la session active
        $session->destroy();           // Détruit la session
        return redirect()->to('connexion'); // Redirige vers la page de connexion
    }

public function createClub()
{
    helper(['form']);
    $validation = \Config\Services::validation();

    $labels = [
        'club_name'    => 'nom du club',
        'club_email'   => 'email du club',
        'club_phone'   => 'téléphone du club',
        'club_address' => 'adresse du club',
        'club_city'    => 'ville du club',
        'password'     => 'mot de passe',
    ];

    $rules = [
        'club_name'    => 'required|is_unique[clubs.name]',
        'club_email'   => 'required|valid_email|is_unique[clubs.email]',
        'club_phone'   => 'required',
        'club_address' => 'required',
        'club_city'    => 'required',
        'password'     => 'required|min_length[6]',
    ];

    foreach ($rules as $field => $rule) {
        $validation->setRule($field, $rule, [], ['label' => $labels[$field]]);
    }

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('error', $validation->getErrors());
    }

    // Photo du club (optionnelle)
    $photo = $this->request->getFile('photo');
    $photoName = null;
    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('public/uploads/clubs', $photoName);
    }

    // Insertion du club
    $clubModel = new \App\Models\ClubModel();
    $clubModel->save([
        'name'     => $this->request->getPost('club_name'),
        'email'    => $this->request->getPost('club_email'),
        'phone'    => $this->request->getPost('club_phone'),
        'address'  => $this->request->getPost('club_address'),
        'city'     => $this->request->getPost('club_city'),
        'logo'     => $photoName,
    ]);

    // Insertion de l'utilisateur (le gérant du club)
    $userModel = new \App\Models\UserModel();
    $userModel->save([
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('club_email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'       => 'club',
        'club_id'    => $clubModel->insertID(), // Associe le club créé à l'utilisateur
    ]);

    return redirect()->to('connexion')->with('success', 'Inscription réussie ! Connectez-vous maintenant.');
}



}
