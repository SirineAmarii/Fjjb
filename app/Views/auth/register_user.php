<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Inscription Licencié</h2>

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

    <form action="<?= base_url('inscription-licencie') ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= old('first_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= old('last_name') ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Adresse email</label>
        <input type="email" name="email" value="<?= old('email') ?>" required>
      </div>

      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="belt">Ceinture</label>
        <select name="belt" required>
          <option value="">Choisir une ceinture</option>
          <?php 
            $belts = ['blanche', 'bleue', 'violette', 'marron', 'noire'];
            $selectedBelt = old('belt');
            foreach ($belts as $belt): ?>
              <option value="<?= $belt ?>" <?= $belt === $selectedBelt ? 'selected' : '' ?>>
                <?= ucfirst($belt) ?>
              </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="photo">Photo de profil (obligatoire)</label>
        <input type="file" name="photo">
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">S’inscrire</button>
        <a href="<?= base_url('login') ?>" class="btn light">Retour</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
