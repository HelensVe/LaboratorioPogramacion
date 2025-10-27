<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['brand_name']; // corregí el nombre del campo

    $sql = "INSERT INTO brands (name) VALUES (:name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);

    header("Location: list.php?msg=created");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../includes/header.php'; ?> <!-- 💡 Mover aquí -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <meta charset="UTF-8">
    <title>Agregar Marca</title>
</head>

<body>

    <div class="container mt-5">
        <div class="card-motorkai p-4">
            <h2 class="mb-4 text-center">Agregar nueva marca - Motorkai</h2>

            <form action="create.php" method="POST">
                <div class="mb-3">
                    <label for="brand_name" class="form-label">Nombre de la marca</label>
                    <input type="text" name="brand_name" id="brand_name" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="../brands/list.php" class="btn btn-outline-light">Volver</a>
                    <button type="submit" class="btn btn-motorkai">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>