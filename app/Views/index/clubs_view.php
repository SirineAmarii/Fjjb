<?= view('includes/header') ?>

<section class="clubs-page">
  <h2>Trouve ton club FJJB près de chez toi</h2>

  <div class="search-bar">
  <input type="text" class="search-input" placeholder="Rechercher une ville ou un club">
  <button class="btn red search-btn">Rechercher</button>
</div>


  <div class="filters-club">
    <select><option>Départements</option></select>
    <select><option>Région</option></select>
    <select><option>Pays</option></select>
  </div>

  <div class="clubs-grid">
    <div class="club-card">
      <h3>Alliance Jiu Jitsu</h3>
      <p class="city">Paris</p>
      <p><i class="fas fa-map-marker-alt"></i> 120 avenue de</p>
      <p><i class="fas fa-phone"></i> 0463232628</p>
      <p><i class="fas fa-envelope"></i> aa@aaa.com</p>
      <a class="btn blue">Voir</a>
    </div>

    <div class="club-card">
      <h3>Gracie Barra Lyon</h3>
      <p class="city">Lyon</p>
      <p><i class="fas fa-map-marker-alt"></i> 120 avenue de</p>
      <p><i class="fas fa-phone"></i> 0463232628</p>
      <p><i class="fas fa-envelope"></i> aa@aaa.com</p>
      <a class="btn blue">Voir</a>
    </div>

    <div class="club-card">
      <h3>Atos Jiu Jitsu Club</h3>
      <p class="city">Toulouse</p>
      <p><i class="fas fa-map-marker-alt"></i> 120 avenue de</p>
      <p><i class="fas fa-phone"></i> 0463232628</p>
      <p><i class="fas fa-envelope"></i> aa@aaa.com</p>
      <a class="btn blue">Voir</a>
    </div>

    <div class="club-card">
      <h3>Chekmat Nantes</h3>
      <p class="city">Nantes</p>
      <p><i class="fas fa-map-marker-alt"></i> 120 avenue de</p>
      <p><i class="fas fa-phone"></i> 0463232628</p>
      <p><i class="fas fa-envelope"></i> aa@aaa.com</p>
      <a class="btn blue">Voir</a>
    </div>
  </div>

  <div class="pagination">
    <span>&larr;</span>
    <span class="dot"></span>
    <span>&rarr;</span>
  </div>
</section>

<?= view('includes/footer') ?>
