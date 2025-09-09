<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompetitionModel;
use App\Models\ClubModel;

class AdminController extends BaseController
{
    /**
     * Affichage du tableau de bord admin
     */
    public function dashboard()
    {
        /* Vérification si l'utilisateur est connecté et est admin */
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }
/* Chargement des modèles */
        $userModel = new UserModel();
        $clubModel = new ClubModel();
        $competitionModel = new CompetitionModel();
/* Récupération des statistiques */
        $data = [
            'nb_users' => $userModel->countAllResults(),
            'nb_clubs' => $clubModel->countAllResults(),
            'nb_compets' => $competitionModel->countAllResults(),
            'admin_name' => session()->get('prenom')
        ];
/* Affichage de la vue avec les données */
        return view('admin/admin_dashboard', $data);

    }


/**
 * Gestion des compétitions
 */

public function addCompetition()
{
    // Vérification si l'utilisateur est connecté et est admin
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }
// Affichage du formulaire d'ajout de compétition
    return view('admin/add_competition');
}

/* Création d'une nouvelle compétition */
public function createCompetition()
{
    
    helper(['form']);
// Règles de validation
    $validation = \Config\Services::validation();
// Règles dans un tableau propre
    $rules = [
        'name'       => 'required',
        'event_date' => 'required|valid_date',
        'city'       => 'required',
        'venue'      => 'permit_empty',
        'category'   => 'permit_empty',
        'visible'    => 'required|in_list[0,1]',
        'image'      => 'uploaded[image]|is_image[image]|max_size[image,2048]'
    ];
// Appliquer les règles
    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $validation->getErrors());
    }

    // gestion de l'image
    $image = $this->request->getFile('image');
    $imageName = null;
// Si une image est uploadée et valide, on la déplace
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $imageName = $image->getRandomName();
        $image->move('public/assets/images/competitions', $imageName);
    }
// Insertion de la compétition
    $model = new \App\Models\CompetitionModel();
    $model->save([
        'name'       => $this->request->getPost('name'),
        'event_date' => $this->request->getPost('event_date'),
        'city'       => $this->request->getPost('city'),
        'venue'      => $this->request->getPost('venue'),
        'category'   => $this->request->getPost('category'),
        'visible'    => $this->request->getPost('visible'),
        'image'      => $imageName
    ]);
// Redirection avec message de succès
    return redirect()->to('admin/competitions')->with('success', 'Compétition ajoutée avec succès.');
}

/* Edition d'une compétition */
public function editCompetition($id)
{
    //
    $competitionModel = new \App\Models\CompetitionModel();
    $competition = $competitionModel->find($id);
// Vérification si la compétition existe
    if (!$competition) {
        return redirect()->to('admin/competitions')->with('error', 'Compétition introuvable.');
    }
// Affichage du formulaire d'édition avec les données de la compétition
    return view('admin/edit_competition', ['competition' => $competition]);
}

/* Liste des compétitions */
public function manageCompetitions()
{
    // Vérification si l'utilisateur est connecté et est admin
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    // Récupération de toutes les compétitions
    $competitionModel = new \App\Models\CompetitionModel();
    $competitions = $competitionModel->findAll();

    // Affichage de la vue avec les compétitions
    return view('admin/competitions_list', ['competitions' => $competitions]);
}

// Mise à jour d'une compétition
public function updateCompetition($id)
{
    
    $competitionModel = new \App\Models\CompetitionModel();
    $competition = $competitionModel->find($id);

    // Vérification si la compétition existe
    if (!$competition) {
        return redirect()->to('admin/competitions')->with('error', 'Compétition introuvable.');
    }

    // Règles de validation
    $data = [
        'name'       => $this->request->getPost('nom'),
        'event_date' => $this->request->getPost('event_date'),
        'city'       => $this->request->getPost('city'),
        'venue'      => $this->request->getPost('venue'),
        'category'   => $this->request->getPost('category'),
        'visible'    => $this->request->getPost('visible'),
    ];

    // image si uploadée
    $image = $this->request->getFile('image');
    if ($image && $image->isValid() && !$image->hasMoved()) {
        $newName = $image->getRandomName();
        $image->move('public/assets/images/competitions', $newName);
        $data['image'] = $newName;
    }

    // Mise à jour de la compétition
    $competitionModel->update($id, $data);

    // Redirection avec message de succès
    return redirect()->to('admin/competitions')->with('success', 'Compétition mise à jour.');
}

