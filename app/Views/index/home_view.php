<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>
FJJB – Accueil
<?= $this->endSection() ?>

<?= $this->section('content') ?>

  <section class="hero">
    <h1>Fédération de Jiu-Jitsu Brésilien</h1>
    <a href="<?= base_url('competitions') ?>" class="btn-primary">Voir les prochaines compétitions</a>
  </section>

  <section class="competitions-home">
  <h2>Nos compétitions</h2>
  <div class="competitions-grid">
    <?php if (!empty($competitions)): ?>
      <?php foreach ($competitions as $competition): ?>
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
    <?php else: ?>
      <p>Aucune compétition pour le moment.</p>
    <?php endif; ?>
  </div>
</section>




  <section class="about">
    <div class="text">
      <h2>Qui sommes-nous ?</h2>
      <p>La Fédération de Jiu-Jitsu Brésilien (FJJB) est une structure dédiée à la promotion, l’encadrement et la régulation du jiu-jitsu brésilien en France. Elle fédère les clubs, forme les pratiquants et organise des compétitions nationales.</p>
    </div>
    <div class="image">
      <img src="public/assets/images/combat-jjb.jpg" alt="Combat JJB">
    </div>
  </section>

  <section class="licence">
    <h2>Devenir licencié</h2>
    <ul>
      <li>Accès aux compétitions officielles</li>
      <li>Programme de formation continue</li>
      <li>Avantages réservés aux licenciés</li>
    </ul>
   
    <a href="<?= base_url('inscription') ?>" class="btn-secondary">S'inscrire</a>
  </section>

  <?= $this->endSection() ?>