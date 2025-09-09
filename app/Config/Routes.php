<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*Index*/
$routes->get('/', 'HomeController::index'); // Page d'accueil
$routes->get('/competitions', 'CompetitionController::index'); // Liste des compétitions
$routes->get('/clubs', 'ClubController::index'); // Liste des clubs
$routes->get('/resultats', 'ResultController::index'); // Liste des résultats

/*Routes live search*/
$routes->get('results/search', 'ResultController::search');

/*Routes Auth*/
$routes->get('connexion', 'AuthController::login');
$routes->post('connexion', 'AuthController::loginPost'); // Envoie les données du formulaire
$routes->match(['get', 'post'], 'connexion', 'AuthControllerController::login'); // Route mixte (à corriger, nom du contrôleur doublé)

$routes->get('inscription', 'AuthController::register'); // Affiche le formulaire d'inscription
$routes->post('inscription', 'AuthController::register'); // Enregistre l'inscription

$routes->get('deconnexion', 'AuthController::logout'); // Déconnexion de l'utilisateur


/*Routes User*/
$routes->get('user/dashboard', 'UserController::userDashboard'); // Tableau de bord utilisateur
$routes->get('user/edit', 'UserController::editProfile'); // Modifier son profil
$routes->post('user/edit', 'UserController::updateProfile'); // Sauvegarder les modifications du profil
$routes->get('user/password', 'UserController::changePassword'); // Formulaire changement de mot de passe
$routes->post('user/password', 'UserController::updatePassword'); // Enregistrement du nouveau mot de passe


/*Routes Admin*/
$routes->get('admin/dashboard', 'AdminController::dashboard'); // Tableau de bord admin
$routes->get('admin/users', 'AdminController::manageUsers'); // Gérer les utilisateurs
$routes->get('admin/clubs', 'AdminController::manageClubs'); // Gérer les clubs
$routes->get('admin/competitions', 'AdminController::manageCompetitions'); // Gérer les compétitions


$routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1'); // Modifier un utilisateur
$routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1'); // Sauvegarder modif utilisateur
$routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1'); // Supprimer un utilisateur
$routes->get('admin/users/add', 'AdminController::addUser'); // Formulaire ajout utilisateur
$routes->post('admin/users/create', 'AdminController::createUser'); // Enregistrer un nouvel utilisateur
$routes->get('admin/modifier-mot-de-passe', 'AdminController::editPassword'); // Formulaire changer mot de passe
$routes->post('admin/change-password', 'AdminController::changePassword'); // Enregistre le nouveau mot de passe


$routes->get('admin/competition/edit/(:num)', 'AdminController::editCompetition/$1'); // Modifier une compétition
$routes->post('admin/competitions/update/(:num)', 'AdminController::updateCompetition/$1'); // Sauvegarder modif compétition
$routes->get('admin/competition/delete/(:num)', 'AdminController::deleteCompetition/$1'); // Supprimer une compétition
$routes->get('admin/competition/add', 'AdminController::addCompetition'); // Formulaire ajout compétition
$routes->post('admin/competition/create', 'AdminController::createCompetition'); // Enregistrer une nouvelle compétition

$routes->get('admin/club/edit/(:num)', 'AdminController::editClub/$1'); // Modifier un club
$routes->post('admin/clubs/update/(:num)', 'AdminController::updateClub/$1'); // Sauvegarder modif club  
$routes->get('admin/clubs/add', 'AdminController::addClub');// Formulaire ajout club
$routes->post('admin/clubs/create', 'AdminController::createClub'); // Enregistrer un nouveau club
$routes->post('admin/clubs/store', 'AdminController::storeClub'); // Enregistrer un nouveau club
$routes->get('admin/club/delete/(:num)', 'AdminController::deleteClub/$1'); // Supprimer un club

/*Routes Pages statiques*/
$routes->get('mentions-legales', 'PageController::mentions'); // Page mentions légales
$routes->get('politique-confidentialite', 'PageController::confidentialite'); // Page politique de confidentialité
$routes->get('conditions-utilisation', 'PageController::conditions'); // Page conditions d'utilisation
$routes->get('contact', 'PageController::contact'); // Page de contact











