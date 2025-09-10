<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$stmt = $pdo->query("SELECT id, username, created_at FROM users ORDER BY id");
echo json_encode($stmt->fetchAll());
?>