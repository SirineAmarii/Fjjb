<?= view('includes/header') ?>

<section class="register-page">
  <div class="register-box">
    <h2>Créer un compte licencié</h2>
    
    <form action="<?= base_url('inscription') ?>" method="post">
      <input type="text" name="prenom" placeholder="Prénom" required>
      <input type="text" name="nom" placeholder="Nom" required>
      <input type="email" name="email" placeholder="Adresse e-mail" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>
      <button type="submit" class="btn red full">Créer mon compte</button>
    </form>

    <p class="register-link">
      Déjà inscrit ? <a href="<?= base_url('connexion') ?>">Connectez-vous</a>
    </p>
  </div>
</section>

<?= view('includes/footer') ?>
