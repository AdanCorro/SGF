<?php
// Establece que se muestren todos los errores
error_reporting(E_ALL);

// Incluye el archivo de conexión a la base de datos
require_once 'conexion.php';

// Decodifica los datos JSON recibidos
$obj = json_decode(file_get_contents("php://input"));

// Prepara la consulta SQL para eliminar el producto usando su ID
$stmt = $db->prepare("DELETE FROM facturaDatos WHERE numRecibo=?");

// Vincula el parámetro de la consulta SQL
$stmt->bind_param('s', $obj->numRecibo);

// Ejecuta la consulta
$stmt->execute();

// Cierra la consulta
$stmt->close();

// Muestra un mensaje indicando que el registro ha sido eliminado
echo "Registro Eliminado";
?>
