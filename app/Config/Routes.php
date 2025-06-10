<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*Index*/

$routes->get('/', 'Home::index');
$routes->get('/competitions', 'Competitions::index');
$routes->get('/clubs', 'Clubs::index');
$routes->get('/resultats', 'Results::index');


$routes->match(['get', 'post'], 'inscription', 'Auth::inscription');
$routes->get('connexion', 'Auth::login');
$routes->post('connexion', 'Auth::loginPost');
$routes->match(['get', 'post'], 'connexion', 'Auth::login');
$routes->get('user/dashboard', 'Auth::userDashboard');
$routes->get('deconnexion', 'Auth::logout');


$routes->get('admin/dashboard', 'Admin::dashboard');
$routes->get('admin/users', 'Admin::manageUsers');
$routes->get('admin/clubs', 'Admin::manageClubs');
$routes->get('admin/competitions', 'Admin::manageCompetitions');
$routes->get('admin/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('admin/users/update/(:num)', 'Admin::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'Admin::deleteUser/$1');




 $routes->get('competitions/search', 'Competitions::search');


$routes->get('mentions-legales', 'Pages::mentions');
$routes->get('politique-confidentialite', 'Pages::confidentialite');
$routes->get('conditions-utilisation', 'Pages::conditions');
$routes->get('contact', 'Pages::contact');
