<?php

namespace App\Controllers;

class Competitions extends BaseController
{
    public function index()
    {
        return view('index/competitions_view');
    }
}
