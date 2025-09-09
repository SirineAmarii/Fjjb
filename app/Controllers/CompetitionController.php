<?php

namespace App\Controllers;

class CompetitionController extends BaseController
{
public function index()
{
    $competitionModel = new \App\Models\CompetitionModel();

    $data['competitions'] = $competitionModel->paginate(3); // 3 compétitions par page
    $data['pager'] = $competitionModel->pager;

    return view('index/competitions_view', $data);
}



}
