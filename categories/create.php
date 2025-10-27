<?php 
include("../includes/header.php"); 
require_once "../config/db.php"; // conexión PDO

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($description)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
            $stmt->execute([
                'name' => $name,
                'description' => $description
            ]);
            $success = "Categoría '$name' creada correctamente ✅";
        } catch (PDOException $e) {
            $error = "Error al crear la categoría: " . $e->getMessage();
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<main class="main-content container mt-5">
    <h1 class="mb-4">Nueva Categoría</h1>

    <!-- Mensajes de feedback -->
    <?php if($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php elseif($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Formulario -->
    <form method="post" action="" class="mb-3">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre de Categoría</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Escribe el nombre de la categoría" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea id="description" name="description" class="form-control" placeholder="Escribe una descripción" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="list.php" class="btn btn-secondary">Volver</a>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
