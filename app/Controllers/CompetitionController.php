<?php

namespace App\Controllers;

class CompetitionController extends BaseController
{
    public function index()
    {
        $competitionModel = new \App\Models\CompetitionModel();
        $query = $this->request->getGet('q');

        $builder = $competitionModel->where('visible', 1);

        if (trim($query) !== '') {
            $builder->groupStart()
                ->like('city', $query)
                ->orLike('name', $query)
                ->groupEnd();
        }

        $data['competitions'] = $builder->orderBy('event_date', 'DESC')->findAll();
        $data['search'] = $query; // 👈 AJOUT OBLIGATOIRE pour réutiliser dans la vue
        return view('index/competitions_view', $data);
    }
}
