<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Modifier mon profil</h2>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error): ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('user-edit') ?>" method="post">
      <div class="form-group">
        <label for="first_name">Prénom</label>
        <input type="text" name="first_name" value="<?= old('first_name', $user['first_name'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="last_name">Nom</label>
        <input type="text" name="last_name" value="<?= old('last_name', $user['last_name'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= old('email', $user['email'] ?? '') ?>" required>
      </div>

      <div class="form-group">
        <label for="belt">Ceinture</label>
        <?php
          $belts = ['blanche', 'bleue', 'violette', 'marron', 'noire'];
          $selectedBelt = old('belt', $user['belt'] ?? '');
        ?>
        <select name="belt" required>
          <option value="">Choisir une ceinture</option>
          <?php foreach ($belts as $belt): ?>
            <option value="<?= esc($belt) ?>" <?= $belt === $selectedBelt ? 'selected' : '' ?>>
              <?= ucfirst($belt) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="club_id">Club</label>
        <select name="club_id">
          <option value="">Aucun club</option>
          <?php foreach ($clubs as $club): ?>
            <option value="<?= $club['id_club'] ?>" <?= (old('club_id', $user['club_id'] ?? '') == $club['id_club']) ? 'selected' : '' ?>>
              <?= esc($club['name']) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Enregistrer</button>
        <a href="<?= base_url('user-dashboard') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>




