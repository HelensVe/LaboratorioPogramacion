<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Motorkai</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavDropdown">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?= BASE_URL . '/index.php' ?>">Inicio</a>
        </li>
        <?php  if (!empty($_SESSION['user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . '/products/list.php' ?>">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . '/categories/list.php' ?>">Categorias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . '/brands/list.php' ?> ">Marcas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . '/sales/list.php' ?>">Ventas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASE_URL . '/cart.php' ?>">Carrito</a>
        </li>
        <?php  endif; ?>
      </ul>

      <!-- <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            👤 Usuario
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Mi Perfil</a></li>
            <li><a class="dropdown-item" href="#">Configuración</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Cerrar Sesión</a></li>
          </ul>
        </li>
      </ul> -->
      <div class="nav-right">
        <?php if (!empty($_SESSION['user_id'])): ?>
          <span class="navbar-user">Hola, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
          <a class="btn btn-outline" href="<?= BASE_URL . '/auth/logout.php'?>" >Cerrar sesión</a>
        <?php else: ?>
          <a class="btn btn-outline" href="<?= BASE_URL . '/auth/login.php'?> ">Iniciar sesión</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>