<?= view('includes/header') ?>

<section class="competitions-page">
  <h2>Toutes les compétitions FJJB</h2>
  <p class="subtext">Inscris-toi, suis les résultats et découvre les prochains évènements officiels</p>


  <div class="filters-comp">
    <select><option>Ville</option></select>
    <select><option>Toutes les compétitions</option></select>
    
  </div>
 
  <div class="competitions-grid">
    <div class="competition-card">
      <h3>OPEN FJJB MARSEILLE</h3>
      <p class="date">15 juin 2025</p>
      <div class="actions">
        <a class="btn blue">Voir</a>
        <a class="btn red">S'inscrire</a>
      </div>
    </div>

    <div class="competition-card">
      <h3>CHAMPIONNAT NATIONAL</h3>
      <p class="date">25 mai 2025</p>
      <div class="actions">
        <a class="btn blue">Voir</a>
        <a class="btn red">S'inscrire</a>
      </div>
    </div>

    <div class="competition-card">
      <h3>OPEN FJJB LYON</h3>
      <p class="date">10 mai 2025</p>
      <div class="actions">
        <a class="btn blue">Voir</a>
        <a class="btn red">S'inscrire</a>
      </div>
    </div>

    <div class="competition-card">
      <h3>OPEN FJJB PARIS</h3>
      <p class="date">25 avril 2025</p>
      <div class="actions">
        <a class="btn blue">Voir</a>
        <a class="btn red">S'inscrire</a>
      </div>
    </div>

    <div class="competition-card">
      <h3>OPEN FJJB BORDEAUX</h3>
      <p class="date">5 décembre 2024</p>
      <div class="actions">
        <a class="btn light">Terminé</a>
        <a class="btn light">Résultats</a>
      </div>
    </div>

    <div class="competition-card">
      <h3>OPEN FJJB LILLE</h3>
      <p class="date">10 octobre 2024</p>
      <div class="actions">
        <a class="btn light">Terminé</a>
        <a class="btn light">Résultats</a>
      </div>
    </div>
  </div>
</section>

<?= view('includes/footer') ?>

