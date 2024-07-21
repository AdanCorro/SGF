<?php
// Mostrar todos los errores
error_reporting(E_ALL);

// Incluir archivo de conexión
require_once 'conexion.php';

// Preparar la consulta SQL
$stmt = $db->prepare("SELECT numRecibo, matricula, grado, area, turno, clave, fecha FROM facturaDatos");

// Verificar si la consulta se preparó correctamente
if (!$stmt) {
    die('Error en la preparación de la consulta: ' . $db->error);
}

// Ejecutar la consulta
$stmt->execute();

// Vincular variables a los resultados
$stmt->bind_result($numRecibo, $matricula, $grado, $area, $turno, $clave, $fecha);

// Crear un array para almacenar los resultados
$arr = array();

// Iterar sobre los resultados de la consulta
while ($stmt->fetch()) {
    $arr[] = array(
        'numRecibo' => $numRecibo,
        'matricula' => $matricula,
        'grado' => $grado,
        'area' => $area,
        'turno' => $turno,
        'clave' => $clave,
        'fecha' => $fecha
    );
}

// Cerrar la consulta
$stmt->close();

// Devolver los datos en formato JSON
echo json_encode($arr);
?>
