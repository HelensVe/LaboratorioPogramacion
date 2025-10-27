<?php 
include("../includes/header.php"); 
// require_once "../config/auth.php"; 
require_once "../config/db.php"; // Conexión PDO

// Verificamos que venga el id por GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
    } catch (PDOException $e) {
        // No mostramos errores complejos para simplificar
    }
}
?>

<main class="container mt-5 text-center">
    <div class="alert alert-success">
        ✅ La categoría fue eliminada correctamente.
    </div>
    <a href="list.php" class="btn btn-primary">Volver a categorías</a>
</main>

<?php include("../includes/footer.php"); ?>
