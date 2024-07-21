<?php
// conexion.php
$servername = "localhost";
$username = "root";
$password = "";
$db = "factura";

$mysqli = new mysqli($servername, $username, $password, $db);

// Crear conexión
$conn = new mysqli($servername, $username, $password, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
