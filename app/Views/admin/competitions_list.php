<?= view('includes/header') ?>

<div class="btn-retour-container">
  <a href="<?= base_url('admin/dashboard') ?>" class="btn-retour">← Retour au tableau de bord</a>
</div>

<section class="dashboard">
  <h2>Gestion des compétitions</h2>

  <div class="admin-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Date</th>
          <th>Ville</th>
          <th>Lieu</th>
          <th>Catégorie</th>
          <th>Visible</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($competitions as $comp): ?>
          <tr>
            <td><?= $comp['id_competition'] ?></td>
            <td><?= esc($comp['name']) ?></td>
            <td><?= date('d/m/Y', strtotime($comp['event_date'])) ?></td>
            <td><?= esc($comp['city']) ?></td>
            <td><?= esc($comp['venue']) ?></td>
            <td><?= esc($comp['category']) ?></td>
            <td><?= $comp['visible'] ? 'Oui' : 'Non' ?></td>

            <td>
                <a href="<?= base_url('admin/users/edit/' . $comp['id_competition']) ?>" class="btn-action blue">Modifier</a>
                <a href="<?= base_url('admin/users/delete/' . $comp['id_competition']) ?>" class="btn-action red" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?= view('includes/footer') ?>
