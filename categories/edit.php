<?php 
include("../includes/header.php"); 
// require_once "../config/auth.php"; 
require_once "../config/db.php"; // Conexión PDO

$success = '';
$error = '';

// Verificar que venga un id válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de categoría inválido.");
}

$id = (int) $_GET['id'];

// Obtener los datos actuales de la categoría
try {
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        die("Categoría no encontrada.");
    }
} catch (PDOException $e) {
    die("Error al obtener la categoría: " . $e->getMessage());
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($description)) {
        try {
            $stmt = $pdo->prepare("UPDATE categories SET name = :name, description = :description WHERE id = :id");
            $stmt->execute([
                'name' => $name,
                'description' => $description,
                'id' => $id
            ]);
            $success = "Categoría actualizada correctamente ✅";

            // Actualizar los datos para mostrarlos nuevamente en el formulario
            $category['name'] = $name;
            $category['description'] = $description;

        } catch (PDOException $e) {
            $error = "Error al actualizar la categoría: " . $e->getMessage();
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<main class="main-content container mt-5">
    <h1 class="mb-4">Editar Categoría</h1>

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
            <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($category['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea id="description" name="description" class="form-control" required><?= htmlspecialchars($category['description']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="list.php" class="btn btn-secondary">Volver</a>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
