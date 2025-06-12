<?= view('includes/header') ?>

<?php if (!isset($user)) {
    return redirect()->to('/');
} ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Bienvenue, <?= esc($user['first_name']) ?> !</h2>
    <p class="intro">Voici ton espace personnel FJJB.</p>

    <h3>Mon profil</h3>

    <div class="profile-section">
      <div class="profile-photo">
        <img src="<?= base_url('public/uploads/users/' . ($user['photo'] ?? 'default.png')) ?>" alt="Photo de profil" width="120">
      </div>
      <div class="profile-details">
        <ul class="user-infos">
          <li><strong>Nom :</strong> <?= esc($user['last_name']) ?></li>
          <li><strong>Prénom :</strong> <?= esc($user['first_name']) ?></li>
          <li><strong>Email :</strong> <?= esc($user['email']) ?></li>
          <li><strong>Ceinture :</strong> <?= esc($user['belt']) ?></li>
     

           <?php if (!empty(session()->get('club_name'))) : ?>
        <li><strong>Club affilié :</strong> <?= esc($user['club_name'] ?? 'Non renseigné') ?></li>
      <?php else: ?>
        <li><strong>Club :</strong> Non renseigné</li>
      <?php endif; ?>
           </ul>
      </div>
    </div>

    <div class="dashboard-actions">
      <a href="<?= base_url('user-edit') ?>" class="btn">Modifier mon profil</a>
      <a href="<?= base_url('logout') ?>" class="btn red">Déconnexion</a>
    </div>
  </div>
</section>

<?= view('includes/footer') ?>







 

