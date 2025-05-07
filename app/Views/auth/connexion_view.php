<?= view('includes/header') ?>

<section class="login-page">
  <div class="login-box">
    <h2>Connexion à l’espace licencié</h2>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('connexion') ?>" method="post">
      <input type="email" name="email" placeholder="Adresse e-mail" required>
      <input type="password" name="password" placeholder="Mot de passe" required>
      <button type="submit" class="btn red full">Se connecter</button>
    </form>

    <p class="register-link">
      Pas encore inscrit ? <a href="<?= base_url('inscription') ?>">Créez un compte</a>
    </p>
  </div>
</section>

<?= view('includes/footer') ?>

