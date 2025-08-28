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

}