<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FJJB - Fédération de Jiu-Jitsu Brésilien</title>
  <link rel="stylesheet" href="<?= base_url('public/assets/css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">


</head>
<body>

<header>
  <div class="container">
  <img src="<?= base_url('public/assets/images/logo-fjjb.png') ?>" alt="Logo FJJB" class="logo">

    <nav>
      <a href="<?= base_url('/') ?>">Accueil</a>
      <a href="<?= base_url('competitions') ?>">Compétitions</a>
      <a href="<?= base_url('clubs') ?>">Clubs</a>
      <a href="<?= base_url('resultats') ?>">Résultats</a>
    </nav>

    <a href="<?= base_url('connexion') ?>" class="btn-connexion">Connexion</a>
  </div>
</header>