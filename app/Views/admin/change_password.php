<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Modifier mon mot de passe</h2>

    <?php if (session()->getFlashdata('errors')): ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('errors') as $field => $error): ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert green">
        <p><?= esc(session()->getFlashdata('success')) ?></p>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('user-password') ?>" method="post" class="form-vertical">
      <div class="form-group">
        <label for="current_password">Mot de passe actuel</label>
        <input type="password" name="current_password" required>
      </div>

      <div class="form-group">
        <label for="new_password">Nouveau mot de passe</label>
        <input type="password" name="new_password" required>
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirmer le nouveau mot de passe</label>
        <input type="password" name="confirm_password" required>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Enregistrer</button>
        <a href="<?= base_url('user-dashboard') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
