<?php
echo "<script>window.close();</script>";
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
$c = 0;

if($idcal){
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
                border: 1px solid #000;
                font-size: 10px;
                padding: 3px;
            }
            .div{
                width: 98%;
                display: flex;
                justify-content: space-between;
                padding-left: 1%;
            }
            .sep{
                border-collapse: collapse;
                border: 1.5px solid #000;
            }
            .tit{
                text-align: center;
            }
            .sub{
                font-size: 11.5px;
            }
            .enc{
                width: 10%;
            }
            .fond1{
                background-color: #B7DEE8;
            }
            .fond2{
                background-color: #DAEEF3;
            }
            .fond3{
                background-color: #92D050;
            }
            .fond4{
                background-color: #FABF8F;
            }
        </style>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <td class="tit td" style="width: 30%" rowspan="4"><img style="width: 80%;" src="'.$logob64.'" alt="Logo ARTEPAN SAS"></td>
                <td class="tit td" style="width: 50%; font-size: 15px;" rowspan="4"><strong>FORMATO EVALUACIÓN 360° '.mb_strtoupper($info['tfor'], 'UTF-8').'</strong></td>
                <td class="tit td" style="width: 20%">CÓDIGO: '.$info['codfor'].'</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">FECHA: '.date("d/m/Y", strtotime($info['fecfor'])).'</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">PÁGINA: 1</td>
            </tr>
            <tr>
                <td class="tit td" style="width: 20%">VERSIÓN: '.$info['verfor'].'</td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="td" style="width: 50%"><div class="div"><strong>Evaluado: </strong>'.$info['eva'].'</div></td>
                <td class="td" style="width: 30%"><div class="div"><strong>Cargo: </strong>'.$info['ceva'].'</div></td>
                <td class="td" style="width: 20%"><div class="div"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['feva'])).'</div></td>
            </tr>
            <tr>
                <td class="td" style="width: 50%"><div class="div"><strong>Par: </strong>'.$info['par'].'</div></td>
                <td class="td" style="width: 30%"><div class="div"><strong>Cargo: </strong>'.$info['cpar'].'</div></td>
                <td class="td" style="width: 20%"><div class="div"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fjeva'])).'</div></td>
            </tr>
            <tr>
                <td class="td" style="width: 50%"><div class="div"><strong>Jefe: </strong>'.$info['jef'].'</div></td>
                <td class="td" style="width: 30%"><div class="div"><strong>Cargo: </strong>'.$info['cjef'].'</div></td>
                <td class="td" style="width: 20%"><div class="div"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fpeva'])).'</div></td>
            </tr>';
        if($info['idevasub']){
        $html .= '    
            <tr>
                <td class="td" style="width: 40%"><div class="div"><strong>Subalterno: </strong>'.$info['sub'].'</div></td>
                <td class="td" style="width: 30%"><div class="div"><strong>Cargo: </strong>'.$info['csub'].'</div></td>
                <td class="td" style="width: 30%"><div class="div"><strong>Fecha: </strong>'.date("d/m/Y", strtotime($info['fseva'])).'</div></td>
            </tr>';
        }
    $html .= '        
        </tbody>
    </table>
    <span><br></span>
    <table>
        <thead>
            <tr>
                <th class="tit td fond1 sep" style="width: '.(($info['idevasub'])?'50':'60').'%; font-size: 15px;" rowspan="2">PREGUNTAS:</th>
                <th class="tit td fond1 sep sub enc">JEFE</th>
                <th class="tit td fond1 sep sub enc">PAR</th>
                <th class="tit td fond1 sep sub enc">AUTO</th>';
        if($info['idevasub']) $html .= '<th class="tit td fond1 sep sub enc">SUBALTERNO</th>';
    $html .= '
                <th class="tit td fond1 sep sub enc" rowspan="2">TOTAL</th>
            </tr>
            <tr>
                <th class="tit td fond1 sep sub enc">'.$info['porjef'].'%</th>
                <th class="tit td fond1 sep sub enc">'.$info['porpar'].'%</th>
                <th class="tit td fond1 sep sub enc">'.$info['poraut'].'%</th>';
        if($info['idevasub']) $html .= '<th class="tit td fond1 sep sub enc">'.$info['porsub'].'%</th>';
    $html .= '
            </tr>
        </thead>
        <tbody>';
		for($i=1; $i<=25; $i++){
    	    if($i==1) $c = 1;
            elseif($i==6) $c = 2;
    	    elseif($i==11) $c = 3;
    	    elseif($i==16) $c = 4;
    	    elseif($i==21) $c = 5;
    	    if($i==1 || $i==6 || $i==11 || $i==16 || $i==21){ 
				if($info['nomsec'.$c]){
					$html .= '<tr>';
                        $html .= '<td class="tit td sub fond2" colspan="'.(($info['idevasub'])?'6':'5').'"><strong>'.strtoupper($info['nomsec'.$c]).'</strong></td>';
					$html .= '</tr>';
                }
            }if($info['pre'.$i] && $info['rjef'.$i] && $info['rpar'.$i] && $info['raut'.$i]){
                $html .= '<tr>';
                    $html .= '<td class="td" width="'.(($info['idevasub'])?'50':'60').'%">'.$info['pre'.$i].'</td>';      
                    $html .= '<td class="td tit enc">'.$info['rjef'.$i].'</td>';
                    $html .= '<td class="td tit enc">'.$info['rpar'.$i].'</td>';
                    $html .= '<td class="td tit enc">'.$info['raut'.$i].'</td>';
                    if($info['rsub'.$i]) $html .= '<td class="td tit enc">'.$info['rsub'.$i].'</td>';
                    $html .= '<td class="td tit enc">'.nota($info, $i, "nota").'</td>';
                $html .= '</tr>';            
    	    }if($i==5 || $i==10 || $i==15 || $i==20 || $i==25){
                if($info['nomsec'.$c]){
    	        $html .= '<tr>';
                   $html .= '<td class="tit td sub fond3" colspan="'.(($info['idevasub'])?'5':'4').'"><strong>PROMEDIO</strong></td>';
                   $html .= '<td class="tit td sub fond3"><strong>'.nota($info, $i, "prom").'</strong></td>';
				$html .= '</tr>';
    		}}
        }
	$html .= '
        </tbody>
        <tfoot>
            <tr>
                <th class="tit td sub sep fond4" colspan="'.(($info['idevasub'])?'5':'4').'"><strong>TOTAL</strong></th>
                <th class="tit td sub sep fond4"><strong>'.$info['nota'].'</strong></th>
            </tr>
        </tfoot>
    </table>
    <span><br></span>
    <table>
        <thead>
            <tr>
                <th class="tit td sep" style="width: 50%;" colspan="2">CRITERIOS DE EVALUACIÓN</th>
            </tr>
            <tr>
                <th class="tit td sep" style="width: 40%;">MAS ALLÁ DEL DEBER</th>
                <th class="tit td sep" style="width: 60%;">100% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 4.5</th>
            </tr>
            <tr>
                <th class="tit td sep" style="width: 40%;">EXCELENCIA</th>
                <th class="tit td sep" style="width: 60%;">90% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 4.0</th>
            </tr>
            <tr>
                <th class="tit td sep" style="width: 40%;">CAMINO A LA EXCELENCIA</th>
                <th class="tit td sep" style="width: 60%;">80% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 3.5</th>
            </tr>
            <tr>
                <th class="tit td sep" style="width: 40%;">COMPETENTE</th>
                <th class="tit td sep" style="width: 60%;">70% DE LA BONIFICACIÓN RESULTADO TOTAL SUPERIOR A 3.0</th>
            </tr>
            <tr>
                <th class="tit td sep" style="width: 40%;">EN PROGRESO</th>
                <th class="tit td sep" style="width: 60%;">0% DE LA BONIFICACIÓN RESULTADO TOTAL INFERIOR A 3.0</th>
            </tr>
        </thead>
    </table>
    </body>
    </html>';

    //-------PDF--------

    $fold = 'arc/'.$info['apeper'].' '.$info['nomper'].'_'.$info['ndper'].'/Evaluaciones/';
    $name = $info['ceva']." ".$info['tfor']."_".date("d-m-Y", strtotime($info['feccal'])).".pdf";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();
    
    //-------Crea la carpeta si no existe y lo guarda en la carpeta y en la bd--------
    if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    $file_path = '../'.$fold.$name;
    $meva->setRutpdf($fold.$name);
    $meva->savePdf();
    file_put_contents($file_path, $dompdf->output());
}

