<?php
require 'conexion.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Obtener el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Validar que se recibió el número de recibo
if (!isset($data['numRecibo'])) {
    http_response_code(400);
    echo json_encode(["error" => "Número de recibo no proporcionado"]);
    exit;
}

$numRecibo = $data['numRecibo'];

// Definir la consulta SQL para obtener los datos de la factura
$sql = "SELECT ur, numRecibo, fecha, ApPaterno, ApMaterno, nombre, matricula, direccion, grado, area, turno, clave, cuota, clave2, cuota2, clave3, cuota3, importe FROM facturaDatos WHERE numRecibo = ?";

// Preparar la consulta
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $numRecibo);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si se obtuvieron resultados
if ($resultado->num_rows == 0) {
    http_response_code(404);
    echo json_encode(["error" => "Factura no encontrada"]);
    exit;
}

// Obtener los datos de la primera fila del resultado
$data = $resultado->fetch_assoc();

// Obtener los nombres de las claves
$claves = [];
$claveIds = [$data['clave'], $data['clave2'], $data['clave3']];
$sqlClaves = "SELECT clave, descripcion FROM claves WHERE clave IN (?, ?, ?)";
$stmtClaves = $db->prepare($sqlClaves);
$stmtClaves->bind_param("sss", $claveIds[0], $claveIds[1], $claveIds[2]);
$stmtClaves->execute();
$resultadoClaves = $stmtClaves->get_result();

while ($fila = $resultadoClaves->fetch_assoc()) {
    $claves[$fila['clave']] = $fila['descripcion'];
}

// Ruta de la plantilla Excel
$templatePath = 'factura_template.xlsx'; 

// Cargar la plantilla Excel
$spreadsheet = IOFactory::load($templatePath);

// Obtener la hoja activa
$sheet = $spreadsheet->getActiveSheet();

// Sobrescribir los datos en la plantilla con los datos obtenidos de la base de datos
$sheet->setCellValue('K8', $data['ur']);
$sheet->setCellValue('P8', $data['numRecibo']);
$sheet->setCellValue('K11', $data['fecha']);
$sheet->setCellValue('D15', $data['ApPaterno']);
$sheet->setCellValue('G15', $data['ApMaterno']);
$sheet->setCellValue('I15', $data['nombre']);
$sheet->setCellValue('L15', $data['matricula']);
$sheet->setCellValue('D19', $data['direccion']);
$sheet->setCellValue('M18', $data['grado']);
$sheet->setCellValue('O18', $data['area']);
$sheet->setCellValue('P18', $data['turno']);

// Clave y descripción en celdas separadas
$sheet->setCellValue('F24', $data['clave']); // Clave
$sheet->setCellValue('G24', $claves[$data['clave']] ?? ''); // Descripción de la clave
$sheet->setCellValue('F25', $data['clave2']); // Clave2
$sheet->setCellValue('G25', $claves[$data['clave2']] ?? ''); // Descripción de la clave2
$sheet->setCellValue('F26', $data['clave3']); // Clave3
$sheet->setCellValue('G26', $claves[$data['clave3']] ?? ''); // Descripción de la clave3

$sheet->setCellValue('K24', $data['cuota']);
$sheet->setCellValue('K25', $data['cuota2']);
$sheet->setCellValue('K26', $data['cuota3']);
$sheet->setCellValue('O27', $data['importe']);

// Crear el archivo Excel
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

// Configurar los encabezados HTTP para la descarga del archivo Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="factura.xlsx"');
header('Cache-Control: max-age=0');

// Guardar el archivo Excel en la salida
$writer->save('php://output');
exit;
?>
