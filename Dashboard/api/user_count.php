<?php
header('Content-Type: application/json');
require_once '../config/db.php';

$stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
echo json_encode($stmt->fetch());
?>