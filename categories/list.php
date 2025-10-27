<?php
require_once "../config/db.php"; // Conexión PDO

// Obtener todas las categorías
try {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY id ASC");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener categorías: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Categorías - Motorkai</title>
    <link rel="stylesheet" href="../assets/style.css"> 
    <?php include '../includes/header.php'; ?> 
</head>

<body class="bg-dark text-light"> 
    <div class="container">
        <h1>Categorías</h1>

        <div class="botones-superiores"> 
            <a href="create.php" class="btn-nueva">➕ Nueva Categoría</a> 
            <a href="/Motorkai_final/dashboard/dashboard.php" class="btn-volver">⬅️ Volver</a> 
        </div>

        <table class="tabla-categorias"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?= htmlspecialchars($cat['id']) ?></td>
                            <td><?= htmlspecialchars($cat['name']) ?></td>
                            <td><?= htmlspecialchars($cat['description']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $cat['id'] ?>" class="btn-editar">✏️ Editar</a> |
                                <a href="delete.php?id=<?= $cat['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que querés eliminar esta categoría?');">🗑️ Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No hay categorías registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php include("../includes/footer.php"); ?>
</body>
</html>