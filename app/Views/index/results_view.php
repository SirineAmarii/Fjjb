<?= view('includes/header') ?>

<section class="resultats-page">
  <h2>Résultats des compétitions FJJB</h2>

  <!-- Barre de recherche -->
  <form method="get" action="<?= base_url('results') ?>" class="search-bar">
    <input 
        type="text" 
        name="q" 
        class="search-input" 
        data-url="<?= base_url('results-search') ?>" 
        placeholder="Rechercher un athlète ou une compétition"
        value="<?= esc($search ?? '') ?>"
    >

    <button type="submit" class="btn red search-btn">Rechercher</button>

    <?php if (!empty($search)) : ?>
        <a href="<?= site_url('results') ?>" class="btn grey" style="margin-left: 10px;">
            Réinitialiser
        </a>
    <?php endif; ?>
  </form>

  <div class="resultats-table-wrapper">
    <table class="resultats-table">
      <thead>
        <tr>
          <th>Compétition</th>
          <th>Catégorie</th>
          <th>Nom du gagnant</th>
          <th>Club</th>
          <th>Résultat</th>
        </tr>
      </thead>
      <tbody id="results-table-body">
        <?php if (!empty($results)): ?>
          <?php foreach ($results as $result): ?>
            <tr>
              <td><?= esc($result['competition_name']) ?></td>
              <td><?= esc($result['category']) ?></td>
              <td>
                <div style="display: flex; align-items: center; gap: 8px;">
                 
                 
                  
                  <?= esc($result['first_name']) . ' ' . esc($result['last_name']) ?>
                </div>
              </td>
              <td><?= esc($result['club_name']) ?></td>
              <td><?= esc($result['position']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">Aucun résultat trouvé.</td>
          </tr>
        <?php endif; ?>
    

      </tbody>
    </table>
  </div>
</section>