/* Suppression d'une compétition */

public function deleteCompetition($id)
{
    // Récupérer la compétition
    $competitionModel = new \App\Models\CompetitionModel();
    $competition = $competitionModel->find($id);

    // Vérification si la compétition existe
    if (!$competition) {
        return redirect()->to('admin/competitions')->with('error', 'Compétition introuvable.');
    }

    // Supprimer l’image si elle existe
    if (!empty($competition['image']) && file_exists('public/assets/images/competitions/' . $competition['image'])) {
        unlink('public/assets/images/competitions/' . $competition['image']);
    }

    // Supprimer la compétition
    $competitionModel->delete($id);

    // Redirection avec message de succès
    return redirect()->to('admin/competitions')->with('success', 'Compétition supprimée avec succès.');
}

/**
 * Gestion des utilisateurs
 */

    public function manageUsers()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $userModel = new \App\Models\UserModel();
    $users = $userModel->findAll();

    return view('admin/users_list', ['users' => $users]);
}

public function editUser($id)
{
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        return redirect()->to('admin/users')->with('error', 'Utilisateur non trouvé');
    }

    return view('admin/edit_user', ['user' => $user]);
}

public function updateUser($id)
{
    helper(['form']);

    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($id);

    if (!$user) {
        return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable.');
    }

    $email = $this->request->getPost('email');

    // Règles de validation
    $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'belt'       => 'required',
        'role'       => 'required'
    ];

    // Appliquer is_unique sur email uniquement si modifié
    if ($email !== $user['email']) {
        $rules['email'] = "required|valid_email|is_unique[users.email,id_user,{$id}]";
    } else {
        $rules['email'] = "required|valid_email";
    }

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', 'Vérifiez les champs du formulaire.');
    }

    // Gestion de la photo (facultative)
    $photo = $this->request->getFile('photo');
    $photoName = $user['photo'];

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('public/uploads/users', $photoName);

        if (!empty($user['photo']) && file_exists('public/uploads/users/' . $user['photo'])) {
            unlink('public/uploads/users/' . $user['photo']);
        }
    }

    // Mise à jour des données
    $userModel->where('id_user', $id)->set([
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $email,
        'belt'       => $this->request->getPost('belt'),
        'role'       => $this->request->getPost('role'),
        'photo'      => $photoName
    ])->update();

    return redirect()->to('admin/users')->with('success', 'Utilisateur mis à jour avec succès.');
}


public function createUser()
{
    helper(['form']);

    $validation = \Config\Services::validation();

    // Règles + labels dans un seul tableau propre
    $rules = [
        'first_name' => [
            'rules' => 'required',
            'label' => 'prénom'
        ],
        'last_name' => [
            'rules' => 'required',
            'label' => 'nom'
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
            'label' => 'adresse e-mail'
        ],
        'password' => [
            'rules' => 'required|min_length[6]',
            'label' => 'mot de passe'
        ],
        'belt' => [
            'rules' => 'required',
            'label' => 'ceinture'
        ],
        'role' => [
            'rules' => 'required',
            'label' => 'rôle'
        ]
    ];

    // Appliquer les règles
    $validation->setRules($rules);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('error', $validation->getErrors());
    }

    // Gestion de la photo
    $photo = $this->request->getFile('photo');
    $photoName = null;

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        $photoName = $photo->getRandomName();
        $photo->move('public/uploads/users', $photoName);
    }

    // Insertion utilisateur
    $userModel = new \App\Models\UserModel();
    $userModel->save([
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'belt'       => $this->request->getPost('belt'),
        'role'       => $this->request->getPost('role'),
        'photo'      => $photoName,
    ]);

    return redirect()->to('admin/users')->with('success', 'Nouvel utilisateur ajouté.');
}

public function addUser()
{
    return view('admin/add_user');
}


public function deleteUser($id)
{
    $userModel = new \App\Models\UserModel();

    if ($userModel->find($id)) {
        $userModel->delete($id);
        return redirect()->to('admin/users')->with('success', 'Utilisateur supprimé');
    }

    return redirect()->to('admin/users')->with('error', 'Utilisateur introuvable');
}

