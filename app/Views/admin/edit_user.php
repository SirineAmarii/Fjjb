<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Modifier l’utilisateur</h2>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/users/update/' . $user['id_user']) ?>" method="post" enctype="multipart/form-data" class="form-vertical">

      <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" id="first_name" value="<?= esc($user['first_name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" id="last_name" value="<?= esc($user['last_name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Adresse e-mail</label>
        <input type="email" name="email" id="email" value="<?= esc($user['email']) ?>" required>
      </div>

      <div class="form-group">
        <label for="belt">Ceinture</label>
        <select name="belt" id="belt" required>
          <option value="">-- Sélectionner --</option>
          <?php
          $belts = ['blanche',  'bleu', 'violette', 'marron', 'noire'];
          foreach ($belts as $b) {
            $selected = ($user['belt'] === $b) ? 'selected' : '';
            echo "<option value=\"$b\" $selected>" . ucfirst($b) . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="role">Rôle</label>
        <select name="role" id="role" required>
          <option value="licencie" <?= $user['role'] === 'licencie' ? 'selected' : '' ?>>Licencié</option>
          <option value="club" <?= $user['role'] === 'club' ? 'selected' : '' ?>>Club</option>
          <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
      </div>

      <div class="form-group">
        <label for="photo">Photo (laisser vide pour ne pas modifier)</label>
        <input type="file" name="photo" id="photo">
        <?php if ($user['photo']) : ?>
          <p>Photo actuelle : <img src="<?= base_url('public/uploads/users/' . $user['photo']) ?>" alt="photo utilisateur" height="80"></p>
        <?php endif; ?>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Enregistrer</button>
        <a href="<?= base_url('admin/users') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>

