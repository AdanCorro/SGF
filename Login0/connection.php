<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "factura";
$port = 3306; // Cambia este número al puerto que esté usando MySQL

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión exitosa"; // Esta línea ha sido comentada
} catch(PDOException $e) {
    echo "Conexión fallida: " . $e->getMessage();
}
?>
