<?php
require 'conexion.php'; // Asegúrate de que este archivo contiene la configuración de conexión a la base de datos
require '../vendor/autoload.php'; // Ajusta la ruta según sea necesario para cargar PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Obtener los datos enviados desde AngularJS
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    die("No se recibieron datos.");
}

// Ruta de la plantilla Excel
$templatePath = 'factura_template.xlsx'; // Ajusta la ruta de tu plantilla

// Cargar la plantilla Excel
$spreadsheet = IOFactory::load($templatePath);

// Obtener la hoja activa
$sheet = $spreadsheet->getActiveSheet();

// Sobrescribir los datos en la plantilla con los datos obtenidos de la base de datos
$sheet->setCellValue('K8', $data['ur']);
$sheet->setCellValue('P8', $data['numRecibo']);
$sheet->setCellValue('K11', $data['fecha']);
$sheet->setCellValue('D15', $data['apPaterno']);
$sheet->setCellValue('G15', $data['apMaterno']);
$sheet->setCellValue('I15', $data['nombre']);
$sheet->setCellValue('L15', $data['matricula']);
$sheet->setCellValue('D19', $data['direccion']);
$sheet->setCellValue('M18', $data['grado']);
$sheet->setCellValue('O18', $data['area']);
$sheet->setCellValue('P18', $data['turno']);
$sheet->setCellValue('F24', $data['clave']);
$sheet->setCellValue('K24', $data['cuota']);
$sheet->setCellValue('F25', $data['clave2']);
$sheet->setCellValue('K25', $data['cuota2']);
$sheet->setCellValue('F26', $data['clave3']);
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
