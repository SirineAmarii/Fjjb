<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function mentions()
    {
        return view('legal/mentions_legales_view');
    }

    public function confidentialite()
    {
        return view('legal/confidentialite_view');
    }

    public function conditions()
    {
        return view('legal/conditions_view');
    }

    public function contact()
    {
        return view('legal/contact_view');
    }
}