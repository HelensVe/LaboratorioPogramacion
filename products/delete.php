<?php
require_once '../config/db.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $sql = "DELETE FROM products WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['id' => $id])) {
        header("Location: list.php?msg=deleted");
        exit;
    } else {
        echo "Error al eliminar el producto.";
    }
}
?>
