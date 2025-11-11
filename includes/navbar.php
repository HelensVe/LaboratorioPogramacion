<?php
$base = '/Motorkai_final';
?>
<nav class="navbar">
  <a class="navbar-brand" href="<?=$base?>/dashboard/index.php">Motorkai</a>
  <ul class="nav">
    <li><a href="<?=$base?>/dashboard/index.php">Dashboard</a></li>
    <li><a href="<?=$base?>/products/list.php">Productos</a></li>
    <li><a href="<?=$base?>/brands/list.php">Marcas</a></li>
    <li><a href="<?=$base?>/categories/list.php">Categorías</a></li>
    <li><a href="<?=$base?>/users/list.php">Usuarios</a></li>
    <li><a href="<?=$base?>/sales/list.php">Ventas</a></li>
  </ul>

  <div class="nav-right">
    <?php if (!empty($_SESSION['user_id'])): ?>
      <span class="navbar-user">Hola, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
      <a class="btn btn-outline" href="<?=$base?>/auth/logout.php">Cerrar sesión</a>
    <?php else: ?>
      <a class="btn btn-outline" href="<?=$base?>/index.php">Iniciar sesión</a>
    <?php endif; ?>
  </div>
</nav>
