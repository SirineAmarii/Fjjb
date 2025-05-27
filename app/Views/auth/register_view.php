<?php // register_view.php ?>

<!-- Inclut l'en-tête de la page -->
<?= view('includes/header') ?>

<!-- Section principale de la page d'inscription -->
<section class="register-page">

  <!-- Affiche les erreurs de validation s'il y en a -->
  <?php if (isset($validation)): ?>
    <div class="alert danger">
      <?= $validation->listErrors() ?>
    </div>
  <?php endif; ?>

  <div class="register-box">
    <h2>Créer un compte licencié</h2>

    <!-- Formulaire d'inscription -->
    <form action="<?= base_url('inscription') ?>" method="post" enctype="multipart/form-data">

      <!-- Champ du prénom -->
      <input type="text" name="first_name" placeholder="Prénom" required>

      <!-- Champ du nom -->
      <input type="text" name="last_name" placeholder="Nom" required>

      <!-- Champ de l'adresse email -->
      <input type="email" name="email" placeholder="Adresse e-mail" required>

      <!-- Champ du mot de passe -->
      <input type="password" name="password" placeholder="Mot de passe" required>

      <!-- Champ de confirmation du mot de passe -->
      <input type="password" name="password_confirm" placeholder="Confirmer le mot de passe" required>

      <!-- Sélection de la ceinture -->
      <label for="belt">Ceinture :</label>
      <select name="belt" required>
        <option value="">-- Choisir votre ceinture --</option>
        <option value="white">Blanche</option>
        <option value="blue">Bleue</option>
        <option value="purple">Violette</option>
        <option value="brown">Marron</option>
        <option value="dark">Noire</option>
      </select>

      <!-- Sélection du club affilié -->
      <label for="club_id">Club affilié :</label>
      <select name="club_id">
        <option value="">-- Sélectionner un club --</option>
        <?php foreach ($clubs as $club): ?>
          <option value="<?= $club['id'] ?>">
            <?= esc($club['nom']) ?> - <?= esc($club['ville']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <!-- Champ pour ajouter un nouveau club si non présent dans la liste -->
      <label for="new_club">Ou ajoutez un club :</label>
      <input type="text" name="new_club" placeholder="Nom du club (si absent de la liste)">

      <!-- Import de photo de profil -->
      <input type="file" name="photo" accept="image/*" required>

      <!-- Bouton de soumission du formulaire -->
      <button type="submit" class="btn red full">Créer mon compte</button>
    </form>

    <!-- Lien vers la page de connexion -->
    <p class="register-link">
      Déjà inscrit ? <a href="<?= base_url('login') ?>">Connectez-vous</a>
    </p>
  </div>
</section>

<!-- Inclut le pied de page -->
<?= view('includes/footer') ?>

