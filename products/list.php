<?php
require_once "../config/auth.php";
require_once "../config/db.php";

// Traer productos
$sql = "SELECT * FROM products ORDER BY id DESC";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . "/../includes/header.php"; ?>

<body class="bg-dark text-light">
  <?php include __DIR__ . "/../includes/navbar2.php"; ?>
<body>
    <h1>Listado de Productos</h1>
    <a href="create.php">➕ Nuevo Producto</a>
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($products as $prod): ?>
            <tr>
                <td><?= $prod['id'] ?></td>
                <td><?= $prod['name'] ?></td>
                <td>$<?= $prod['price'] ?></td>
                <td><?= $prod['stock'] ?></td>
                <td>
                    <?php if (!empty($prod['photo'])): ?>
                        <img src="<?= $prod['photo'] ?>" width="60" height="60">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
                <td>
                    <a href="edit.php?id=<?= $prod['id'] ?>">✏️ Editar</a> |
                    <a href="delete.php?id=<?= $prod['id'] ?>" onclick="return confirm('¿Eliminar producto?')">🗑️ Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>


<?php include "../includes/footer.php"; ?>
