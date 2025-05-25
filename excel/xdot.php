<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mdot.php');

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

$mdot = new Mdot();

$datAllD = $mdot->getAllD();

$datDot = $mdot->getAllDom(7);

$sheet = $spreadsheet->getActiveSheet();

// Agregar titulo hoja
$sheet->setTitle('DOTACIONES');


// Agregar titulo
$sheet->setCellValue('A1', 'BASE DE DATOS');
$sheet->mergeCells('A1:AE1');
$style = $sheet->getStyle('A1');
$style->getFont()->setBold(true)->setSize(30);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B8CCE4');

// Agregar encabezados
$sheet->setCellValue('A2', 'DATOS DEL TRABAJADOR');
$sheet->mergeCells('A2:D2');
$sheet->setCellValue('E2', 'DATOS DE LA DOTACIÓN');
$sheet->mergeCells('E2:S2');
$sheet->setCellValue('T2', 'ENTREGA');
$sheet->mergeCells('T2:Y2');
$sheet->setCellValue('Z2', 'DEVOLUCIÓN');
$sheet->mergeCells('Z2:AE2');
$style = $sheet->getStyle('A2:AE2');
$style->getFont()->setBold(true)->setSize(18);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B7DEE8');

// Agregar titulos

$titulo = [ 'CEDULA' ,'NOMBRE', 'AREA', 'CORREO', 'PANTALON', 'TALLA', 'CANTIDAD', 'CAMISA', 'TALLA', 'CANTIDAD', 'CHAQUETA', 'TALLA', 'CANTIDAD', 'BOTAS', 'TALLA','CANTIDAD', 'GUANTES', 'TALLA','CANTIDAD', 'FECHA ENTREGA', 'NOMBRE ENTREGA', 'AREA', 'NOMBRE RECIBE', 'AREA', 'OBSERVACIONES', 'FECHA DEVOLCIÓN', 'NOMBRE ENTREGA', 'AREA', 'NOMBRE RECIBE', 'AREA', 'OBSERVACIONES'];


$sheet->fromArray([$titulo], NULL, 'A3');
$style = $sheet->getStyle('A3:AE3');
$style->getFont()->setBold(true);

//información
$datos = [];

if ($datAllD) {
    foreach ($datAllD as $dat) {
        $filaDatos = [$dat['dprec'], $dat['nomprec'], $dat['aprec'], $dat['eprec']];

        // Agregar marcadores 'X' según la condición
        $datTxD = $mdot->getAllTxD($dat['ident']);
        if ($dat) {
            foreach ($datDot as $dac) {
                $marcadorEncontrado = false;
                if ($datDot) {    
                    foreach ($datTxD as $dae) {
                        if ($dac['idval'] == $dae['idvdot']) {
                            $marcadorEncontrado = true;
                            //array = unir el array(array con [.....])
                            $filaDatos = array_merge($filaDatos, ['X', $dae['nomvtal'], $dae['cant']]);
                            break; // Terminar el bucle interno si se encuentra el marcador
                        }
                    }
                } 

                if (!$marcadorEncontrado) $filaDatos = array_merge($filaDatos, ['', '', '']);
            }
        }


        // Agregar datos finales
        $filaDatos = array_merge($filaDatos, [ $dat['fecent'], $dat['nompent'], $dat['apent'], $dat['nomprec'], $dat['aprec'], $dat['observ'], $dat['fecdev'], $dat['nompentd'], $dat['apentd'], $dat['nomprecd'], $dat['aprecd'], $dat['observd'],
        ]);

        // Agregar la fila completa al array $datos
         $datos[] = $filaDatos;
    }
}
    
// Agregar datos dinámicos
$fila = 4; // Comienza en la fila 3 porque la fila 1 y 2 tiene encabezados
foreach ($datos as $dato) {
    $sheet->fromArray($dato, NULL, 'A' . $fila);
    $sheet->getStyle('D'.$fila.':Z'.$fila)->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER);
    $fila++;
}

// Definir estilo de borde
$styleArray = [
    'borders' => [
        'allBorders' => [
 0<           'borderStyle' => Border::BORDER_THIN,
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
$range = 'A1:AE'.($fila - 1); // Rango que cubre todos los datos
$sheet->getStyle($range)->applyFromArray($styleArray);
$sheet->getStyle($range)->applyFromArray($alignmentStyle);

// Ajustar la altura de las filas y el ancho de las columnas
foreach (range('A','Z') as $columnID) $sheet->getColumnDimension($columnID)->setAutoSize(true);
foreach (range('A','E') as $columnID) $sheet->getColumnDimension('A'.$columnID)->setAutoSize(true);

foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
     
    
// Agregar imagen
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../img/logoartepan_sinfondo.png'); // Ruta a tu imagen
$drawing->setHeight(50); // Altura de la imagen
$drawing->setCoordinates('A1'); // Celda donde se ubicará la imagen
$drawing->setWorksheet($sheet);


$filename = "DOTACIONES ARTEPAN ";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>