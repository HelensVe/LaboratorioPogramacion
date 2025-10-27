<?php
require_once "../config/db.php";
include "../includes/header.php";

$stmt = $pdo->query("SELECT * FROM users ORDER BY id DESC");
$users = $stmt->fetchAll();
?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center">
    <h2>Usuarios</h2>
    <a href="create.php" class="btn btn-motokai">+ Nuevo Usuario</a>
  </div>

  <table class="table table-dark table-striped mt-3">
    <thead>
      <tr>
        <th>Avatar</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
  <?php foreach($users as $u): ?>
  <tr>
    <td style="width:80px;">
      <?php if(!empty($u['avatar'])): ?>
        <img src="/Motorkai_final/uploads/users/<?=htmlspecialchars($u['avatar'])?>" 
             style="width:60px;height:60px;object-fit:cover;border-radius:6px;">
      <?php else: ?>
        <span class="text-muted">Sin avatar</span>
      <?php endif; ?>
    </td>
    <td><?=htmlspecialchars($u['full_name'] ?? $u['username'])?></td>
    <td><?=htmlspecialchars($u['email'] ?? '-')?></td>
    <td><?=htmlspecialchars($u['role'] ?? '-')?></td>
    <td>
      <a class="btn btn-sm btn-outline-light" href="edit.php?id=<?=$u['id']?>">Editar</a>
      <a class="btn btn-sm btn-danger" href="delete.php?id=<?=$u['id']?>" 
         onclick="return confirm('¿Eliminar usuario?')">Eliminar</a>
    </td>
  </tr>
  <?php endforeach; ?>
</tbody>
  </table>
</div>

<?php include "../includes/footer.php"; ?>
