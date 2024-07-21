<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "factura";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents("php://input"));

    $sql = "INSERT INTO facturaDatos (ur, fecha, entidadFederativa, ApPaterno, ApMaterno, nombre, matricula, direccion, grado, area, turno, cantidad, clave, cuota, importe)
            VALUES (:ur, :fecha, :entidadFederativa, :ApPaterno, :ApMaterno, :nombre, :matricula, :direccion, :grado, :area, :turno, :cantidad, :clave, :cuota, :importe)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':ur', $data->ur);
    $stmt->bindParam(':fecha', $data->fecha);
    $stmt->bindParam(':entidadFederativa', $data->entidadFederativa);
    $stmt->bindParam(':ApPaterno', $data->ApPaterno);
    $stmt->bindParam(':ApMaterno', $data->ApMaterno);
    $stmt->bindParam(':nombre', $data->nombre);
    $stmt->bindParam(':matricula', $data->matricula);
    $stmt->bindParam(':direccion', $data->direccion);
    $stmt->bindParam(':grado', $data->grado);
    $stmt->bindParam(':area', $data->area);
    $stmt->bindParam(':turno', $data->turno);
    $stmt->bindParam(':cantidad', $data->cantidad);
    $stmt->bindParam(':clave', $data->clave);
    $stmt->bindParam(':cuota', $data->cuota);
    $stmt->bindParam(':importe', $data->importe);

    $stmt->execute();
    
    echo json_encode(["message" => "Nuevo registro creado con éxito"]);
} catch(PDOException $e) {
    echo json_encode(["message" => "Error: " . $e->getMessage()]);
}

$conn = null;
?>
