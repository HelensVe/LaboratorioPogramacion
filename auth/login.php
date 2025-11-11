<?php
session_start();
require_once __DIR__ . "/../config/db.php"; // Conexión PDO

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email']);
  $pass = $_POST['password'];

  try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && ($user['password'] === md5($pass) || password_verify($pass, $user['password']))) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['user_name'] = $user['username'];
      header("Location: ../../dashboard/dashboard.php");
      exit;
    } else {
      $error = "Usuario o contraseña incorrectos.";
    }
  } catch (PDOException $e) {
    $error = "Error en la base de datos: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<?php include __DIR__ . "/../includes/header.php"; ?>

<body style="background-color:#0F0F0F; color:#EAEAEA; display:flex; justify-content:center; align-items:center; min-height:100vh;">
  <div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-5">
      <?php if ($error): ?>
        <div class="alert alert-danger mt-2 text-center"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <!-- Caja de login Motorkai -->
      <div class="form-motorkai text-center animate__animated animate__fadeInUp">
        <h2 style="color:#FF4500; font-weight:700; margin-bottom:1.5rem;">Acceso a Motorkai</h2>

        <form action="<?= BASE_URL . '/auth/login.php' ?>" method="POST">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" class="form-control mb-3" placeholder="Ingrese su correo" required>

          <label for="password">Contraseña</label>
          <input type="password" id="password" name="password" class="form-control mb-4" placeholder="Ingrese su contraseña" required>

          <button type="submit" class="btn btn-motorkai w-100">Ingresar</button>
        </form>
      </div>
    </div>
  </div>
</body>

<?php include __DIR__ . "/../includes/footer.php"; ?>
</html>
