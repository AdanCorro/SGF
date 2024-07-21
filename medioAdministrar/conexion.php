<?php
// Información de conexión a la base de datos
$dbConnect = array(
    'server' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'dbname' => 'factura'
);

// Se establece la conexión a la base de datos utilizando MySQLi
$db = new mysqli(
    $dbConnect['server'], // Servidor de la base de datos
    $dbConnect['user'],   // Usuario de la base de datos
    $dbConnect['pass'],   // Contraseña de la base de datos
    $dbConnect['dbname']  // Nombre de la base de datos
);

// Verifica si hay errores en la conexión a la base de datos
if ($db->connect_errno > 0) {
    // Si hay errores, muestra un mensaje de error y finaliza el script
    echo "Error de conexión a la base de datos: " . $db->connect_error;
    exit;
}

// Configura la conexión para que utilice la codificación UTF-8
$acentos = $db->query("SET NAMES 'utf8'");
?>
