<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Modifier le club</h2>

          <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert success">
          <?= esc(session()->getFlashdata('success')) ?>
        </div>
      <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error) : ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/clubs/update/' . $club['id_club']) ?>" method="post" class="form-vertical">
      <div class="form-group">
        <label for="name">Nom du club</label>
        <input type="text" name="name" value="<?= old('name', $club['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" name="city" value="<?= old('city', $club['city']) ?>" required>
      </div>

      <div class="form-group">
        <label for="address">Adresse</label>
        <input type="text" name="address" value="<?= old('address', $club['address']) ?>">
      </div>

      <div class="form-group">
        <label for="phone">Téléphone</label>
        <input type="text" name="phone" value="<?= old('phone', $club['phone']) ?>">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" value="<?= old('email', $club['email']) ?>">
      </div>

      <div class="form-group">
        <label for="visible">Visible ?</label>
        <select name="visible">
          <option value="1" <?= old('visible', $club['visible']) == 1 ? 'selected' : '' ?>>Oui</option>
          <option value="0" <?= old('visible', $club['visible']) == 0 ? 'selected' : '' ?>>Non</option>
        </select>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Enregistrer</button>
        <a href="<?= base_url('admin/clubs') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
