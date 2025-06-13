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
    <a href="<?= base_url('admin/clubs/add') ?>" class="btn red">Ajouter un club</a>
</div>

<section class="dashboard">
  <h2>Gestion des clubs affiliés</h2>

  <div class="admin-table">
    <table>
      <thead>
        <tr>
        
          <th>Nom</th>
          <th>Ville</th>
          <th>Adresse</th>
          <th>Téléphone</th>
          <th>Email</th>
          <th>Visible</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clubs as $club): ?>
          <tr>
            
            <td><?= esc($club['name']) ?></td>
            <td><?= esc($club['city']) ?: '—' ?></td>
            <td><?= esc($club['address']) ?: '—' ?></td>
            <td><?= esc($club['phone']) ?: '—' ?></td>
            <td><?= esc($club['email']) ?: '—' ?></td>
            <td><?= $club['visible'] ? 'Oui' : 'Non' ?></td>

            <td>
              <a href="<?= base_url('admin/club/edit/' . $club['id_club']) ?>" class="btn-action blue">Modifier</a>
              <a href="<?= base_url('admin/club/delete/' . $club['id_club']) ?>" class="btn-action red" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?= view('includes/footer') ?>

