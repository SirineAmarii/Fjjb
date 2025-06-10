<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Bienvenue, <?= esc($user['first_name']) ?> 👋</h2>

    <div class="profile-section">
      <img src="<?= base_url('public/uploads/users/' . esc($user['photo'])) ?>" alt="Photo de profil">
      <ul>
        <li><strong>Ceinture :</strong> <?= esc($user['belt']) ?></li>
        <li><strong>Club :</strong> <?= esc($user['club_nom']) ?></li>
        <li><strong>Email :</strong> <?= esc($user['email']) ?></li>
      </ul>
    </div>

    <div class="dashboard-actions">
      <a href="<?= base_url('results') ?>" class="btn">Voir mes résultats</a>
      <a href="<?= base_url('competitions') ?>" class="btn">Voir les compétitions</a>
      <a href="<?= base_url('deconnexion') ?>" class="btn red">Se déconnecter</a>

    </div>
    <?php if (session()->getFlashdata('success')): ?>
  <div class="alert success">
    <?= session()->getFlashdata('success') ?>
  </div>
<?php endif; ?>

  </div>
</section>

<?= view('includes/footer') ?>
