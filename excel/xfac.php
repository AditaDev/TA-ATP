<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mfac.php');

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
 
$spreadsheet = new Spreadsheet();
$writer = new Xlsx($spreadsheet);
$drawing = new Drawing();
 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');

$mfac = new Mfac();

$datAll = $mfac->getAll();

$sheet = $spreadsheet->getActiveSheet();

// Agregar titulo hoja
$sheet->setTitle('FACTURAS');


// Agregar titulo
$sheet->setCellValue('A1', 'BASE DE DATOS');
$sheet->mergeCells('A1:P1');
$style = $sheet->getStyle('A1');
$style->getFont()->setBold(true)->setSize(30);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B8CCE4');

// Agregar encabezados
$sheet->setCellValue('A2', 'DATOS DE PROVEEDORES');
$sheet->mergeCells('A2:B2');
$sheet->setCellValue('C2', 'DATOS DE FACTURAS');
$sheet->mergeCells('C2:H2');
$sheet->setCellValue('I2', 'DATOS REVISION Y APROBACION');
$sheet->mergeCells('I2:P2');
$style = $sheet->getStyle('A2:P2');
$style->getFont()->setBold(true)->setSize(18);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B7DEE8');

// Agregar titulos

$titulo = [ 'NIT' ,'NOMBRE', 'FECHA REGISTRO', 'NUMERO FACTURA', 'FECHA EMISION', 'FECHA VENCIMIENTO', 'TIPO FACTURA', 'ESTADO', 'REGISTRO', 'PRIMERA REVISION', 'REVISADA', 'ENTREGADA', 'PAGADA', 'NOVEDAD', 'OBSERVACION', '# EGRESO'];


$sheet->fromArray([$titulo], NULL, 'A3');
$style = $sheet->getStyle('A3:P3');
$style->getFont()->setBold(true);

//información
$datos = [];

if ($datAll) {
    foreach ($datAll as $dat) {
        $filaDatos = [$dat['nitemp'], $dat['razsoem'], $dat['fifac'], $dat['nofac'], $dat['fefac'], $dat['fvfac'], $dat['tip'], $dat['est'], 
            !empty($dat['nompcre']) ? $dat['nompcre'] . " - " . $dat['fifac'] : '',
            !empty($dat['nomprev']) ? $dat['nomprev'] . " - " . $dat['fprfac'] : '',
            !empty($dat['nompapr']) ? $dat['nompapr'] . " - " . $dat['faprfac'] : '',
            !empty($dat['nompent']) ? $dat['nompent'] . " - " . $dat['fffac'] : '',
            !empty($dat['nomppag']) ? $dat['nomppag'] . " - " . $dat['fpagfac'] : '',
            !empty($dat['nompnov']) ? $dat['nompnov'] . " - " . $dat['fnov'] : '',
            !empty($dat['obsnov']) ? $dat['obsnov'] : '',
            !empty($dat['numegr']) ? $dat['numegr'] : ''
        ];
        $datos[] = $filaDatos;
    }
}
    
// Agregar datos dinámicos
$fila = 4; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
foreach ($datos as $dato) {
    $sheet->fromArray($dato, NULL, 'A' . $fila);
    $sheet->getStyle('D'.$fila.':E'.$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
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
$range = 'A1:P'.($fila - 1); // Rango que cubre todos los datos
$sheet->getStyle($range)->applyFromArray($styleArray);
$sheet->getStyle($range)->applyFromArray($alignmentStyle);

// Ajustar la altura de las filas y el ancho de las columnas
foreach (range('A','P') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);

foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
     
    
// Agregar imagen
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../img/logoartepan_sinfondo.png'); // Ruta a tu imagen
$drawing->setHeight(50); // Altura de la imagen
$drawing->setCoordinates('A1'); // Celda donde se ubicará la imagen
$drawing->setWorksheet($sheet);


$filename = "FACTURAS ARTEPAN ";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>