<?php
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
ob_start();
require_once ('../models/malm.php');
ob_end_clean();
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

$malm = new Malm();

$datfec = $malm->totalfec();
$datper = $malm->totalper();


$sheet = $spreadsheet->getActiveSheet();

// Agregar titulo hoja
$sheet->setTitle('ALMUERZOS');

// Agregar encabezados dinámicos
// Obtener fechas únicas para los encabezados dinámicos
$fechas = [];
if (!empty($datfec)) {
    foreach ($datfec as $dalm) {
        if (!in_array($dalm['fecalm'], $fechas)) {
            $fechas[] = $dalm['fecalm']; // Agregar fechas únicas
        }
    }
}

// Crear encabezados dinámicos
$titulo = ['CEDULA', 'NOMBRE', 'TOTAL ALM X PER']; // Encabezados fijos iniciales
if (!empty($fechas)) {
    $titulo = array_merge($titulo, $fechas); // Combinar con las fechas dinámicas
} else {
    // Si no hay fechas, mantén solo los encabezados básicos
    $titulo = ['CEDULA', 'NOMBRE', 'TOTAL ALM X PER'];
}

// Agregar título principal
$sheet->setCellValue('A1', 'BASE DE DATOS');
$lastCol = chr(64 + count($titulo)); // Determinar la última columna basada en el número de encabezados
$sheet->mergeCells("A1:{$lastCol}1"); // Combinar desde A1 hasta la última columna
$style = $sheet->getStyle("A1:{$lastCol}1");
$style->getFont()->setBold(true)->setSize(30);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B8CCE4');

// Agregar subtítulos dinámicos
$sheet->setCellValue('A2', 'DATOS DEL TRABAJADOR');
$sheet->mergeCells('A2:B2'); // Encabezado estático para las dos primeras columnas
$sheet->setCellValue('C2', 'DATOS DE QUINCENA');
$sheet->mergeCells("C2:{$lastCol}2"); // Combinar desde C2 hasta la última columna

// Aplicar estilos a los subtítulos
$style = $sheet->getStyle("A2:{$lastCol}2");
$style->getFont()->setBold(true)->setSize(18);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B7DEE8');
$style->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

// Aplicar encabezados a la fila 3
$sheet->fromArray([$titulo], NULL, 'A3');

// Aplicar estilo a los encabezados
$lastCol = chr(64 + count($titulo)); // Determina la última columna dinámica 
$headerRange = 'A3:' . $lastCol . '3';
$style = $sheet->getStyle($headerRange);
$style->getFont()->setBold(true);
$style->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('B7DEE8');
$style->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// Ajustar el ancho de columnas automáticamente
foreach (range(1, count($titulo)) as $colIndex) {
    $colLetter = chr(64 + $colIndex); // Convertir índice a letra de columna
    $sheet->getColumnDimension($colLetter)->setAutoSize(true);
}

//información
$datos = [];

if ($datper) {
    foreach ($datper as $dper) {
        $filaDatos = [$dper['ndper'], $dper['nomper'], " "];
        $datval = $malm->getAll($vfac);
        $datPxF = $malm->getAllPxF($dper['idper']);  
        if (!empty($datfec)) {    
            foreach ($datfec as $dalm) {
                $marcadorEncontrado = false;
                if (!empty($datPxF)) {
                    foreach ($datPxF as $dae) {
                        $f1 = date('Y-m-d', strtotime($dalm['fecalm']));
                        $f2 = date('Y-m-d', strtotime($dae['fecped']));
                        if ($f1 === $f2) {
                            $marcadorEncontrado = true;
                            $filaDatos[] = $dae['canalm'];
                            if(!empty($datval)){
                                foreach ($datval as $dval) {
                                    
                                    $filaDatos[] = $dval['vfac'];
                                }}
                            break;
                        }
                    }
                }
                if (!$marcadorEncontrado) {
                    $filaDatos[] = ' ';
                }
                // if (!empty($datfec)) {    
                //     foreach ($datfec as $dalm) {
                //         $marcadorEncontrado = false;
                //     if(!empty($datval)){
                //         foreach ($datval as $dval) {
                //             $marcadorEncontrado = true;
                //             $filaDatos[] = $dval['vfac'];
                //     }
                // }
        //     }
        // }
            
            }
        }
        // Agregar la fila al array final
        $datos[] = $filaDatos;
    }
}

$startRow = 4;
$reg = count($datper); 
$endRow = $startRow + $reg - 1; 

// Determinar el rango dinámico de columnas
$startCol = 'D'; // La primera columna que contiene valores numéricos a sumar
$endCol = $lastCol; // Última columna dinámica según los encabezados

// Calcular la suma dinámica de cada fila
foreach (range($startRow, $endRow) as $row) {
    $range = "$startCol$row:$lastCol$row"; // Crear rango desde D hasta la última columna en la fila actual
    $sheet->setCellValue("C$row", "=SUM($range)"); // Colocar fórmula de suma en la columna C
}

// Calcular el total de la columna C
$totalRow = $endRow + 1; // Fila donde irá el total
$sheet->setCellValue("C$totalRow", "=SUM(C$startRow:C$endRow)"); // Suma de toda la columna C
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

// Determinar la última columna dinámica
$lastCol = chr(64 + count($titulo)); // Convierte el índice de la última columna en letra 

// Aplicar estilo de borde y alineación a todo el rango de datos
$range = 'A1:' . $lastCol . ($fila - 1); // Desde A1 hasta la última columna y fila de datos
$sheet->getStyle($range)->applyFromArray($styleArray);
$sheet->getStyle($range)->applyFromArray($alignmentStyle);

// Ajustar la altura de las filas y el ancho de las columnas
foreach (range(1, count($titulo)) as $colIndex) {
    $columnID = chr(64 + $colIndex); // Determina la letra de la columna
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

foreach (range(1, $fila - 1) as $rowID) $sheet->getRowDimension($rowID)->setRowHeight(-1);
// Agregar imagen
$drawing = new Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../img/logoartepan_sinfondo.png'); // Ruta a tu imagen
$drawing->setHeight(50); // Altura de la imagen
$drawing->setCoordinates('A1'); // Celda donde se ubicará la imagen
$drawing->setWorksheet($sheet);


$filename = "RELACIÓN ALMUERZOS ";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header("Content-Disposition: attachment; filename=".$filename.$nmfl.".xlsx");
header('Cache-Control: max-age=0');

// Crear el archivo Excel y enviarlo al navegador
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;

?>