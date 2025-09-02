<?php

namespace App\Controllers;

use App\Models\ResultModel;
use App\Models\UserModel;
use App\Models\CompetitionModel;

class ResultController extends BaseController
{
    public function index()
    {
        $resultModel = new ResultModel();
        $search = $this->request->getGet('q');
    
        $builder = $resultModel
            ->select('results.*, users.first_name, users.last_name, users.belt, clubs.name AS club_name, competitions.name AS competition_name, competitions.event_date')
            ->join('users', 'users.id_user = results.user_id')
            ->join('clubs', 'clubs.id_club = users.club_id')
            ->join('competitions', 'competitions.id_competition = results.competition_id');
    
        if (!empty($search)) {
            $builder->groupStart()
                ->like('users.first_name', $search)
                ->orLike('users.last_name', $search)
                ->orLike('competitions.name', $search)
                ->groupEnd();
        }
    
        $results = $builder->orderBy('competitions.event_date', 'DESC')->findAll();
    
        return view('index/results_view', [
            'results' => $results,
            'search' => $search
        ]);
    }

    public function search()
    {
        $query = $this->request->getGet('q');
    
        $resultModel = new \App\Models\ResultModel();
    
        $results = $resultModel
            ->select('results.*, users.first_name, users.last_name, users.photo, users.belt, clubs.name AS club_name, competitions.name AS competition_name, competitions.event_date')
            ->join('users', 'users.id_user = results.user_id')
            ->join('clubs', 'clubs.id_club = users.club_id')
            ->join('competitions', 'competitions.id_competition = results.competition_id')
            ->groupStart()
                ->like('users.first_name', $query)
                ->orLike('users.last_name', $query)
                ->orLike('competitions.name', $query)
            ->groupEnd()
            ->orderBy('competitions.event_date', 'DESC')
            ->findAll();
    
        return $this->response->setJSON($results);
    }
    

}
