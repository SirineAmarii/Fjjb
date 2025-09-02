<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        $competitionModel = new \App\Models\CompetitionModel();
    
       
        $data['competitions'] = $competitionModel
            ->where('event_date >=', date('Y-m-d')) 
            ->orderBy('event_date', 'ASC')
            ->limit(3)
            ->find();
    
        return view('index/home_view', $data);
    }
    

    
}
