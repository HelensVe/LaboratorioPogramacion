<?php
require_once __DIR__ . "/config/db.php";
session_start();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Si querés presentar la pantalla sin login para la entrega: mostrar demo
    $demo = true;
} else {
    $demo = false;
}

// Si demo: crear array de ejemplo
if ($demo) {
    $cart_items = [
        ['id' => 1, 'product' => 'Aceite 1L', 'qty' => 2, 'price' => 1200],
        ['id' => 2, 'product' => 'Filtro de aire', 'qty' => 1, 'price' => 650],
    ];
} else {
    $stmt = $pdo->prepare("SELECT c.id, p.name, c.qty, p.price FROM cart_items c JOIN products p ON c.product_id=p.id WHERE c.user_id = ?");
    $stmt->execute([$user_id]);
    $cart_items = $stmt->fetchAll();
}
$total = 0;
foreach ($cart_items as $it) $total += $it['qty'] * $it['price'];
?>
<!doctype html>
<html>

<head>
    <?php include 'includes/header.php'; ?>
    <meta charset="utf-8">
    <title>Carrito - Motorkai</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.0/css/all.css">
</head>

<body class="mk-body">

    <main class="container">
        <section class="panel">
            <h1 class="panel-title">Tu Carrito</h1>
            <table class="tabla-marcas">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unit.</th>
                        <th>Subtotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $it): ?>
                        <tr>
                            <td><?= htmlspecialchars($it['product']) ?></td>
                            <td><?= $it['qty'] ?></td>
                            <td>$<?= number_format($it['price'], 2, ',', '.') ?></td>
                            <td>$<?= number_format($it['qty'] * $it['price'], 2, ',', '.') ?></td>
                            <td><a class="link-edit" href="cart_remove.php?id=<?= $it['id'] ?>"><i class="fa-solid fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;font-weight:700">Total:</td>
                        <td colspan="2">$<?= number_format($total, 2, ',', '.') ?></td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top:16px; text-align:right;">
                <a class="btn-volver" href="/Motorkai_final/dashboard/dashboard.php">⬅️ Volver</a>
                <a class="btn-volver" href="checkout.php"><i class="fa-solid fa-credit-card"></i> Finalizar compra</a>
            </div>
        </section>
    </main>
    <?php include 'includes/footer.php'; ?>
</body>


</html>