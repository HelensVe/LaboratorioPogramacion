<?php
// footer.php
// Incluí este archivo con: <?php include 'footer.php'; 
?>
<footer class="mk-footer" role="contentinfo">
  <div class="mk-footer-inner">
    <div class="mk-brand">
      <!-- Ajustá la ruta de la imagen al lugar donde tengas el logo -->
      <img src="../uploads/logo-motorkai-sinfondo.PNG" alt="Motorkai" class="mk-logo">
    </div>

    <nav class="mk-links" aria-label="Enlaces pie de página">
      <a href="#">QUIERO SER DISTRIBUIDOR</a>
      <a href="#">CONOCENOS MÁS</a>
    </nav>

    <div class="mk-contact">
      <p><span class="mk-icon" aria-hidden="true">📍</span>Av Centenario 4072, Capital, Provincia de Corrientes</p>
      <div class="mk-social" aria-hidden="false">
        <a href="#" title="Facebook" class="mk-social-link"><i class="fa-brands fa-facebook-f"></i></a>
        <a href="#" title="Instagram" class="mk-social-link"><i class="fa-brands fa-instagram"></i></a>
      </div>
    </div>
  </div>

  <div class="mk-footer-bottom">
    <div class="mk-footer-bottom-inner">
      <p>© <?= date('Y') ?> Motorkai — Todos los derechos reservados</p>
      <p class="mk-credit">Diseño & Desarrollo by Angie & Team</p>
    </div>
  </div>
</footer>
