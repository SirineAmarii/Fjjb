<?= view('includes/header') ?>

<section class="register-page">

<?php if (isset($validation)): ?>
    <div class="alert danger">
      <?= $validation->listErrors() ?>
    </div>
  <?php endif; ?>

  <div class="register-box">
    <h2>Créer un compte licencié</h2>
    
    <form action="<?= base_url('inscription') ?>" method="post" enctype="multipart/form-data">

    <?php if (isset($validation)): ?>
  <div class="alert danger">
    <?= $validation->listErrors() ?>
  </div>
<?php endif; ?>

  <input type="text" name="prenom" placeholder="Prénom" required>
  <input type="text" name="nom" placeholder="Nom" required>
  <input type="email" name="email" placeholder="Adresse e-mail" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>

  <label for="ceinture">Ceinture :</label>
<select name="ceinture" required>
  <option value="">-- Choisir votre ceinture --</option>
  <option value="blanche">Blanche</option>
  <option value="bleue">Bleue</option>
  <option value="violette">Violette</option>
  <option value="marron">Marron</option>
  <option value="noire">Noire</option>
</select>

<label for="club_id">Club affilié :</label>
<select name="club_id">
  <option value="">-- Sélectionner un club --</option>
  <?php foreach ($clubs as $club): ?>
    <option value="<?= $club['id'] ?>"><?= esc($club['nom']) ?> - <?= esc($club['ville']) ?></option>
  <?php endforeach; ?>
</select>

<label for="new_club">Ou ajoutez un club :</label>
<input type="text" name="new_club" placeholder="Nom du club (si absent de la liste)">




  <input type="file" name="photo" accept="image/*" required>

  <button type="submit" class="btn red full">Créer mon compte</button>
</form>


    <p class="register-link">
      Déjà inscrit ? <a href="<?= base_url('connexion') ?>">Connectez-vous</a>
    </p>
  </div>
</section>

<?= view('includes/footer') ?>
