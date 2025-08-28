<?php

namespace App\Controllers;

use App\Models\ClubModel;

class ClubController extends BaseController
{
    /**
     * Affiche la liste des clubs avec recherche et pagination.
     */
    public function index()
    {
        $clubModel = new ClubModel();
        $query = $this->request->getGet('q');

        $builder = $clubModel->where('visible', 1);

        if (!empty($query)) {
            $builder->groupStart()
                ->like('name', $query)
                ->orLike('city', $query)
                ->groupEnd();
        }

        // Appliquer pagination
        $data['clubs'] = $builder->paginate(3);
        $data['pager'] = $clubModel->pager;
        $data['search'] = $query; // Pour que le champ garde la valeur et afficher "Réinitialiser"

        return view('index/clubs_view', $data);
    }
}


