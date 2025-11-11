<?php
require __DIR__ . '/../bootstrap.php';
if (session_status() === PHP_SESSION_NONE)
// session_start();
?>
<!-- <!doctype html>
<html lang="es"> -->

<head>
  <meta charset="UTF-8">
  <title><?php echo TITULO; ?> </title>
  <link rel="stylesheet" href="<?php echo BASE_URL . '/assets/css/style.css' ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- NECESARIO PARA QUE APAREZCAN LOS ÍCONOS DE REDES SOCIALES (Font Awesome) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" xintegrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMDJ8u7S5bE2wE133m4Q9y1F6vQp/zT9b6jA0l75bE3+H5m4o9P0w/zE0J2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    xintegrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>