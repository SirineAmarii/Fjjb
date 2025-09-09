<?= view('includes/header') ?>




<section class="competitions-home">
  <h2>NOS COMPÉTITIONS OFFICIELLES</h2>

  <div class="competitions-grid">
    <?php if (!empty($competitions)) : ?>
      <?php foreach ($competitions as $competition) : ?>
        <div class="competition-card">
          <img src="<?= base_url('public/assets/images/competitions/' . $competition['image']) ?>" alt="<?= esc($competition['name']) ?>">
          <div class="competition-content">
            <h3><?= esc($competition['name']) ?></h3>
            <p class="date"><?= date('d/m/Y', strtotime($competition['event_date'])) ?></p>
            <div class="actions">
              <a href="<?= base_url('competition/' . $competition['id_competition']) ?>" class="btn blue">Voir</a>
              <a href="<?= base_url('inscription/' . $competition['id_competition']) ?>" class="btn red">S’inscrire</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Aucune compétition pour le moment.</p>
    <?php endif; ?>
  </div>

  <!-- PAGINATION -->
  <div class="pagination-container">
    <?= $pager->links() ?>
  </div>
</section>
<?= view('includes/footer') ?>

