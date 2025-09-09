<?= view('includes/header') ?>

<section class="results-page">
  <h2>Clubs affiliés</h2>

  <form method="get" action="<?= site_url('clubs') ?>" class="filter-form">
    <label for="city">Filtrer par ville :</label>
    <select name="city" id="city" onchange="this.form.submit()">
        <option value="">Toutes les villes</option>
        <option value="Marseille" <?= $cityFilter === 'Marseille' ? 'selected' : '' ?>>Marseille</option>
        <option value="Paris" <?= $cityFilter === 'Paris' ? 'selected' : '' ?>>Paris</option>
        <option value="Lyon" <?= $cityFilter === 'Lyon' ? 'selected' : '' ?>>Lyon</option>
        <option value="Nice" <?= $cityFilter === 'Nice' ? 'selected' : '' ?>>Nice</option>
        <option value="Toulouse" <?= $cityFilter === 'Toulouse' ? 'selected' : '' ?>>Toulouse</option>
        <option value="Bordeaux" <?= $cityFilter === 'Bordeaux' ? 'selected' : '' ?>>Bordeaux</option>
        <option value="Lille" <?= $cityFilter === 'Lille' ? 'selected' : '' ?>>Lille</option>
    </select>
</form>


 <div class="table-container"> 
  <table class="styled-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Ville</th>
        <th>Adresse</th>
        <th>Téléphone</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody id="results-table-body">
      <?php if (!empty($clubs)) : ?>
        <?php foreach ($clubs as $club): ?>
          <tr>
            <td><?= esc($club['name']) ?></td>
            <td><?= esc($club['city']) ?></td>
            <td><?= esc($club['address']) ?></td>
            <td><?= esc($club['phone']) ?></td>
            <td><?= esc($club['email']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">Aucun club trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
  </div>
</section>

<?= view('includes/footer') ?> 