function nota($info, $i, $ope) {
    $tipos = ['jef', 'aut', 'par', 'sub'];
    $pesos = [
        'jef' => ($info['porjef'])?floatval($info['porjef'])/100:0,
        'aut' => ($info['poraut'])?floatval($info['poraut'])/100:0,
        'par' => ($info['porpar'])?floatval($info['porpar'])/100:0,
        'sub' => ($info['porsub'])?floatval($info['porsub'])/100:0,
    ];

    if($ope=="nota"){
        $sum = 0;
        foreach ($tipos as $tipo) {
            $campo = "r{$tipo}{$i}";
            if ($info[$campo] && $info[$campo]!=='') $sum += floatval($info[$campo]) * $pesos[$tipo];
        }
        return round($sum, 2);

    }elseif($ope=="prom"){ 
        $parcial = [];
        for ($j=$i-4; $j<=$i; $j++){
            $sum = 0;
            $respondio = false;
            foreach ($tipos as $tipo) {
                $campo = "r{$tipo}{$j}";
                if ($info[$campo] && $info[$campo]!==''){
                    $sum += floatval($info[$campo]) * $pesos[$tipo];
                    $respondio = true;
            }}
            if($respondio) $parcial[] = $sum;
        }
        $prom = count($parcial) > 0 ? array_sum($parcial) / count($parcial) : 0;
        return round($prom, 2);
    }
}


?>