<?php 

include "../admin/config/db.php"
include "../admin/config/config.php"
include "../vendor/autoload.php"

use PhpOffice\PhpSpreadsheet\{Spreadsheet,IOFactory};

$sentenciaSQL = $conexion->prepare("SELECT * FROM venta_detalle 
JOIN venta ON Venta_Id = VD_VentaId 
JOIN producto ON Prod_Id = VD_ProdId 
WHERE Prod_LocalId = :Prod_LocalId");
$sentenciaSQL->bindParam(':Prod_LocalId',$_SESSION['idLocal']);
$sentenciaSQL->execute();
$listaVentas = $sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$excel = new Spreadsheets();
$hojaActiva =  $excel->getActivateSheet();
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

foreach ($listaVentas as $ventas) {
    $hojaActiva->setCellValue('A'.$fila,$ventas['Venta_Id']);
    $hojaActiva->setCellValue('B'.$fila,$ventas['VD_Id']);
    $hojaActiva->setCellValue('C'.$fila,$ventas['Prod_Nombre']);
    $hojaActiva->setCellValue('D'.$fila,$ventas['Prod_Precio']);
    $hojaActiva->setCellValue('E'.$fila,$ventas['VD_Cantidad']);
    $hojaActiva->setCellValue('F'.$fila,$ventas['Venta_Fecha']);
    $hojaActiva->setCellValue('G'.$fila,$ventas['Prod_Tipo']);
    $hojaActiva->setCellValue('H'.$fila,$ventas['Venta_Total']);
    $fila++;
}

/* header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte"')
header('Cache-Control: max-age=0'); */
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
exit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>