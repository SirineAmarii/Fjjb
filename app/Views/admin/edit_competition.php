<?= view('includes/header') ?>

<section class="dashboard-page">
  <div class="dashboard-box">
    <h2>Modifier la compétition</h2>

    <?php if (session()->getFlashdata('error')) : ?>
      <div class="alert red">
        <?php foreach (session()->getFlashdata('error') as $error) : ?>
          <p><?= esc($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/competitions/update/' . $competition['id_competition']) ?>" method="post" enctype="multipart/form-data" class="form-vertical">

      <div class="form-group">
        <label for="nom">Nom de la compétition</label>
        <input type="text" name="nom" value="<?= old('nom', $competition['name']) ?>" required>
      </div>

      <div class="form-group">
        <label for="event_date">Date</label>
        <input type="date" name="event_date" value="<?= old('event_date', $competition['event_date']) ?>" required>
      </div>

      <div class="form-group">
        <label for="city">Ville</label>
        <input type="text" name="city" value="<?= old('city', $competition['city']) ?>" required>
      </div>

      <div class="form-group">
        <label for="venue">Lieu</label>
        <input type="text" name="venue" value="<?= old('venue', $competition['venue']) ?>">
      </div>

      <div class="form-group">
        <label for="category">Catégorie</label>
        <input type="text" name="category" value="<?= old('category', $competition['category']) ?>">
      </div>

      <div class="form-group">
        <label for="visible">Visible</label>
        <select name="visible" required>
          <option value="1" <?= old('visible', $competition['visible']) == 1 ? 'selected' : '' ?>>Oui</option>
          <option value="0" <?= old('visible', $competition['visible']) == 0 ? 'selected' : '' ?>>Non</option>
        </select>
      </div>

      <div class="form-group full-width">
        <label for="image">Image (facultatif – remplace l'existante si sélectionnée)</label>
        <?php if (!empty($competition['image'])): ?>
          <div class="photo-preview">
            <img src="<?= base_url('public/assets/images/competitions/' . $competition['image']) ?>" width="150">
            <p>Image actuelle</p>
          </div>
        <?php endif; ?>
        <input type="file" name="image" id="image">
      </div>

      <div class="form-actions">
        <button type="submit" class="btn blue">Enregistrer</button>
        <a href="<?= base_url('admin/competitions') ?>" class="btn light">Annuler</a>
      </div>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
