<?php
require_once "../config/auth.php";
require_once "../config/db.php";

// traer conteos básicos
$counts = [];
$counts['users'] = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$counts['products'] = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$counts['sales'] = $pdo->query("SELECT COUNT(*) FROM sales")->fetchColumn();
$counts['categories'] = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<?php include __DIR__ . "/../includes/header.php"; ?>

<body class="bg-dark text-light">
  <?php include __DIR__ . "/../includes/navbar2.php"; ?>


  <div class="container">
    <h1 class="mb-4">Bienvenido al Dashboard</h1>

    <div class="row g-3 mb-4">
      <div class="col-6 col-md-3">
        <div class="card card-motokai p-3 text-center">
          <h5 class="text-success">Usuarios</h5>
          <h2><?= htmlspecialchars($counts['users']) ?></h2>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-motokai p-3 text-center">
          <h5 class="text-success">Productos</h5>
          <h2><?= htmlspecialchars($counts['products']) ?></h2>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-motokai p-3 text-center">
          <h5 class="text-success">Ventas</h5>
          <h2><?= htmlspecialchars($counts['sales']) ?></h2>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="card card-motokai p-3 text-center">
          <h5 class="text-success">Categorías</h5>
          <h2><?= htmlspecialchars($counts['categories']) ?></h2>
        </div>
      </div>
    </div>

    <div class="card card-motokai p-3 mb-4">
      <h5>Ventas del último mes</h5>
      <canvas id="salesChart"></canvas>
    </div>

  </div>

  <script>
    // datos de ejemplo; luego podés generar desde PHP y JSON encode
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Semana 1', 'Semana 2', 'Semana 3', 'Semana 4'],
        datasets: [{
          label: 'Ventas',
          data: [12, 19, 15, 22],
          borderColor: '#00ff44',
          backgroundColor: 'rgba(0,255,68,0.15)',
          fill: true,
          tension: 0.3
        }]
      },
      options: {
        plugins: { legend: { labels: { color: '#fff' } } },
        scales: {
          x: { ticks: { color: '#bbb' } },
          y: { grid: { color: 'rgba(255,255,255,0.03)' }, ticks: { color: '#bbb' } }
        }
      }
    });
  </script>

  <?php include "../includes/footer.php"; ?>