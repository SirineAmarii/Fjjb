<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ClubModel;


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

    public function inscription()
    {
        helper(['form']);
    
        $clubModel = new \App\Models\ClubModel();
        $clubs = $clubModel->findAll();
    
        if ($this->request->getMethod() === 'post') {
    
            $validationRules = [
                'prenom' => 'required',
                'nom' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'password_confirm' => 'matches[password]',
                'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,2048]'
            ];
    
            $messages = [
                'prenom' => ['required' => 'Le prénom est requis.'],
                'nom' => ['required' => 'Le nom est requis.'],
                'email' => [
                    'required' => 'L’adresse e-mail est requise.',
                    'valid_email' => 'L’adresse e-mail n’est pas valide.',
                    'is_unique' => 'Cette adresse e-mail est déjà utilisée.'
                ],
                'password' => [
                    'required' => 'Le mot de passe est requis.',
                    'min_length' => 'Le mot de passe doit contenir au moins 6 caractères.'
                ],
                'password_confirm' => [
                    'matches' => 'La confirmation du mot de passe ne correspond pas.'
                ],
                'photo' => [
                    'uploaded' => 'Veuillez ajouter une photo.',
                    'is_image' => 'Le fichier doit être une image.',
                    'max_size' => 'L’image est trop lourde (max 2 Mo).'
                ]
            ];
    
            if (!$this->validate($validationRules, $messages)) {
                return view('auth/register_view', [
                    'validation' => $this->validator,
                    'clubs' => $clubs
                ]);
            }
    
            // Gestion du club : sélection ou nouveau
            $newClubName = trim($this->request->getPost('new_club'));
            $clubId = $this->request->getPost('club_id');
    
            if (!$clubId && $newClubName !== '') {
                $clubId = $clubModel->insert([
                    'nom' => $newClubName,
                    'ville' => null,
                    'adresse' => null,
                    'telephone' => null,
                    'email' => null,
                    'visible' => 0
                ]);
            }
    
            // Upload de la photo
            $photo = $this->request->getFile('photo');
            $photoName = $photo->getRandomName();
            $photo->move('public/uploads/users', $photoName);
    
            // Insertion en base
            $userModel = new \App\Models\UserModel();
            $userModel->save([
                'prenom' => $this->request->getPost('prenom'),
                'nom' => $this->request->getPost('nom'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'photo' => $photoName,
                'ceinture' => $this->request->getPost('ceinture'),
                'club_id' => $clubId,
                'role' => 'licencié'
            ]);
    
            // Connexion automatique
            session()->set([
                'user_id' => $userModel->insertID(),
                'prenom' => $this->request->getPost('prenom'),
                'role' => 'licencié',
                'isLoggedIn' => true
            ]);
    
            return redirect()->to('auth/espace-licencie')->with('success', 'Bienvenue dans ton espace licencié !');
        }
    
        return view('auth/register_view', ['clubs' => $clubs]);
    }
    

    
    public function espaceLicencie()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/connexion');
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
