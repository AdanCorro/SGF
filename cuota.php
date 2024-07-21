<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "factura";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["success" => false, "error" => "Conexión fallida: " . $conn->connect_error]));
}

// Obtener la clave de la solicitud
$clave = $_GET['clave'];

// Preparar y ejecutar la consulta
$stmt = $conn->prepare("SELECT cuota FROM claves WHERE clave = ?");
if ($stmt === false) {
    die(json_encode(["success" => false, "error" => "Error al preparar la consulta: " . $conn->error]));
}

$stmt->bind_param("s", $clave);
$stmt->execute();
$stmt->bind_result($cuota);
$stmt->fetch();

if ($cuota !== null) {
    echo json_encode(["success" => true, "cuota" => $cuota]);
} else {
    echo json_encode(["success" => false, "error" => "Clave no encontrada"]);
}

$stmt->close();
$conn->close();
?>
