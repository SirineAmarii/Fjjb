<?php

namespace App\Controllers;

class Competitions extends BaseController
{
    public function index()
    {
        $competitionModel = new \App\Models\CompetitionModel();
        $query = $this->request->getGet('q');
    
        $builder = $competitionModel->where('visible', 1);

        if (trim($query) !== '') {
    $builder->groupStart()
        ->like('ville', $query)
        ->orLike('nom', $query)
        ->groupEnd();
}


    
        $data['competitions'] = $builder->orderBy('event_date', 'DESC')->findAll();
        return view('index/competitions_view', $data);
    }

public function search()
{
    if (!$this->request->isAJAX()) {
        return redirect()->to('/competitions');
    }

    $query = $this->request->getGet('q') ?? '';
    $model = new \App\Models\CompetitionModel();

    $builder = $model->where('visible', 1);

    if (trim($query) !== '') {
        $builder->groupStart()
                ->like('ville', $query)
                ->orLike('nom', $query)
                ->groupEnd();
    }

    $competitions = $builder->orderBy('event_date', 'DESC')->findAll();
    return view('index/_competitions_list', ['competitions' => $competitions]);

}


}
