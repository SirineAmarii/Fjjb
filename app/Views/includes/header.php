<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FJJB - Fédération de Jiu-Jitsu Brésilien</title>
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">
  <script src="<?= base_url('public/assets/js/script.js') ?>"></script>



</head>
<body>

<?php $current = uri_string(); ?>

<header>
  <div class="container">
  <img src="<?= base_url('public/assets/images/logo-fjjb.png') ?>" alt="Logo FJJB" class="logo">

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


    <?php if (session()->get('isLoggedIn')): ?>
  <a href="<?= base_url('espace-licencie') ?>" class="btn-connexion">Espace licencié</a>
<?php else: ?>
  
  <a href="<?= base_url('connexion') ?>" class="btn-connexion">Connexion</a>
<?php endif; ?>

  </div>
</header>