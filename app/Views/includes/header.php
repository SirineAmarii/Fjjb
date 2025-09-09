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

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">

  
 

</head>
<body>

<?php $current = uri_string(); ?>

<header>
  <div class="container">
    <!-- Logo -->
    <img src="<?= base_url('public/assets/images/logo-fjjb.png') ?>" alt="Logo FJJB" class="logo">

    <!-- Navigation -->
    <nav>
      <?php if ($current != ''): ?>
        <a href="<?= base_url('/') ?>">Accueil</a>
      <?php endif; ?>

      <?php if ($current != 'competitions'): ?>
        <a href="<?= base_url('competitions') ?>">Compétitions</a>
      <?php endif; ?>

      <?php if ($current != 'clubs'): ?>
        <a href="<?= base_url('clubs') ?>">Clubs</a>
      <?php endif; ?>

      <?php if ($current != 'resultats'): ?>
        <a href="<?= base_url('resultats') ?>">Résultats</a>
      <?php endif; ?>
    </nav>

    
    <!-- Bouton Connexion / Espace Admin / Espace Licencié -->
<div class="user-actions">
  <?php if (session()->get('isLoggedIn')): ?>

    <?php if (session()->get('role') === 'admin'): ?>
      <a href="<?= base_url('admin/dashboard') ?>" class="btn-connexion">Espace admin</a>

    <?php elseif (session()->get('role') === 'licencié'): ?>
      <a href="<?= base_url('user/dashboard') ?>" class="btn-connexion">Espace licencié</a>
    <?php endif; ?>

    <a href="<?= base_url('deconnexion') ?>" class="btn-connexion red">Déconnexion</a>

  <?php else: ?>
    <a href="<?= base_url('connexion') ?>" class="btn-connexion">Connexion</a>
    <a href="<?= base_url('inscription') ?>" class="btn-connexion">Inscription</a>
  <?php endif; ?>
</div>
  </div>
</header>
