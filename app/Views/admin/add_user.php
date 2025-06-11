<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Ajouter un nouvel utilisateur</h2>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error) : ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/users/create') ?>" method="post" enctype="multipart/form-data" class="form-vertical">

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
        <?php
          $belts = ['blanche', 'bleue', 'violette', 'marron', 'noire'];
          $selectedBelt = old('belt') ?? '';
        ?>
        <select name="belt" id="belt" required>
          <option value="">Choisir une ceinture</option>
          <?php foreach ($belts as $belt): ?>
            <option value="<?= esc($belt) ?>" <?= ($selectedBelt === $belt) ? 'selected' : '' ?>>
              <?= ucfirst($belt) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" id="role" required>
          <option value="">Choisir un rôle</option>
          <option value="licencié" <?= old('role') === 'licencié' ? 'selected' : '' ?>>Licencié</option>
          <option value="club" <?= old('role') === 'club' ? 'selected' : '' ?>>Club</option>
          <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="photo">Photo (facultatif)</label>
        <input type="file" name="photo" id="photo">
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Ajouter</button>
        <a href="<?= base_url('admin/users') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>

