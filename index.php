<?php
require_once __DIR__ . "/config/db.php";

// Productos más elegidos (los primeros 3 con más stock o precio, podés ajustar)
try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY stock DESC LIMIT 3");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error al obtener productos: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . "/includes/header.php"; ?>

<body class="bg-dark text-light">
    <?php include __DIR__ . "/includes/navbar2.php"; ?>

    <div class="container text-center mt-5">
        <!-- Logo / Nombre: Se quitó 'text-success' para usar el color del CSS (h1) -->
        <h1 class="display-3 fw-bold">MOTORKAI</h1>
        <p class="lead">Tienda de repuestos y accesorios para tu moto 🏍️</p>


        <!-- Sección productos destacados -->
        <div class="mt-5">
            <h2 class="mb-4">🔥 Los más elegidos 🔥</h2>
            <div class="row justify-content-center">
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $row): ?>
                        <div class="col-md-3">
                            <!-- Se quitó 'border-success' y 'bg-dark' (la tarjeta tiene su propio estilo) -->
                            <div class="card-motorkai mb-4">
                                <?php if (!empty($row['photo'])): ?>
                                    <img src="uploads/<?= htmlspecialchars($row['photo']) ?>" class="card-img-top"
                                        alt="<?= htmlspecialchars($row['name']) ?>">
                                <?php else: ?>
                                    <img src="assets/img/default-product.png" class="card-img-top" alt="default">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($row['name']) ?></h5>
                                    <p class="card-text">$<?= number_format($row['price'], 2) ?></p>
                                    <!-- Se cambió 'btn-outline-success' por la clase personalizada 'btn-motorkai' -->
                                    <button class="btn-motorkai btn-sm">Ver más</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay productos disponibles.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>