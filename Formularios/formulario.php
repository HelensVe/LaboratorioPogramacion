<?php
// Conexión a la base de datos (ajustá los datos según tu XAMPP/WAMP/MAMP)
$servername = "localhost";
$username   = "root";   // usuario por defecto en XAMPP
$password   = "";       // contraseña por defecto en XAMPP (vacía)
$dbname     = "formulario_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario con Base de Datos</title>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $email  = $_POST["email"];

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email) VALUES ('$nombre', '$email')";

        if ($conn->query($sql) === TRUE) {
            echo "<h2>Datos guardados correctamente:</h2>";
            echo "Nombre: " . htmlspecialchars($nombre) . "<br>";
            echo "Correo Electrónico: " . htmlspecialchars($email) . "<br><br>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>

    <h2>Formulario de Registro</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nombre: <br>
        <input type="text" name="nombre" required><br><br>
        Correo Electrónico: <br>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
