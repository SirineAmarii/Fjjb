<?php

namespace App\Controllers;

use App\Models\ClubModel;
use CodeIgniter\Controller;

class ClubController extends BaseController


{
    public function index()
    {
        $clubModel = new ClubModel();
        $search = $this->request->getGet('q');
        $cityFilter = $this->request->getGet('city');

      if ($search || $cityFilter) {
    $builder = $clubModel;
    
    if ($search) {
        $builder = $builder->like('name', $search)->orLike('city', $search);
    }

    if ($cityFilter) {
        $builder = $builder->where('city', $cityFilter);
    }

    $clubs = $builder->findAll();
} else {
    $clubs = $clubModel->findAll();
}


        return view('index/clubs_view', [
            'clubs' => $clubs,
            'search' => $search,
            'cityFilter' => $cityFilter
        ]);
    }

    


}
