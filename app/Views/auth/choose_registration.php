<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Choisir le type d'inscription</h2>
    <div class="form-actions" style="flex-direction: column; align-items: center; gap: 2rem;">
      <a href="<?= base_url('inscription-licencie') ?>" class="btn blue">S'inscrire en tant que licencié</a>
      <a href="<?= base_url('inscription-club') ?>" class="btn blue">S'inscrire en tant que club</a>
    </div>
  </div>
</section>

<?= view('includes/footer') ?>
