<?= view('includes/header') ?>

<?php if (session()->getFlashdata('success')) : ?>
  <div class="alert success">
    <?= esc(session()->getFlashdata('success')) ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
  <div class="alert red">
    <?= esc(session()->getFlashdata('error')) ?>
  </div>
<?php endif; ?>


<div class="btn-retour-container">
  <a href="<?= base_url('admin-dashboard') ?>" class="btn-retour">← Retour au tableau de bord</a>
  <a href="<?= base_url('admin/competition/add') ?>" class="btn red">Ajouter une competition</a>
</div>

<section class="dashboard">
  <h2>Gestion des compétitions</h2>

  <div class="admin-table">
    <table>
      <thead>
        <tr>
         
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
            
            <td><?= esc($comp['name']) ?></td>
            <td><?= date('d/m/Y', strtotime($comp['event_date'])) ?></td>
            <td><?= esc($comp['city']) ?></td>
            <td><?= esc($comp['venue']) ?></td>
            <td><?= esc($comp['category']) ?></td>
            <td><?= $comp['visible'] ? 'Oui' : 'Non' ?></td>

            <td>
                <a href="<?= base_url('admin/competition/edit/' . $comp['id_competition']) ?>" class="btn-action blue">Modifier</a>
                <a href="<?= base_url('admin/competition/delete/' . $comp['id_competition']) ?>" class="btn-action red" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?= view('includes/footer') ?>
