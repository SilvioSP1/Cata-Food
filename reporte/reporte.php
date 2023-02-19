<?php 

include "../admin/config/db.php";
require "../vendor/autoload.php";
session_start();
error_reporting(0);

use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};

$sentenciaSQL = $conexion->prepare("SELECT * FROM venta_detalle 
JOIN venta ON Venta_Id = VD_VentaId 
JOIN producto ON Prod_Id = VD_ProdId 
WHERE Prod_LocalId = 6");
$sentenciaSQL->execute();
$listaVentas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheet();
$hojaActiva =  $excel->getActiveSheet();
$hojaActiva->setTitle("Ventas");

$hojaActiva->setCellValue('A1','ID VENTA');
$hojaActiva->setCellValue('B1','ID VENTA DETALLE');
$hojaActiva->setCellValue('C1','NOMBRE');
$hojaActiva->setCellValue('D1','PRECIO');
$hojaActiva->setCellValue('E1','CANTIDAD');
$hojaActiva->setCellValue('F1','FECHA');
$hojaActiva->setCellValue('G1','TIPO');
$hojaActiva->setCellValue('H1','TOTAL VENTA');

$fila = 2;

/* foreach ($listaVentas as $ventas) {
    $hojaActiva->setCellValue('A'.$fila,$ventas['Venta_Id']);
    $hojaActiva->setCellValue('B'.$fila,$ventas['VD_Id']);
    $hojaActiva->setCellValue('C'.$fila,$ventas['Prod_Nombre']);
    $hojaActiva->setCellValue('D'.$fila,$ventas['Prod_Precio']);
    $hojaActiva->setCellValue('E'.$fila,$ventas['VD_Cantidad']);
    $hojaActiva->setCellValue('F'.$fila,$ventas['Venta_Fecha']);
    $hojaActiva->setCellValue('G'.$fila,$ventas['Prod_Tipo']);
    $hojaActiva->setCellValue('H'.$fila,$ventas['Venta_Total']);
    $fila++;
} */

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('hello world.xlsx');
exit; 

/* use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx'); */
?>