<?php require_once "../config/auth.php"; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Usuario - Motorkai</title>
  <link rel="stylesheet" href="C:\xampp\htdocs\Motorkai_final\assets\css\style.css">
</head>
<body>
<?php include "../includes/navbar.php"; ?>
<main>
  <h1>Editar Usuario</h1>
  <form method="POST">
      <label>Usuario:</label>
      <input type="text" name="username" value=""><br>
      <label>Contraseña (opcional):</label>
      <input type="password" name="password"><br>
      <label>Rol:</label>
      <select name="role">
          <option value="admin">Admin</option>
          <option value="seller">Vendedor</option>
          <option value="customer">Cliente</option>
      </select><br>
      <button type="submit">Actualizar</button>
  </form>
</main>
</body>
</html>
