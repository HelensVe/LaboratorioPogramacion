<?php
session_start();

// Si no hay usuario logueado, redirigir al login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
