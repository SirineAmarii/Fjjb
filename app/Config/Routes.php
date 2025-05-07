<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*Index*/

 $routes->get('/', 'Home::index');
 $routes->get('/competitions', 'Competitions::index');
 $routes->get('/clubs', 'Clubs::index');
 $routes->get('/resultats', 'Resultats::index');


$routes->match(['get', 'post'], 'connexion', 'Auth::connexion');
$routes->get('deconnexion', 'Auth::deconnexion');


$routes->get('inscription', 'Auth::register');
$routes->post('connexion', 'Auth::handleLogin');
$routes->get('espace-licencie', 'Auth::dashboard');
$routes->get('deconnexion', 'Auth::logout');


$routes->get('mentions-legales', 'Pages::mentions');
$routes->get('politique-confidentialite', 'Pages::confidentialite');
$routes->get('conditions-utilisation', 'Pages::conditions');
$routes->get('contact', 'Pages::contact');
