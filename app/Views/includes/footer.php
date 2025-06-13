<footer>
  <div class="container">

    <!-- Colonne du logo FJJB -->
    <div class="footer-column logo-column">
      <img src="<?= base_url('public/assets/images/logo-fjjb.png') ?>" alt="Logo FJJB">
    </div>

    <!-- Colonne des liens utiles -->
    <div class="footer-column">
      <h4>Liens utiles</h4>
      <ul>
        <li><a href="<?= base_url('connexion') ?>">Connexion</a></li> 
        <li><a href="<?= base_url('inscription') ?>">Créer un compte</a></li> 
        <li><a href="<?= base_url('clubs') ?>">Trouver un club</a></li>
        <li><a href="<?= base_url('competitions') ?>">Compétitions</a></li>
        <li><a href="<?= base_url('resultats') ?>">Résultats</a></li>
      </ul>
    </div>

    <!-- Colonne des informations légales -->
    <div class="footer-column">
      <h4>Informations légales</h4>
      <ul>
        <li><a href="<?= base_url('mentions-legales') ?>">Mentions légales</a></li>
        <li><a href="<?= base_url('politique-confidentialite') ?>">Politique de confidentialité</a></li>
        <li><a href="<?= base_url('conditions-utilisation') ?>">Conditions d'utilisation</a></li>
        <li><a href="<?= base_url('contact') ?>">Contact</a></li>
      </ul>
    </div>

    <!-- Colonne des réseaux sociaux -->
    <div class="footer-column socials">
      <h4>Suivez-nous</h4>
      <div class="social-icons">
        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
      </div>
    </div>

  </div>

  <!-- Mention de copyright -->
  <p class="copyright">© 2025 FJJB — Tous droits réservés</p>

  <!-- Inclusion du script JavaScript principal -->
  <script src="<?= base_url('public/assets/js/script.js') ?>"></script>

</footer>
