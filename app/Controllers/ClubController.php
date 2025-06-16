<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class ClubController extends BaseController

{

    /**
     * Affiche la liste des clubs.
     * Permet de rechercher par nom ou ville.
     */

        public function index()
    {
        $clubModel = new \App\Models\ClubModel();
        $query = $this->request->getGet('q');

        $builder = $clubModel->where('visible', 1);

    if ($query) {
        $builder->groupStart()
            ->like('nom', $query)
            ->orLike('ville', $query)
            ->groupEnd();
    }

    
    
        // Charger les clubs visibles, paginés par 3
        $data['clubs'] = $clubModel->where('visible', 1)->paginate(3);
    
        // Passer le pager à la vue
        $data['pager'] = $clubModel->pager;
    
        return view('index/clubs_view', $data);
    }

    /**
     * Tableau de bord du club connecté.
     * Affiche la liste des licenciés liés à ce club.
     */
    public function dashboard()
    {
        // Vérifie si l'utilisateur est connecté et a le rôle 'club'
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'club') {
            return redirect()->to('/')->with('error', 'Accès non autorisé.');
        }

        $userModel = new UserModel();

        // Récupère les licenciés du club connecté (relation via club_id)
        $licencies = $userModel
            ->where('club_id', session()->get('id_user'))
            ->where('role', 'licencié')
            ->findAll();

        // Charge la vue avec la liste des licenciés
        return view('club/club_dashboard', [
            'licencies' => $licencies
        ]);
    }

    /**
     * Affiche le formulaire de modification des informations d’un licencié.
     *
     * @param int $id ID du licencié à modifier
     */
    public function editLicencie($id)
    {
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'club') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $licencie = $userModel->find($id);

        if (!$licencie || $licencie['club_id'] != session()->get('id_user')) {
            return redirect()->to('club-dashboard')->with('error', 'Licencié non autorisé.');
        }

        return view('club/edit_licencie', ['licencie' => $licencie]);
    }

    /**
     * Met à jour les informations d’un licencié (nom, email, ceinture…).
     *
     * @param int $id ID du licencié à modifier
     */
    public function updateLicencie($id)
    {
        helper(['form']);

        $userModel = new UserModel();
        $licencie = $userModel->find($id);

        if (!$licencie || $licencie['club_id'] != session()->get('id_user')) {
            return redirect()->to('club-dashboard')->with('error', 'Accès refusé.');
        }

        // Validation
        $rules = [
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|valid_email',
            'belt'       => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        // Mise à jour
        $userModel->update($id, [
            'first_name' => $this->request->getPost('first_name'),
            'last_name'  => $this->request->getPost('last_name'),
            'email'      => $this->request->getPost('email'),
            'belt'       => $this->request->getPost('belt'),
        ]);

        return redirect()->to('club-dashboard')->with('success', 'Licencié mis à jour.');
    }
}
