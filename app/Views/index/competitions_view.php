
<?= view('includes/header') ?>

<?php setlocale(LC_TIME, 'fr_FR.UTF-8'); ?>


<section class="competitions-page">
  <h2>Toutes les compétitions FJJB</h2>
  <p class="subtext">Inscris-toi, suis les résultats et découvre les prochains évènements officiels</p>

  <form method="get" action="<?= base_url('competitions') ?>" class="search-bar">
   
    <input type="text" name="q" class="search-input" data-url="<?= base_url('competitions/search') ?>" placeholder="Rechercher une ville ou une compétition">

    <button type="submit" class="btn red search-btn">Rechercher</button>
  </form>

  <div class="competitions-grid">
    <?php if (!empty($competitions)) : ?>
      <?php foreach ($competitions as $competition): ?>
        <div class="competition-card">
          <img src="<?= base_url('public/assets/images/competitions/' . $competition['image']) ?>" alt="<?= esc($competition['name']) ?>">
          <div class="competition-content">
            <h3><?= esc($competition['name']) ?></h3>
            <p class="date"><?= strftime('%d %B %Y', strtotime($competition['event_date'])) ?></p>
            <div class="actions">
              <?php if (strtotime($competition['event_date']) > time()): ?>
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
  </div>
</section>

<?= view('includes/footer') ?>

