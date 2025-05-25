<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mprm.php');
require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
 
$spreadsheet = new Spreadsheet();
$writer = new Xlsx($spreadsheet);
$drawing = new Drawing();
 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');

$mprm = new Mprm();


$datAll = $mprm->getAll("rrhhf");

// if($exl == "prm"){
//     if ($fecini || $fecfin || $estprm || $ndper){
//         $mprm->setNdper($ndper);
//         $mprm->setFecini($fecini);
//         $mprm->setFecfin($fecfin);
//         $mprm->setEstprm(3);
//         $datAll = $mprm->getAll("bus");
//    } else $datAll = $mprm->getAll("rrhhx");
// }

$sheet = $spreadsheet->getActiveSheet();

// Agregar titulo hoja
$sheet->setTitle('PERMISOS');


// Agregar titulo
$sheet->setCellValue('A1', 'BASE DE DATOS');
$sheet->mergeCells('A1:L1');
$style = $sheet->getStyle('A1');
$style->getFont()->setBold(true)->setSize(30);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B8CCE4');

// Agregar encabezados
$sheet->setCellValue('A2', 'COLABORADOR');
$sheet->mergeCells('A2:C2');
$sheet->setCellValue('D2', 'DATOS PERMISO');
$sheet->mergeCells('D2:H2');
$sheet->setCellValue('I2', 'REVISION Y APROBACION');
$sheet->mergeCells('I2:L2');
$style = $sheet->getStyle('A2:L2');
$style->getFont()->setBold(true)->setSize(18);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B7DEE8');

// Agregar titulos

$titulo = ['CEDULA', 'NOMBRE', 'AREA', 'FECHA SOLICITUD', 'TIPO PERMISOS', 'FEC INICIAL-FINAL', 'TIEMPO EN HORAS/DIAS', 'DESCRIPCIÓN', 'FECHA', 'APROBADO/RECHAZADO', 'NOMBRE JEFE', 'OBSERVACIÓN'];


$sheet->fromArray([$titulo], NULL, 'A3');
$style = $sheet->getStyle('A3:L3');
$style->getFont()->setBold(true);

//información
$datos = [];

$datos = [];
if ($datAll) {
    foreach ($datAll as $dat) {
        
            $filaDatos = [$dat['dper'], $dat['aper']." ".$dat['nper'], $dat['cper'],($dat['fecsol']), ($dat['tprm']), ($dat['fecini']) ." - " . ($dat['fecfin']), ($dat['ddif'] ? $dat['ddif'] : ($dat['hdif'] ? $dat['hdif'] : '')), $dat['desprm'], ($dat['fecrev']), ($dat['estprm'] == 3) ? 'Aprobado' : 'Rechazado', $dat['arev'] . " " . $dat['nrev'], $dat['obsprm']];
            $datos[] = $filaDatos;
    }
}
    
// Agregar datos dinámicos
$fila = 4; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
foreach ($datos as $dato) {
    $sheet->fromArray($dato, NULL, 'A' . $fila);
    $sheet->getStyle('D'.$fila.':E'.$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
    if ($dato[9] === 'Aprobado') { // Estado aprobado
        $sheet->getStyle("J{$fila}")->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFC6EFCE');
    } elseif ($dato[9] === 'Rechazado') { // Estado rechazado
        $sheet->getStyle("J{$fila}")->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFFC7CE');
    }
    $fila++;
}

// Definir estilo de borde
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '00000000'],
        ],
    ],
];

// Definir estilo de alineación
$alignmentStyle = [
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];


// Aplicar estilo de borde y alineación a todo el rango de datos
$range = 'A1:L'.($fila - 1); // Rango que cubre todos los datos
$sheet->getStyle($range)->applyFromArray($styleArray);
$sheet->getStyle($range)->applyFromArray($alignmentStyle);

// Ajustar la altura de las filas y el ancho de las columnas
foreach (range('A','L') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);

foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
     
    
// Agregar imagen
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../img/logoartepan_sinfondo.png'); // Ruta a tu imagen
$drawing->setHeight(50); // Altura de la imagen
$drawing->setCoordinates('A1'); // Celda donde se ubicará la imagen
$drawing->setWorksheet($sheet);


$filename = "PERMISOS ARTEPAN ";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>