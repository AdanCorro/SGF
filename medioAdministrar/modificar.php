<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt=$db->prepare("UPDATE facturaDatos SET matricula=?, grado=?, area=?, turno=?, clave=? WHERE numRecibo=?");

$stmt->bind_param('ssssss',$obj->matricula, $obj->grado, $obj->area, $obj->turno, $obj->clave, $obj->numRecibo);

$stmt->execute();

$stmt->close();

echo "Registro Modificado";
?>