<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // cifrado simple
    $rol = $_POST['rol'];

    $query = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$password', '$rol')";
    mysqli_query($conn, $query);

    header("Location: list.php");
}
?>
<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre">
    <input type="email" name="email" placeholder="Correo">
    <input type="password" name="password" placeholder="Contraseña">
    <select name="rol">
        <option value="admin">Admin</option>
        <option value="vendedor">Vendedor</option>
        <option value="cliente">Cliente</option>
    </select>
    <button type="submit">Crear usuario</button>
</form>
