<?php
// echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/meva.php');
include("../models/datos.php");

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use Dompdf\Dompdf;

$dompdf = new Dompdf();

 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');
$hoy = date("Y-m-d");
$sptrut = NULL;

$meva = new Meva();


$idcal = isset($_REQUEST['idcal']) ? $_REQUEST['idcal']:NULL;

$logo = "../img/logoartepan_sinfondo.png";
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

$meva->setIdcal($idcal);
$data = $meva->getAll("one");
$info = $data[0];


// if($idcal){
    $html = '';
    $html .= '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ARTEPAN SAS</title>
        <link rel="icon" href="../img/logoartepan_sinfondo.png">
        <style>
            table{
                width: 100%;
            }
            table, .td{
                border-collapse: collapse;
                border-top: 1px solid #000;
                border-left: 1px solid #000;
                border-right: 1px solid #000;
                padding: 1px 3px;
                font-size: 12px;
                padding: 5px;
            }
            .fin{
                border-bottom: 1px solid #000;
            }
            .tit{
                text-align: center;
            }
            .fond1{
                background-color: #B7DEE8;
            }
            .fond2{
                background-color: #DAEEF3;
            }
        </style>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <td class="tit td" style="width: 30%" rowspan="4"><img style="width: 80%;" src="'.$logob64.'" alt="Logo ARTEPAN SAS"></td>
                <td class="tit td" style="width: 50%; font-size: 20px;" rowspan="4"><strong>FORMATO EVALUACIÓN 360° '.mb_strtoupper($info['tfor'], 'UTF-8').'</strong></td>
                <td class="tit td" style="width: 20%">CÓDIGO: '.$info['codfor'].'</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">FECHA: '.date("d/m/Y", strtotime($info['feccal'])).'</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">PÁGINA: 1</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">VERSIÓN: '.$info['verfor'].'</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td class="td" style="width: 50%"><strong>Evaluado: </strong>'.$info['eva'].'</td>
                <td class="td" style="width: 30%"><strong>Cargo: </strong></td>
                <td class="td" style="width: 20%"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['feva'])).'</td>
            </tr>
            <tr>
                <td class="td" style="width: 50%"><strong>Par: </strong>'.$info['jef'].'</td>
                <td class="td" style="width: 30%"><strong>Cargo: </strong></td>
                <td class="td" style="width: 20%"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fjeva'])).'</td>
            </tr>
            <tr>
                <td class="td" style="width: 50%"><strong>Jefe: </strong>'.$info['par'].'</td>
                <td class="td" style="width: 30%"><strong>Cargo: </strong></td>
                <td class="td" style="width: 20%"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fpeva'])).'</td>
            </tr>';
        if($info['idevasub']){
        $html .= '    
            <tr>
                <td class="td" style="width: 40%"><strong>Subalterno: </strong>'.$info['sub'].'</td>
                <td class="td" style="width: 30%"><strong>Cargo: </strong></td>
                <td class="td" style="width: 30%"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fseva'])).'</td>
            </tr>';
        }
    $html .= '        
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th class="tit td fond1" style="width: '.(($info['idevasub'])?'50':'60').'%; font-size: 20px;" rowspan="2">PREGUNTAS:</th>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">JEFE</th>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">PAR</th>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">AUTO</th>';
        if($info['idevasub']){
            $html .= '  
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">SUBALTERNO</th>';
        }
    $html .= '
                <th class="tit td fond1" style="width: 10%; font-size: 15px;" rowspan="2">TOTAL</th>
            </tr>
            <tr>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">'.$info['porjef'].'%</th>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">'.$info['porpar'].'%</th>
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">'.$info['poraut'].'%</th>';
        if($info['idevasub']){
            $html .= '  
                <th class="tit td fond1" style="width: 10%; font-size: 15px;">'.$info['porsub'].'%</th>';
        }
    $html .= '
            </tr>
        </thead>

    </table>
    <span><br></span>
    <table>
        <thead>
            <tr>
                <th class="tit td" style="width: 50%;" colspan="2">CRITERIOS DE EVALUACIÓN</th>
            </tr>
            <tr>
                <th class="tit td" style="width: 40%;">MAS ALLÁ DEL DEBER</th>
                <th class="tit td" style="width: 60%;">100% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 4.5</th>
            </tr>
            <tr>
                <th class="tit td" style="width: 40%;">EXELENCIA</th>
                <th class="tit td" style="width: 60%;">90% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 4.0</th>
            </tr>
            <tr>
                <th class="tit td" style="width: 40%;">CAMINO A LA EXCELENCIA</th>
                <th class="tit td" style="width: 60%;">80% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 3.5</th>
            </tr>
            <tr>
                <th class="tit td" style="width: 40%;">COMPETENTE</th>
                <th class="tit td" style="width: 60%;">70% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 3.0</th>
            </tr>
            <tr class="fin">
                <th class="tit td" style="width: 40%;">EN PROGRESO</th>
                <th class="tit td" style="width: 60%;">0% DE LA BONIFICACIÓN RESULTADO TOTAL INFERIOR A 3.0</th>
            </tr>
        </thead>
    </table>
    
    </body>
    </html>';

    echo $html;
    echo "<script type='text/javascript'>window.print();</script>";
    //-------PDF--------

    // $fold = 'arc/permisos/'.$det['aper'].' '.$det['nper'].'_'.$det['dper'].'/';
    // $name = $det['tprm']."_".date("Y-m-d", strtotime($det['fecini'])).".pdf";

    // $dompdf->loadHtml($html);
    // $dompdf->setPaper('Letter', 'portrait');
    // $dompdf->render();
    
    // //-------Crea la carpeta si no existe y lo guarda en la carpeta y en la bd--------
    // if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    // $file_path = '../'.$fold.$name;
    // $mdot->setRutpdf($fold.$name);
    // $mdot->savePdf();
    // file_put_contents($file_path, $dompdf->output());
// }


?>