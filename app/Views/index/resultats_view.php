<?= view('includes/header') ?>

<section class="resultats-page">
  <h2>Résultats des compétitions FJJB</h2>

  <div class="search-zone">
    <input type="text" class="result-search" placeholder="Nom de la compétition ou de l’athlète">
  </div>

  <div class="filters-result">
    <select><option>Année</option></select>
    <select><option>Ville</option></select>
    <select><option>Catégorie</option></select>
    <button class="btn red">Filtrer</button>
  </div>

  <div class="resultats-table-wrapper">
    <table class="resultats-table">
      <thead>
        <tr>
          <th>Compétitions</th>
          <th>Catégorie</th>
          <th>Nom du gagnant</th>
          <th>Club</th>
          <th>Résultats</th>
        </tr>
      </thead>
      <tbody>
        <!-- Exemples de lignes statiques -->
        <tr>
          <td>Open Marseille</td>
          <td>Adult -76kg</td>
          <td>Ahmed B.</td>
          <td>Alliance Paris</td>
          <td>Victoire par soumission</td>
        </tr>
      </tbody>
    </table>
  </div>
</section>

<?= view('includes/footer') ?>
