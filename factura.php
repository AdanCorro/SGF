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

// Obtener datos de la solicitud
$data = json_decode(file_get_contents("php://input"), true);

// Validar campos requeridos
if (empty($data['ur']) || empty($data['fecha']) || empty($data['entidadFederativa']) || empty($data['ApPaterno']) || empty($data['ApMaterno']) || empty($data['nombre']) || empty($data['matricula']) || empty($data['direccion']) || empty($data['grado']) || empty($data['clave']) || empty($data['turno']) || empty($data['cuota']) || empty($data['importe']) || empty($data['area'])) {
    die(json_encode(["success" => false, "error" => "Todos los campos son obligatorios"]));
}

// Asignar valores a variables
$ur = $data['ur'];
$fecha = $data['fecha'];
$entidadFederativa = $data['entidadFederativa'];
$apPaterno = $data['ApPaterno'];
$apMaterno = $data['ApMaterno'];
$nombre = $data['nombre'];
$matricula = $data['matricula'];
$direccion = $data['direccion'];
$grado = $data['grado'];
$clave = $data['clave'];
$turno = $data['turno'];
$cuota = $data['cuota'];
$importe = $data['importe'];
$area = $data['area'];
$clave2 = isset($data['clave2']) ? $data['clave2'] : null;
$cuota2 = isset($data['cuota2']) ? $data['cuota2'] : null;
$clave3 = isset($data['clave3']) ? $data['clave3'] : null;
$cuota3 = isset($data['cuota3']) ? $data['cuota3'] : null;

// Validar claves adicionales
$valid_claves = ['A001', 'A002', 'A003', 'A004', 'B001', 'B002', 'B003', 'C006'];
if (($clave2 && !in_array($clave2, $valid_claves)) || ($clave3 && !in_array($clave3, $valid_claves))) {
    die(json_encode(["success" => false, "error" => "Clave no encontrada en la tabla claves"]));
}

// Preparar y ejecutar la consulta
$stmt = $conn->prepare("INSERT INTO facturaDatos (ur, fecha, entidadFederativa, apPaterno, apMaterno, nombre, matricula, direccion, grado, area, turno, clave, cuota, importe, clave2, cuota2, clave3, cuota3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die(json_encode(["success" => false, "error" => "Error al preparar la consulta: " . $conn->error]));
}

$stmt->bind_param("issssssssissdssdsd", $ur, $fecha, $entidadFederativa, $apPaterno, $apMaterno, $nombre, $matricula, $direccion, $grado, $area, $turno, $clave, $cuota, $importe, $clave2, $cuota2, $clave3, $cuota3);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Error al ejecutar la consulta: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
