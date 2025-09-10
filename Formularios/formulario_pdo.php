<?php
 $mensaje = "";
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $nombre = $_POST['nombre'];
 $email = $_POST['email'];
 // Configuración de conexión MySQLi
 $conexion = new mysqli("localhost", "root", "", "test");
 if ($conexion->connect_error) {
 die("Error de conexión: " . $conexion->connect_error);
 }
 // Consulta preparada
 $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
 $stmt->bind_param("ss", $nombre, $email);
 if ($stmt->execute()) {
 $mensaje = "Datos insertados correctamente con MySQLi.";
 } else {
 $mensaje = "Error con MySQLi: " . $stmt->error;
 }
 $stmt->close();
 $conexion->close();
 }
 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
 <meta charset="UTF-8">
 <title>Formulario con MySQLi</title>
 </head>
 <body>
 <h2>Registro con MySQLi</h2>
 <?php if ($mensaje): ?>
 <p style="color: green;"><?= $mensaje ?></p>
 <?php endif; ?>
 <form method="post" action="">
 <label for="nombre">Nombre:</label><br>
 <input type="text" name="nombre" required><br><br>
 php
 <label for="email">Email:</label><br>
 <input type="email" name="email" required><br><br>
 <input type="submit" value="Enviar">
 </form>
 </body>
 </html>
