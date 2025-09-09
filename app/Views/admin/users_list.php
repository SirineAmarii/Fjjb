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
  <a href="<?= base_url('admin/dashboard') ?>" class="btn-retour">← Retour au tableau de bord</a>
  <a href="<?= base_url('admin/users/add') ?>" class="btn-action red">Ajouter un utilisateur</a>
</div>




<section class="dashboard">
  <h2>Gestion des utilisateurs</h2>

  <div class="admin-table">
    <table>
      <thead>
        <tr>
          
          <th>Nom</th>
          <th>Prénom</th>
          <th>Email</th>
          <th>Rôle</th>
          <th>Ceinture</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            
            <td><?= esc($user['first_name']) ?></td>
            <td><?= esc($user['last_name']) ?></td>
            <td><?= esc($user['email']) ?></td>
            <td><?= esc($user['role']) ?></td>
            <td><?= esc($user['belt']) ?></td>

            <td>
             <a href="<?= base_url('admin/users/edit/' . $user['id_user']) ?>" class="btn-action blue">Modifier</a>
              <a href="<?= base_url('admin/users/delete/' . $user['id_user']) ?>" class="btn-action red" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>

<?= view('includes/footer') ?>
