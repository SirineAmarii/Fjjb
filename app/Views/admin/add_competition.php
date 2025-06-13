<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Ajouter une compétition</h2>

    <?php if (session()->getFlashdata('success')) : ?>
      <div class="alert success">
        <?= esc(session()->getFlashdata('success')) ?>
      </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error) : ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/competition/create') ?>" method="post" enctype="multipart/form-data" class="form-vertical">
      <div class="form-group">
        <label for="name">Nom de la compétition</label>
        <input type="text" name="name" value="<?= old('name') ?>" required>
      </div>

      <div class="form-group">
        <label for="event_date">Date</label>
        <input type="date" name="event_date" value="<?= old('event_date') ?>" required>
      </div>

      <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" name="city" value="<?= old('city') ?>" required>
      </div>

      <div class="form-group">
        <label for="venue">Lieu</label>
        <input type="text" name="venue" value="<?= old('venue') ?>">
      </div>

      <div class="form-group">
        <label for="category">Catégorie</label>
        <input type="text" name="category" value="<?= old('category') ?>">
      </div>

      <div class="form-group">
        <label for="visible">Visible ?</label>
        <select name="visible" required>
          <option value="1" <?= old('visible') === '1' ? 'selected' : '' ?>>Oui</option>
          <option value="0" <?= old('visible') === '0' ? 'selected' : '' ?>>Non</option>
        </select>
      </div>

      <div class="form-group full-width">
        <label for="image">Image de la compétition</label>
        <input type="file" name="image" accept="image/*">
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Ajouter</button>
        <a href="<?= base_url('admin/competitions') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
