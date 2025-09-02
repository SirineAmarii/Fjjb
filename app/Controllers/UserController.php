<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ClubModel;

class UserController extends BaseController
{
    public function userDashboard()
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'licencié') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $user = $userModel
            ->select('users.*, clubs.name as club_name')
            ->join('clubs', 'clubs.id_club = users.club_id', 'left')
            ->where('users.id_user', session()->get('id_user'))
            ->first();

        if (!$user) {
            return redirect()->to('/')->with('error', 'Utilisateur introuvable');
        }

        
        return view('user/user_dashboard', ['user' => $user]);
    }

    public function editProfile()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    $userModel = new UserModel();
    $clubModel = new ClubModel();

    $user = $userModel->find(session()->get('id_user'));
    $clubs = $clubModel->findAll();

   
    $belts = ['blanche', 'bleue', 'violette', 'marron', 'noire'];

    return view('user/edit_profile', [
        'user' => $user,
        'clubs' => $clubs,
        'belts' => $belts
    ]);
}


    public function updateProfile()
{
    helper(['form']);

    $userModel = new UserModel();
    $id = session()->get('id_user');
    $user = $userModel->find($id); 

    $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|valid_email',
        'belt'       => 'required',
        'club_id'    => 'permit_empty|integer',
        'photo'      => 'if_exist|is_image[photo]|max_size[photo,2048]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
    }

    $data = [
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
        'email'      => $this->request->getPost('email'),
        'belt'       => $this->request->getPost('belt'),
        'club_id'    => $this->request->getPost('club_id')
    ];

    $photo = $this->request->getFile('photo');

    if ($photo && $photo->isValid() && !$photo->hasMoved()) {
        // Supprimer l'ancienne photo si elle existe
        if (!empty($user['photo']) && file_exists('uploads/users/' . $user['photo'])) {
            unlink('uploads/users/' . $user['photo']);
        }

        $newName = $photo->getRandomName();
        $photo->move('uploads/users/', $newName);
        $data['photo'] = $newName;
    }

    $userModel->update($id, $data);

    return redirect()->to('user-dashboard')->with('success', 'Profil mis à jour.');
}


    public function changePassword()
{
    if (!session()->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    return view('user/change_password');
}

public function updatePassword()
{
    helper(['form']);

    $rules = [
        'current_password' => 'required',
        'new_password' => 'required|min_length[6]',
        'confirm_password' => 'required|matches[new_password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
    }

    $userModel = new \App\Models\UserModel();
    $user = $userModel->find(session()->get('id_user'));

    if (!password_verify($this->request->getPost('current_password'), $user['password'])) {
        return redirect()->back()->withInput()->with('error', ['current_password' => 'Mot de passe actuel incorrect.']);
    }

    $userModel->update(session()->get('id_user'), [
        'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
    ]);

    return redirect()->to('user-dashboard')->with('success', 'Mot de passe mis à jour avec succès.');
}

}
