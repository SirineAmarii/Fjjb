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

$routes->get('logout', 'Auth::logout');


$routes->get('login', function() {
    return redirect()->to('connexion');
});

$routes->get('user-dashboard', 'UserController::userDashboard');
$routes->get('user-edit', 'UserController::editProfile');
$routes->post('user-update', 'UserController::updateProfile');


$routes->get('admin-dashboard', 'Admin::dashboard');
$routes->get('admin/users', 'Admin::manageUsers');
$routes->get('admin/clubs', 'Admin::manageClubs');
$routes->get('admin/competitions', 'Admin::manageCompetitions');
$routes->get('admin/users/edit/(:num)', 'Admin::editUser/$1');
$routes->post('admin/users/update/(:num)', 'Admin::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'Admin::deleteUser/$1');
$routes->get('admin/users/add', 'Admin::addUser');
$routes->post('admin/users/create', 'Admin::createUser');

$routes->get('admin/competition/edit/(:num)', 'Admin::editCompetition/$1');
$routes->post('admin/competitions/update/(:num)', 'Admin::updateCompetition/$1');
$routes->get('admin/competition/delete/(:num)', 'Admin::deleteCompetition/$1');
$routes->get('admin/competition/add', 'Admin::addCompetition');
$routes->post('admin/competition/create', 'Admin::createCompetition');

$routes->get('admin/club/edit/(:num)', 'Admin::editClub/$1');
$routes->post('admin/clubs/update/(:num)', 'Admin::updateClub/$1');
$routes->get('admin/clubs/add', 'Admin::addClub');
$routes->post('admin/clubs/create', 'Admin::createClub');
$routes->post('admin/clubs/store', 'Admin::storeClub');
$routes->get('admin/club/delete/(:num)', 'Admin::deleteClub/$1');





$routes->get('mentions-legales', 'Pages::mentions');
$routes->get('politique-confidentialite', 'Pages::confidentialite');
$routes->get('conditions-utilisation', 'Pages::conditions');
$routes->get('contact', 'Pages::contact');
