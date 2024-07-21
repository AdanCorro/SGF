<?php
// Establece que se muestren todos los errores
error_reporting(E_ALL);

// Incluye el archivo de conexión a la base de datos
require_once 'conexion.php';

// Decodifica los datos JSON recibidos
$obj = json_decode(file_get_contents("php://input"));

// Prepara la consulta SQL para insertar datos en la tabla "Producto" sin el campo auto-incrementado "idProducto"
$stmt = $db->prepare("INSERT INTO facturaDatos(numRecibo, matricula, grado, area, turno, clave) VALUES(?, ?, ?, ?, ?, ?)");

// Vincula los parámetros de la consulta SQL
$stmt->bind_param('ssssss', $obj->numRecibo, $obj->matricula, $obj->grado, $obj->area, $obj->turno, $obj->clave);

// Ejecuta la consulta
$stmt->execute();

// Cierra la consulta
$stmt->close();

// Muestra un mensaje indicando que el registro ha sido guardado
echo "Registro Guardado";
?>
