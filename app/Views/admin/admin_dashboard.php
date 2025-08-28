<?= view('includes/header') ?>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert green"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert red"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>


<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Bienvenue, Admin</h2>
    <p class="intro">Accédez à toutes les fonctionnalités d'administration.</p>

    <div class="dashboard-actions">
      <a href="<?= base_url('admin/competitions') ?>" class="btn">Gérer les compétitions</a>
      <a href="<?= base_url('admin/clubs') ?>" class="btn">Gérer les clubs</a>
      <a href="<?= base_url('admin/users') ?>" class="btn">Gérer les utilisateurs</a>
      <a href="<?= base_url('admin/modifier-mot-de-passe') ?>" class="btn">Modifier mon mot de passe</a>
      
    </div>
  </div>
</section>

<?= view('includes/footer') ?>

