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
    <div class="cards">
      <div class="card red">
        <p class="date">18 juin 2025</p>
        <h3>Open Marseille</h3>
      </div>
      <div class="card blue">
        <p class="date">27 sept. 2025</p>
        <h3>Open Lyon</h3>
      </div>
      <div class="card dark">
        <p class="date">10 nov. 2025</p>
        <h3>Championnat National</h3>
      </div>
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