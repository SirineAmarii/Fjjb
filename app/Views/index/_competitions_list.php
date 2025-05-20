<?php if (!empty($competitions)) : ?>
  <?php foreach ($competitions as $competition): ?>
    <div class="competition-card">
      <img src="<?= base_url('public/assets/images/competitions/' . $competition['image']) ?>" alt="<?= esc($competition['nom']) ?>">
      <div class="competition-content">
        <h3><?= esc($competition['nom']) ?></h3>
        <p class="date"><?= strftime('%d %B %Y', strtotime($competition['date'])) ?></p>
        <div class="actions">
          <?php if (strtotime($competition['date']) > time()): ?>
            <a class="btn blue">Voir</a>
            <a class="btn red">S'inscrire</a>
          <?php else: ?>
            <a class="btn light">Terminé</a>
            <a class="btn light">Résultats</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <p>Aucune compétition trouvée.</p>
<?php endif; ?>
