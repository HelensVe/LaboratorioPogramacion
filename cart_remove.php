<?php
require_once 'db.php';
session_start();
$id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;
if ($id && $user_id) {
  $stmt = $pdo->prepare("DELETE FROM cart_items WHERE id = ? AND user_id = ?");
  $stmt->execute([$id, $user_id]);
}
header('Location: cart.php');
