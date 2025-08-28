<?php // login_view.php ?>

<!-- Inclut l'en-tête de la page -->
<?= view('includes/header') ?>

<!-- Section principale de la page de connexion -->
<section class="login-page">
  <div class="login-box">
    <h2>Connexion à l’espace licencié</h2>

    <!-- Affiche un message d'erreur si la session contient une erreur -->
    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')) : ?>
  <div class="alert success">
    <?= esc(session()->getFlashdata('success')) ?>
  </div>
<?php endif; ?>

    <!-- Formulaire de connexion -->
    <form action="<?= base_url('connexion') ?>" method="post">
      <!-- Champ de l'email -->
      <input type="email" name="email" placeholder="Adresse e-mail" required>

      <!-- Champ du mot de passe -->
      <input type="password" name="password" placeholder="Mot de passe" required>

      <!-- Bouton de soumission du formulaire -->
      <button type="submit" class="btn red full">Se connecter</button>
    </form>

    <!-- Lien vers la page d'inscription -->
    <p class="register-link">
      Pas encore inscrit ? <a href="<?= base_url('inscription-licencie') ?>">Créez un compte</a>
   
    </p>

   
      
  
  </div>
</section>

<!-- Inclut le pied de page -->
<?= view('includes/footer') ?>




