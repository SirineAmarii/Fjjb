<?= view('includes/header') ?>

<section class="clubs-page">
  <h2>Trouve ton club FJJB près de chez toi</h2>


  <form method="get" action="<?= base_url('clubs') ?>" class="search-bar">
  <input type="text" name="q" class="search-input" placeholder="Rechercher un club ou une ville" value="<?= esc($_GET['q'] ?? '') ?>">
  <button type="submit" class="btn red search-btn">Rechercher</button>
</form>

 

  <div class="clubs-grid">
    <?php foreach ($clubs as $club): ?>
      <div class="club-card">
        <h3><?= esc($club['nom']) ?></h3>
        <p class="city"><?= esc($club['ville']) ?: 'Ville non précisée' ?></p>
        <p><i class="fas fa-map-marker-alt"></i> <?= esc($club['adresse']) ?: 'Adresse non précisée' ?></p>
        <?php if ($club['telephone']): ?>
          <p><i class="fas fa-phone"></i> <?= esc($club['telephone']) ?></p>
        <?php endif; ?>
        <?php if ($club['email']): ?>
          <p><i class="fas fa-envelope"></i> <?= esc($club['email']) ?></p>
        <?php endif; ?>
        <a class="btn blue">Voir</a>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="pagination">
  <?= $pager->simpleLinks('default', 'front_arrows', ['q' => $_GET['q'] ?? '']) ?>


</div>



<?= view('includes/footer') ?>



