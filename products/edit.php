<?php
require_once '../config/db.php';

if (!isset($_GET['id'])) {
    die("ID no proporcionado");
}

$id = (int) $_GET['id'];

// Obtener producto actual
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();

if (!$product) {
    die("Producto no encontrado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name   = $_POST['name'];
    $price  = $_POST['price'];
    $stock  = $_POST['stock'];
    $photo  = $_POST['photo'];

    $sql = "UPDATE products SET name = :name, price = :price, stock = :stock, photo = :photo WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'price' => $price,
        'stock' => $stock,
        'photo' => $photo,
        'id'    => $id
    ]);

    header("Location: list.php?msg=updated");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form method="post">
        <label>Nombre: <input type="text" name="name" value="<?= $product['name'] ?>" required></label><br>
        <label>Precio: <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required></label><br>
        <label>Stock: <input type="number" name="stock" value="<?= $product['stock'] ?>" required></label><br>
        <label>Foto: <input type="text" name="photo" value="<?= $product['photo'] ?>"></label><br>
        <button type="submit">Actualizar</button>
    </form>
    <a href="list.php">⬅️ Volver</a>
</body>
</html>
<?php include "../includes/footer.php"; ?>
