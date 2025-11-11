<?php
require_once '../config/db.php';


if (!isset($_GET['id'])) {
    die("ID no proporcionado");
}

$id = (int) $_GET['id'];

// Obtener marca actual
$stmt = $pdo->prepare("SELECT * FROM brands WHERE id = :id");
$stmt->execute(['id' => $id]);
$brand = $stmt->fetch();

if (!$brand) {
    die("Marca no encontrada");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];

    $sql = "UPDATE brands SET name = :name WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'id' => $id]);

    header("Location: list.php?msg=updated");;
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../includes/header.php'; ?>

    <link rel="stylesheet" href="../assets/css/style.css"> <!-- ajustá el path -->
    <meta charset="UTF-8">
    <title>Editar Marca</title>
</head>

<body>
    <div class="container">
        <h1>Editar Marca</h1>
        <form method="post">
            <label>Nombre: <input type="text" name="name" value="<?= $brand['name'] ?>" required></label>
            <button type="submit">Actualizar</button>
        </form>
        <a class="btn-volver" href="/Motorkai_final/dashboard/dashboard.php">⬅️ Volver</a>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>