<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FJJB - Fédération de Jiu-Jitsu Brésilien</title>

  <!-- Feuille de style principale -->
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">

  <!-- Icônes Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- Favicon du site -->
  <link rel="icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">

  <!-- Script JavaScript personnalisé -->
  <script src="<?= base_url('public/assets/js/script.js') ?>"></script>
</head>
<body>

<?php $current = uri_string(); ?> <!-- Récupère le chemin actuel de l'URL -->

<header>
  <div class="container">
    <!-- Logo du site -->
    <img src="<?= base_url('public/assets/images/logo-fjjb.png') ?>" alt="Logo FJJB" class="logo">

    <!-- Navigation principale -->
    <nav>
      <!-- Affiche le lien "Accueil" sauf si on est déjà sur la page d'accueil -->
      <?php if ($current != ''): ?>
        <a href="<?= base_url('/') ?>">Accueil</a>
      <?php endif; ?>

      <!-- Lien vers la page des compétitions -->
      <?php if ($current != 'competitions'): ?>
        <a href="<?= base_url('competitions') ?>">Compétitions</a>
      <?php endif; ?>

      <!-- Lien vers la page des clubs -->
      <?php if ($current != 'clubs'): ?>
        <a href="<?= base_url('clubs') ?>">Clubs</a>
      <?php endif; ?>

      <!-- Lien vers la page des résultats -->
      <?php if ($current != 'resultats'): ?>
        <a href="<?= base_url('resultats') ?>">Résultats</a>
      <?php endif; ?>
    </nav>

    <!-- Affichage conditionnel selon la connexion de l'utilisateur -->
    <?php if (session()->get('isLoggedIn')): ?>
      <!-- Si connecté : bouton vers l'espace licencié -->
     
      <a href="<?= base_url('user/dashboard') ?>" class="btn-connexion">Espace licencié</a>

    <?php else: ?>
      <!-- Si non connecté : bouton de connexion -->
      <a href="<?= base_url('login') ?>" class="btn-connexion">Connexion</a>
    <?php endif; ?>

  </div>
</header>