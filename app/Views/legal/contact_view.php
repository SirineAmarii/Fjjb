<?= view('includes/header') ?>

<section class="register-page">
  <div class="register-box">
    <h2>Contactez-nous</h2>

    <form action="#" method="post">
      <input type="text" name="nom" placeholder="Nom complet" required>
      <input type="email" name="email" placeholder="Adresse e-mail" required>
      <textarea name="message" rows="5" placeholder="Votre message" required></textarea>
      <button type="submit" class="btn red full">Envoyer</button>
    </form>
  </div>
</section>

<?= view('includes/footer') ?>
