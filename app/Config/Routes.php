<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/*Index*/

$routes->get('/', 'HomeController::index');
$routes->get('/competitions', 'CompetitionController::index');
$routes->get('/clubs', 'ClubController::index');
$routes->get('/resultats', 'ResultController::index');



$routes->get('connexion', 'AuthController::login');
$routes->post('connexion', 'AuthController::loginPost');
$routes->match(['get', 'post'], 'connexion', 'AuthControllerController::login');

$routes->get('deconnexion', 'AuthController::logout');




$routes->get('inscription', 'AuthController::chooseRegistration');
$routes->get('inscription-licencie', 'AuthController::registerUser'); 
$routes->post('inscription-licencie', 'AuthController::createUser');
$routes->get('inscription-club', 'AuthController::registerClub');
$routes->post('inscription-club', 'AuthController::createClub');
$routes->match(['get', 'post'], 'inscription-club', 'Auth::createClub');



$routes->get('user-dashboard', 'UserController::userDashboard');
$routes->get('user-edit', 'UserController::editProfile');
$routes->post('user-edit', 'UserController::updateProfile');
$routes->get('user-password', 'UserController::changePassword');
$routes->post('user-password', 'UserController::updatePassword');



$routes->get('admin-dashboard', 'AdminController::dashboard');
$routes->get('admin/users', 'AdminController::manageUsers');
$routes->get('admin/clubs', 'AdminController::manageClubs');
$routes->get('admin/competitions', 'AdminController::manageCompetitions');
$routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1');
$routes->get('admin/users/add', 'AdminController::addUser');
$routes->post('admin/users/create', 'AdminController::createUser');

$routes->get('admin/competition/edit/(:num)', 'AdminController::editCompetition/$1');
$routes->post('admin/competitions/update/(:num)', 'AdminController::updateCompetition/$1');
$routes->get('admin/competition/delete/(:num)', 'AdminController::deleteCompetition/$1');
$routes->get('admin/competition/add', 'AdminController::addCompetition');
$routes->post('admin/competition/create', 'AdminController::createCompetition');

$routes->get('admin/club/edit/(:num)', 'AdminController::editClub/$1');
$routes->post('admin/clubs/update/(:num)', 'AdminController::updateClub/$1');
$routes->get('admin/clubs/add', 'AdminController::addClub');
$routes->post('admin/clubs/create', 'AdminController::createClub');
$routes->post('admin/clubs/store', 'AdminController::storeClub');
$routes->get('admin/club/delete/(:num)', 'AdminController::deleteClub/$1');





$routes->get('mentions-legales', 'PageController::mentions');
$routes->get('politique-confidentialite', 'PageController::confidentialite');
$routes->get('conditions-utilisation', 'PageController::conditions');
$routes->get('contact', 'PageController::contact');
