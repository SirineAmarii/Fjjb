<?= view('includes/header') ?>

 <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error) : ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

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
          <li><strong>Club affilié :</strong> <?= !empty($user['club_name']) ? esc($user['club_name']) : 'Non renseigné' ?></li>
        </ul>

      </div>
    </div>

    <div class="dashboard-actions">
      <a href="<?= base_url('user-edit') ?>" class="btn">Modifier mon profil</a>
      <a href="<?= base_url('user-password') ?>" class="btn">Modifier mon mot de passe</a>
      <a href="<?= base_url('logout') ?>" class="btn red">Déconnexion</a>
    </div>
  </div>
</section>

<?= view('includes/footer') ?>







 

