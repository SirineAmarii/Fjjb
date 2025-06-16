<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Inscription d’un club</h2>

    <!-- Affichage des erreurs de validation -->
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error): ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Message de succès après inscription -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert success">
        <?= esc(session()->getFlashdata('success')) ?>
      </div>
    <?php endif; ?>

    <!-- Formulaire d'inscription club -->
    <form action="<?= base_url('inscription-club') ?>" method="post" enctype="multipart/form-data">
      
      <!-- Informations du club -->
      <div class="form-group">
        <label for="club_name">Nom du club</label>
        <input type="text" name="club_name" value="<?= old('club_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_email">Email du club</label>
        <input type="email" name="club_email" value="<?= old('club_email') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_phone">Téléphone</label>
        <input type="text" name="club_phone" value="<?= old('club_phone') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_address">Adresse</label>
        <input type="text" name="club_address" value="<?= old('club_address') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_city">Ville</label>
        <input type="text" name="club_city" value="<?= old('club_city') ?>" required>
      </div>

      <!-- Informations de connexion -->
      <div class="form-group">
        <label for="first_name">Prénom du représentant</label>
        <input type="text" name="first_name" value="<?= old('first_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Nom du représentant</label>
        <input type="text" name="last_name" value="<?= old('last_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="photo">Logo du club (optionnel)</label>
        <input type="file" name="photo" accept="image/*">
      </div>

      <!-- Actions -->
      <div class="form-actions">
        <button type="submit" class="btn blue">S’inscrire</button>
        <a href="<?= base_url('connexion') ?>" class="btn light">Retour</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
