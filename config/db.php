<?php
// config/db.php
$DB_HOST = 'localhost';
$DB_NAME = 'motorkai_db';
$DB_USER = 'root';
$DB_PASS = ''; // si tenés contraseña en XAMPP, ponela

try {
    $pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4", $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    // En dev mostramos el error; en producción loguear y mostrar mensaje genérico
    die("DB Connection failed: " . $e->getMessage());
}
