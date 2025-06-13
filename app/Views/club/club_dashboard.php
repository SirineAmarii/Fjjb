<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Licenciés de mon club</h2>

    <?php if (session()->getFlashdata('success')) : ?>
      <div class="alert green"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if (!empty($licencies)) : ?>
      <table class="admin-table">
        <thead>
          <tr>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Ceinture</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($licencies as $licencie) : ?>
            <tr>
              <td><?= esc($licencie['first_name']) ?></td>
              <td><?= esc($licencie['last_name']) ?></td>
              <td><?= esc($licencie['email']) ?></td>
              <td><?= esc(ucfirst($licencie['belt'])) ?></td>
              <td>
                <a href="<?= base_url('club/modifier-licencie/' . $licencie['id_user']) ?>" class="btn-action blue">Modifier</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else : ?>
      <p>Aucun licencié associé à votre club.</p>
    <?php endif; ?>
  </div>
</section>

<?= view('includes/footer') ?>
