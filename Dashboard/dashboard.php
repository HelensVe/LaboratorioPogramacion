<?php
require_once 'includes/auth.php';
checkLogin();
require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/script.js" defer></script>
</head>
<body class="dashboard-body">
    <div class="sidebar">
        <h2>📊 Dashboard</h2>
        <ul>
            <li><a href="#" onclick="showSection('home')">Inicio</a></li>
            <li><a href="#" onclick="showSection('users')">Usuarios</a></li>
            <li><a href="#" onclick="showSection('settings')">Configuración</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?> 👋</h1>
            <p>Panel de control moderno y seguro.</p>
        </header>

        <div id="home" class="section active">
            <div class="card-grid">
                <div class="card">
                    <h3>Usuarios</h3>
                    <p id="user-count">Cargando...</p>
                </div>
                <div class="card">
                    <h3>Sesión activa</h3>
                    <p><?php echo date('d/m/Y H:i'); ?></p>
                </div>
                <div class="card">
                    <h3>Estado</h3>
                    <p>✅ Todo correcto</p>
                </div>
            </div>
        </div>

        <div id="users" class="section">
            <h2>Gestión de Usuarios</h2>
            <table id="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cargado por JS -->
                </tbody>
            </table>
        </div>

        <div id="settings" class="section">
            <h2>Configuración</h2>
            <p>🛠️ Aquí puedes gestionar ajustes del sistema.</p>
            <button onclick="alert('Función en desarrollo')">Guardar</button>
        </div>
    </div>
</body>
</html>