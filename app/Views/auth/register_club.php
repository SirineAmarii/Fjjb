<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Inscription Club</h2>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error): ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>


<?php if (session()->getFlashdata('success')) : ?>
  <div class="alert success">
    <?= esc(session()->getFlashdata('success')) ?>
  </div>
<?php endif; ?>

    <form action="<?= base_url('inscription-club') ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="club_name">Nom du club</label>
        <input type="text" name="club_name" value="<?= old('club_name') ?>" required>
      </div>

        <div class="form-group">
        <label for="first_name"> Prénom du gérant</label>
        <input type="text" name="first_name" value="<?= old('first_name') ?>" required>
      </div>
      
      <div class="form-group">
        <label for="last_name">Nom du gérant</label>
        <input type="text" name="last_name" value="<?= old('last_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_email">Email du club</label>
        <input type="email" name="club_email" value="<?= old('club_email') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_phone">Téléphone du club</label>
        <input type="text" name="club_phone" value="<?= old('club_phone') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_address">Adresse du club</label>
        <input type="text" name="club_address" value="<?= old('club_address') ?>" required>
      </div>

      <div class="form-group">
        <label for="club_city">Ville du club</label>
        <input type="text" name="club_city" value="<?= old('club_city') ?>" required>
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="photo">Logo du club (optionnel)</label>
        <input type="file" name="photo">
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">S’inscrire</button>
        <a href="<?= base_url('connexion') ?>" class="btn light">Retour</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>