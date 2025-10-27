<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = $_POST['name'];
    $price  = $_POST['price'];
    $stock  = $_POST['stock'];
    $photo  = $_POST['photo']; // por ahora guardamos la URL o path

    $sql = "INSERT INTO products (name, price, stock, photo) VALUES (:name, :price, :stock, :photo)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'price' => $price,
        'stock' => $stock,
        'photo' => $photo
    ]);

    header("Location: list.php?msg=created");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
</head>
<body>
    <h1>Agregar Producto</h1>
    <form method="post">
        <label>Nombre: <input type="text" name="name" required></label><br>
        <label>Precio: <input type="number" step="0.01" name="price" required></label><br>
        <label>Stock: <input type="number" name="stock" required></label><br>
        <label>Foto (URL o path): <input type="text" name="photo"></label><br>
        <button type="submit">Guardar</button>
    </form>
    <a href="list.php">⬅️ Volver</a>
</body>
</html>
