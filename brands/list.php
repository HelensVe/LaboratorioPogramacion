<?php
require_once '../config/db.php';

// Trae todas las marcas ordenadas por ID descendente
$sql = "SELECT * FROM brands ORDER BY id DESC";
$stmt = $pdo->query($sql);
$brands = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Marcas - Motorkai</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <?php include '../includes/header.php'; ?>
</head>

<body class="bg-dark text-light">
    <div class="container">
        <h1>Listado de Marcas</h1>

        <div class="botones-superiores">
            <a class="btn-nueva" href="create.php">➕ Nueva Marca</a>
            <a class="btn-volver" href="/Motorkai_final/dashboard/dashboard.php">⬅️ Volver</a>
        </div>

        <table class="tabla-marcas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($brands as $brand): ?>
                    <tr>
                        <td><?= $brand['id'] ?></td>
                        <td><?= htmlspecialchars($brand['name']) ?></td>
                        <td>
                            <a class="btn-editar" href="edit.php?id=<?= $brand['id'] ?>">✏️ Editar</a> |
                            <a class="btn-eliminar" href="delete.php?id=<?= $brand['id'] ?>"
                                onclick="return confirm('¿Seguro que deseas eliminar esta marca?')">
                                🗑️ Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include '../includes/footer.php'; ?>
</body>

</html>
