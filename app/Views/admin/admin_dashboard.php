<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Bienvenue, Admin</h2>
    <p class="intro">Accédez à toutes les fonctionnalités d'administration.</p>

    <div class="dashboard-actions">
      <a href="<?= base_url('admin/competitions') ?>" class="btn">Gérer les compétitions</a>
      <a href="<?= base_url('admin/clubs') ?>" class="btn">Gérer les clubs</a>
      <a href="<?= base_url('admin/users') ?>" class="btn">Gérer les utilisateurs</a>
      <a href="<?= base_url('logout') ?>" class="btn red">Déconnexion</a>
    </div>
  </div>
</section>

<?= view('includes/footer') ?>

