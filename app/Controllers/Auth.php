<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function connexion()
    {
        helper(['form']);
        
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            
            $userModel = new UserModel();
            $user = $userModel->where('email', $email)->first();

            if ($user && password_verify($password, $user['password'])) {
                session()->set([
                    'user_id' => $user['id'],
                    'prenom' => $user['prenom'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/espace-licencie');
            } else {
                return redirect()->back()->with('error', 'Email ou mot de passe invalide');
            }
        }

        return view('auth/connexion_view');
    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('connexion');
        }
    
        $userModel = new \App\Models\UserModel();
        $user = $userModel
            ->select('users.*, clubs.nom AS club_nom')
            ->join('clubs', 'clubs.id = users.club_id', 'left')
            ->find(session()->get('user_id'));
    
        return view('auth/espace_licencie', ['user' => $user]);
    }
    


    public function deconnexion()
    {
        session()->destroy();
        return redirect()->to('/connexion');
    }
}
