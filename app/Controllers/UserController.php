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

        return view('user/edit_profile', [
            'user' => $user,
            'clubs' => $clubs
        ]);
    }

    public function updateProfile()
    {
        helper(['form']);

        $userModel = new UserModel();
        $id = session()->get('id_user');

        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|valid_email',
            'belt'       => 'required',
            'club_id'    => 'permit_empty|integer'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $userModel->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'belt'       => $this->request->getPost('belt'),
            'club_id'    => $this->request->getPost('club_id')
        ]);

        return redirect()->to('user-dashboard')->with('success', 'Profil mis à jour.');
    }
}