/**
 * Gestion des clubs
 */

public function manageClubs()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $clubModel = new \App\Models\ClubModel();
    $clubs = $clubModel->findAll();

    return view('admin/clubs_list', ['clubs' => $clubs]);
}

public function createClub()
{
    helper(['form']);

    $rules = [
        'name'     => 'required',
        'city'     => 'required',
        'address'  => 'permit_empty',
        'phone'    => 'permit_empty',
        'email'    => 'permit_empty|valid_email',
        'visible'  => 'required|in_list[0,1]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
    }

    $clubModel = new \App\Models\ClubModel();
    $clubModel->save([
        'name'     => $this->request->getPost('name'),
        'city'     => $this->request->getPost('city'),
        'address'  => $this->request->getPost('address'),
        'phone'    => $this->request->getPost('phone'),
        'email'    => $this->request->getPost('email'),
        'visible'  => $this->request->getPost('visible'),
    ]);

    return redirect()->to('admin/clubs')->with('success', 'Club ajouté avec succès.');
}

public function addClub()
{
    return view('admin/add_club');
}

public function editClub($id)
{
    $clubModel = new \App\Models\ClubModel();
    $club = $clubModel->find($id);

    if (!$club) {
        return redirect()->to('admin/clubs')->with('error', 'Club introuvable.');
    }

    return view('admin/edit_club', ['club' => $club]);
}

public function updateClub($id)
{
    helper(['form']);

    $validation = \Config\Services::validation();

    $rules = [
        'name'      => 'required',
        'city'    => 'required',
        'email'    => 'permit_empty|valid_email',
        'phone'=> 'permit_empty',
        'address'  => 'permit_empty',
        'visible'  => 'required|in_list[0,1]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $validation->getErrors());
    }

    $clubModel = new \App\Models\ClubModel();
    $clubModel->update($id, [
        'name'       => $this->request->getPost('name'),
        'city'      => $this->request->getPost('city'),
        'address'   => $this->request->getPost('address'),
        'phone' => $this->request->getPost('phone'),
        'email'     => $this->request->getPost('email'),
        'visible'   => $this->request->getPost('visible'),
    ]);

    return redirect()->to('admin/clubs')->with('success', 'Club modifié avec succès.');
}
public function deleteClub($id)
{
    $clubModel = new \App\Models\ClubModel();
    $club = $clubModel->find($id);

    if (!$club) {
        return redirect()->to('admin/clubs')->with('error', 'Club introuvable.');
    }

    $clubModel->delete($id);

    return redirect()->to('admin/clubs')->with('success', 'Club supprimé avec succès.');
}

/**
 * Modification du mot de passe (admin ou user)
 */
public function changePassword()
{
    helper(['form']);

    // Règles de validation avec labels et messages personnalisés
    $rules = [
        'current_password' => [
            'label' => 'Mot de passe actuel',
            'rules' => 'required',
            'errors' => [
                'required' => 'Le champ {field} est requis.',
            ],
        ],
        'new_password' => [
            'label' => 'Nouveau mot de passe',
            'rules' => 'required|min_length[6]',
            'errors' => [
                'required'   => 'Le champ {field} est requis.',
                'min_length' => 'Le champ {field} doit contenir au moins 6 caractères.',
            ],
        ],
        'confirm_password' => [
            'label' => 'Confirmation du mot de passe',
            'rules' => 'required|matches[new_password]',
            'errors' => [
                'required' => 'Le champ {field} est requis.',
                'matches'  => 'Le champ {field} ne coïncide pas avec le champ Nouveau mot de passe.',
            ],
        ],
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->find(session()->get('id_user'));

    // Vérifie que le mot de passe actuel est correct
    if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
        return redirect()->back()->withInput()->with('errors', [
            'current_password' => 'Mot de passe actuel incorrect.'
        ]);
    }

    // Mise à jour du mot de passe
    $userModel->update(session()->get('id_user'), [
        'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
    ]);

    return redirect()->to('admin/dashboard')->with('success', 'Mot de passe mis à jour avec succès.');
}


 
public function editPassword()
{
    return view('admin/change_password'); 
}


}











