<?php
require_once "../config/db.php";
include "../includes/header.php";

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = trim($_POST['role'] ?? 'seller');
    $password_plain = $_POST['password'] ?? '';

    if ($full_name === '' || $email === '' || $password_plain === '') {
        $errors[] = "Completar nombre, email y contraseña.";
    }

    // Preparar contraseña si no hay errores
    if (!$errors) {
        $password = password_hash($password_plain, PASSWORD_DEFAULT);
    }

    // Determinar ruta absoluta segura
    $basePath = realpath(__DIR__ . '/..');
    if ($basePath === false) $basePath = __DIR__ . '/..';
    $uploadDir = $basePath . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'users';

    // Crear carpeta si no existe
    if (!is_dir($uploadDir)) {
        if (!@mkdir($uploadDir, 0755, true)) {
            $errors[] = "No se pudo crear la carpeta de uploads en: $uploadDir";
        }
    }

    // Verificar permisos de escritura (intentar crear archivo de prueba)
    if (empty($errors) && !is_writable($uploadDir)) {
        $testFile = $uploadDir . DIRECTORY_SEPARATOR . '.__writable_test';
        $ok = @file_put_contents($testFile, 'ok');
        if ($ok === false) {
            $errors[] = "La carpeta de uploads no es escribible: $uploadDir";
        } else {
            @unlink($testFile);
        }
    }

    $avatar = null;
    if (empty($errors) && isset($_FILES['avatar']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Manejo de errores del upload
        if ($_FILES['avatar']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "Error al subir el avatar (código " . $_FILES['avatar']['error'] . ").";
        } else {
            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
            $maxSize = 2 * 1024 * 1024; // 2MB

            if (!in_array($_FILES['avatar']['type'], $allowed)) {
                $errors[] = "Formato de avatar no permitido. JPG / PNG / WEBP.";
            } elseif ($_FILES['avatar']['size'] > $maxSize) {
                $errors[] = "Avatar demasiado grande (> 2 MB).";
            } else {
                $tmp = $_FILES['avatar']['tmp_name'];
                if (!is_uploaded_file($tmp) || !file_exists($tmp)) {
                    $errors[] = "Archivo temporal no encontrado. Revisá upload_tmp_dir en php.ini.";
                } else {
                    $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
                    $avatar = uniqid('u_') . '.' . $ext;
                    $dest = $uploadDir . DIRECTORY_SEPARATOR . $avatar;

                    if (!@move_uploaded_file($tmp, $dest)) {
                        $last = error_get_last();
                        $errors[] = "No se pudo mover el archivo al destino: $dest. PHP error: " . ($last['message'] ?? 'desconocido');
                    }
                }
            }
        }
    }

    // Insertar en DB si no hay errores
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password, role, avatar) VALUES (?,?,?,?,?)");
            $stmt->execute([$full_name, $email, $password, $role, $avatar]);
            header("Location: list.php?msg=created");
            exit;
        } catch (PDOException $e) {
            // si la inserción falla, eliminar avatar movido (si existe)
            if ($avatar && file_exists($uploadDir . DIRECTORY_SEPARATOR . $avatar)) {
                @unlink($uploadDir . DIRECTORY_SEPARATOR . $avatar);
            }
            $errors[] = "Error al guardar el usuario en la DB: " . $e->getMessage();
        }
    }
}
?>

<div class="container my-4">
  <h2>Nuevo Usuario</h2>

  <?php if (!empty($errors)): ?>
    <?php foreach($errors as $e): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($e) ?></div>
    <?php endforeach; ?>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <input name="full_name" class="form-control" placeholder="Nombre completo" required value="<?=htmlspecialchars($_POST['full_name'] ?? '')?>">
    </div>
    <div class="mb-3">
      <input name="email" type="email" class="form-control" placeholder="Correo electrónico" required value="<?=htmlspecialchars($_POST['email'] ?? '')?>">
    </div>
    <div class="mb-3">
      <input name="password" type="password" class="form-control" placeholder="Contraseña" required>
    </div>
    <div class="mb-3">
      <select name="role" class="form-select">
        <option value="admin" <?= (($_POST['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
        <option value="seller" <?= (($_POST['role'] ?? '') === 'seller') ? 'selected' : '' ?>>Vendedor</option>
        <option value="customer" <?= (($_POST['role'] ?? '') === 'customer') ? 'selected' : '' ?>>Cliente</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Avatar</label>
      <input type="file" name="avatar" class="form-control" accept="image/*">
    </div>

    <button class="btn btn-motokai">Guardar</button>
    <a href="list.php" class="btn btn-secondary">Cancelar</a>
  </form>
</div>

<?php include "../includes/footer.php"; ?>
