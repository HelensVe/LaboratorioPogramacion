<?php
require_once __DIR__ . "/../config/auth.php";
require_once __DIR__ . "/../config/db.php"; // Debe definir $pdo (PDO)

// Includes comunes (ajusta rutas según tu estructura)
include __DIR__ . "/../includes/header.php";
include __DIR__ . "/../includes/navbar2.php";
// -----------------------------
try {
    $sql = "
        SELECT
            s.id AS sale_id,
            s.date AS sale_date,
            COALESCE(c.name, 'Cliente invitado') AS customer_name,
            SUM(si.quantity) AS total_qty,
            SUM(si.quantity * si.unit_price) AS total_amount,
            GROUP_CONCAT(CONCAT(p.name, ' x', si.quantity) SEPARATOR ' • ') AS products_list,
            COALESCE(s.payment_method, '') AS payment_method,
            COALESCE(s.status, '') AS status
        FROM sales s
        JOIN sale_items si ON si.sale_id = s.id
        JOIN products p ON p.id = si.product_id
        LEFT JOIN customers c ON c.id = s.customer_id
        GROUP BY s.id, s.date, c.name, s.payment_method, s.status
        ORDER BY s.date DESC, s.id DESC
    ";
    $stmt = $pdo->query($sql);
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Si falla (nombres de tablas distintos), lo manejamos mostrando un ejemplo
    $sales = [];
    $error_db = $e->getMessage();
}
?>

<main class="container" style="padding:1.5rem;">
  <h1>Historial de Ventas</h1>

  <?php if (!empty($error_db)): ?>
    <div class="alert alert-danger">
      Error al consultar la base de datos: <?= htmlspecialchars($error_db) ?>
      <br>Si tus tablas usan otros nombres (por ejemplo `orders` en lugar de `sales`) ajustá la consulta en este archivo.
    </div>
  <?php endif; ?>

  <div style="margin: .5rem 0;">
    <a class="btn btn-primary" href="/ventas/create.php">➕ Nueva Venta</a>
  </div>

  <table id="salesTable" class="display" style="width:100%; background: #111; color: #eee; border-collapse:collapse;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Cliente</th>
        <th>Productos</th>
        <th>Cantidad</th>
        <th>Total (ARS)</th>
        <th>Método pago</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($sales)): ?>
        <?php foreach ($sales as $s): ?>
          <tr>
            <td><?= htmlspecialchars($s['sale_id']) ?></td>
            <td><?= htmlspecialchars($s['sale_date']) ?></td>
            <td><?= htmlspecialchars($s['customer_name']) ?></td>
            <td style="max-width:400px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="<?= htmlspecialchars($s['products_list']) ?>">
              <?= htmlspecialchars($s['products_list']) ?>
            </td>
            <td><?= htmlspecialchars($s['total_qty']) ?></td>
            <td>$<?= number_format($s['total_amount'], 2, ',', '.') ?></td>
            <td><?= htmlspecialchars($s['payment_method']) ?></td>
            <td><?= htmlspecialchars($s['status']) ?></td>
            <td>
              <a href="view.php?id=<?= $s['sale_id'] ?>">🔍 Ver</a>
              |
              <a href="invoice.php?id=<?= $s['sale_id'] ?>" target="_blank">🧾 Factura</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <!-- Fallback: ejemplo si no hay tabla o consulta falló -->
        <tr>
          <td>1</td>
          <td>2025-09-15</td>
          <td>Cliente Ejemplo</td>
          <td>Producto A x2 • Producto B x1</td>
          <td>3</td>
          <td>$2.000,00</td>
          <td>Efectivo</td>
          <td>Completada</td>
          <td><a href="#">🔍 Ver</a></td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include __DIR__ . "/../includes/footer.php"; ?>

<!-- DataTables (CDN). Si preferís no usar CDN, podés descargar los archivos y servirlos localmente -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<!-- Para exportar a Excel/PDF se usan dependencias adicionales (SheetJS/pdfmake). Incluyo las mínimas: -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<script>
  $(document).ready(function() {
    $('#salesTable').DataTable({
      pageLength: 25,
      order: [[1, 'desc']], // ordenar por fecha descendente (columna 1)
      dom: 'Bfrtip',
      buttons: [
        { extend: 'csvHtml5', text: 'Exportar CSV' },
        { extend: 'excelHtml5', text: 'Exportar Excel' },
        { extend: 'pdfHtml5', text: 'Exportar PDF' },
        { extend: 'print', text: 'Imprimir' }
      ],
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
      }
    });
  });
</script>
