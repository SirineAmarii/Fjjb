<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CompetitionModel;
use App\Models\ClubModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $clubModel = new ClubModel();
        $competitionModel = new CompetitionModel();

        $data = [
            'nb_users' => $userModel->countAllResults(),
            'nb_clubs' => $clubModel->countAllResults(),
            'nb_compets' => $competitionModel->countAllResults(),
            'admin_name' => session()->get('prenom')
        ];

        return view('admin/admin_dashboard', $data);

    }

    public function manageUsers()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $userModel = new \App\Models\UserModel();
    $users = $userModel->findAll();

    return view('admin/users_list', ['users' => $users]);
}

public function manageClubs()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $clubModel = new \App\Models\ClubModel();
    $clubs = $clubModel->findAll();

    return view('admin/clubs_list', ['clubs' => $clubs]);
}

public function manageCompetitions()
{
    if (!session()->get('isLoggedIn') || session()->get('role') !== 'admin') {
        return redirect()->to('/');
    }

    $competitionModel = new \App\Models\CompetitionModel();
    $competitions = $competitionModel->findAll();

    return view('admin/competitions_list', ['competitions' => $competitions]);
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
        'prenom'   => 'required',
        'nom'      => 'required',
        'ceinture' => 'required',
        'role'     => 'required'
    ];

    // Appliquer is_unique seulement si l’email est modifié
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

    // Mise à jour
    $userModel->update($id, [
        'prenom'   => $this->request->getPost('prenom'),
        'nom'      => $this->request->getPost('nom'),
        'email'    => $email,
        'ceinture' => $this->request->getPost('ceinture'),
        'role'     => $this->request->getPost('role'),
        'photo'    => $photoName
    ]);

    return redirect()->to('admin/users')->with('success', 'Utilisateur mis à jour avec succès.');
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


}












