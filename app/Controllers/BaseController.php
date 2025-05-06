<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseController extends Controller
{
    protected $helpers = [];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, 
                                    \CodeIgniter\HTTP\ResponseInterface $response, 
                                    \Psr\Log\LoggerInterface $logger)
    {
        // Ne PAS supprimer cette ligne :
        parent::initController($request, $response, $logger);

        // Charger des helpers si besoin :
        // $this->helpers = ['url', 'form'];
    }
}
