<?php
// echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mdot.php');
require_once ('../controllers/sendemail.php');
include("../models/datos.php");

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');

$mdot = new Mdot();

$ident = isset($_REQUEST['ident']) ? $_REQUEST['ident']:NULL;


$logo = "../img/logoartepan_sinfondo.png";
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

if($ident){
    $mdot->setIdent($ident);
    $datDet = $mdot->getOne();
    $det = $datDet[0];
        $datDot = $mdot->getAllDom(3);
        $datTalS = $mdot->getAllDom(4); 
        $datTalP = $mdot->getAllDom(5); 
        $datTalZ = $mdot->getAllDom(6);
        $datTalG = $mdot->getAllDom(7);
        $datCol = $mdot->getAllDom(8);
        $datDia = $mdot->getAllDom(9);
     

    $datCxC = $mdot->getAllCxc($datDet[0]["ident"]);
    $datTxD = $mdot->getAllTxD($datDet[0]["ident"]);
}


if($det['firpent']){
    $fent = "../".$det['firpent'];
    $fentb64 = "data:image/png;base64,".base64_encode(file_get_contents($fent));
}if($det['firprec']){
    $fdev = "../".$det['firprec'];
    $fdevb64 = "data:image/png;base64,".base64_encode(file_get_contents($fdev));
}

$intentos = 5;
$c = 0;
$cont = 0;
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
            padding: 1px 3px;
            font-size: 12px;
        }
        .datper{
            padding: 8px;
        }
        .tit{
            text-align: center;
        }
        .fond1{
            background-color: #a5cdfa;
        }
        .bloc{
            text-align: center;
            margin-top: 50px;
        }
        .dot{
            width: 40%;
            display: inline-block;
            margin: 0 35px;
        }
    </style>
</head>
<body>
<table>
    <tbody>
        <tr>
            <td class="td fond1" style="width: 100px" colspan="4" rowspan="4"><img style="width: 80%;" src="'.$logob64.'" alt="Logo ARTEPAN SAS"></td>
            <td class="td datper fond1" colspan="6" rowspan="4" style="text-align: center;"><strong>FORMATO ENTREGA DE ELEMENTOS DE PROTECCIÓN PERSONAL Y DOTACIÓN DE TRABAJO</strong></td>
            <td class="td fond1" colspan="4"><strong>Código: THM-FOR09</strong></td>
        </tr>
        <tr>
            <td class="td fond1" colspan="4"><strong>Versión: 1</strong></td>
        </tr>
        <tr>
            <td class="td fond1" colspan="4"><strong>Fecha: 26/01/2023</strong></td>
        </tr>
        <tr>
            <td class="td fond1" colspan="4"><strong>Página: 1 de 1</strong></td>
        </tr>
    </tbody>
</table>
<span><br></span>
<table>
    <tbody>
        <tr>
            <td class="td tit datper fond1" colspan="2"><strong>DATOS DEL FUNCIONARIO</strong></td>
        </tr>
        <tr>
            <td class="td datper" style="width: 30%"><strong>NOMBRE:</strong></td>
            <td class="td datper" style="width: 70%">'.$det['nomprec'].'</td>
        </tr>
        <tr>
            <td class="td datper" style="width: 30%"><strong>CEDULA:</strong></td>
            <td class="td datper" style="width: 70%">'.$det['dprec'].'</td>
        </tr>
        <tr>
            <td class="td datper" style="width: 30%"><strong>AREA:</strong></td>
            <td class="td datper" style="width: 70%">'.$det['aprec'].'</td>
        </tr>
        <tr>
            <td class="td datper" style="width: 30%"><strong>CORREO CORPORATIVO:</strong></td>
            <td class="td datper" style="width: 70%">';
                if($det['eprec']) $html .= $det['eprec'];
                else $html .= 'N/A';
 $html .= '
        </td>
        </tr>
    </tbody>
</table>

<div class="bloc">
    <div class="dot">
        <table>
            <tbody>
                <tr>  
                    <td class="td tit datper fond1" colspan="2" style="width: 100%"><strong>HORARIO DE CAMISA</strong></td>
                </tr>';
                if ($datDia && $datCol){ foreach ($datDia AS $dda) {
                    $marcadorEncontrado = false;
                    $html .= '<tr><td class="td datper" text-align: center;"><strong>' . strtoupper($dda['nomval']) . '</strong></td>';
                    foreach ($datCol AS $dtc){ if ($datCxC){ 
                        foreach ($datCxC as $dcc){ if ($dtc['idval'] == $dcc['idvcol'] && $dda['idval'] == $dcc['idvdia']) {
                            $html .= '<td class="td datper" style="text-align: center;"><strong>' . strtoupper($dtc['nomval']) . '</strong></td>';
                            $marcadorEncontrado = true;
                            break;
                        }}
                    }}
                    if ($marcadorEncontrado==false) $html .= '<td class="td"></td>';
                    $html .= '</tr>';

                }}
$html .= '
            </tbody>
        </table>
    </div>
    <div class="dot" style="padding-bottom: 30px;">
        <table>
            <tbody>
                <tr>
                    <td class="td tit datper fond1" colspan="4"><strong>ELEMENTO - TALLA - CANTIDAD</strong></td>  
                </tr>';
                if ($datDot){ foreach ($datDot as $ddt) {
                    $marcadorEncontrado = false;
                    $html .= '<tr><td class="td datper" style="width: 25%; text-align: center;"><strong>' . strtoupper($ddt['nomval']) . '</strong></td>';
                    if ($datTxD){ foreach ($datTxD as $dae) {
                        if ($ddt['idval'] == $dae['idvdot']) {
                            $html .= '<td class="td datper" style="text-align: center">X</td>';
                            $html .= '<td class="td datper"  style="text-align: center;"><strong>' . strtoupper($dae['nomvtal']) . '</strong></td>'; 
                            $html .= '<td class="td datper" style="text-align: center;"><strong>' . strtoupper($dae['cant']) . '</strong></td>'; 
                            $marcadorEncontrado = true;
                            break;
                        } 
                    }}
                    if ($marcadorEncontrado==false) $html .= '<td class="td"></td><td class="td"></td><td class="td"></td>';
                    $html .= '</tr>';
                }}     
$html .= '
            </tbody>
        </table>
    </div>
</div>
<table>
    <tbody>       
        <tr>
            <td class="td tit datper fond1" colspan="4"><strong>FECHA ENTREGA:</strong></td>
            <td class="td datper" colspan="2">'.$det['fecent'].'</td>
        </tr>
        <tr>
            <td class="td datper"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td class="td datper">'.$det['nompent'].'</td>
            <td class="td datper"><strong>AREA:</strong></td>
            <td class="td datper">'.$det['apent'].'</td>
            <td class="td datper"><strong>FIRMA:</strong></td>
            <td class="td datper">'.(function($name) { return explode(" ", $name)[0]; })($_SESSION["nomper"]) . " " . (function($surname) { return explode(" ", $surname)[0]; })($_SESSION["apeper"]).'</td>
        </tr>
        <tr>
            <td class="td datper"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td class="td datper">'.$det['nomprec'].'</td>
            <td class="td datper"><strong>AREA:</strong></td>
            <td class="td datper">'.$det['aprec'].'</td>
            <td class="td datper"><strong>FIRMA:</strong></td>
            <td class="td datper">';
            if ($det['firpent']) $html .= '<img style="height: 30px;" src="'.$fentb64.'">';
$html .= '
            </td>
        </tr>
        <tr>
            <td class="td datper"><strong>OBSERVACIONES:</strong></td>
            <td class="td datper" colspan="5">'.$det['observ'].'</td>
        </tr>       
    </tbody>
</table>
<span><br></span>
<table>
    <tbody>      
        <tr>
            <td class="td tit datper fond1" colspan="4"><strong>FECHA DEVOLUCION:</strong></td>
            <td class="td datper" colspan="2">'.$det['fecdev'].'</td>
        </tr>
        <tr>
            <td class="td datper"><strong>NOMBRE DE QUIEN ENTREGA:</strong></td>
            <td class="td datper">'.$det['nompentd'].'</td>
            <td class="td datper"><strong>AREA:</strong></td>
            <td class="td datper">'.$det['apentd'].'</td>
            <td class="td datper"><strong>FIRMA:</strong></td>
            <td class="td datper">';
            if ($det['firprec']) $html .= '<img style="height: 30px;" src="'.$fdevb64.'">';
$html .= '
            </td>
        </tr>
        <tr>
            <td class="td datper"><strong>NOMBRE DE QUIEN RECIBE:</strong></td>
            <td class="td datper">'.$det['nomprecd'].'</td>
            <td class="td datper"><strong>AREA:</strong></td>
            <td class="td datper">'.$det['aprecd'].'</td>
            <td class="td datper"><strong>FIRMA:</strong></td>
            <td class="td datper">';
            if ($det['firprec']) $html .= (function($name) { return explode(" ", $name)[0]; })($_SESSION["nomper"]) . " " . (function($surname) { return explode(" ", $surname)[0]; })($_SESSION["apeper"]);
$html .= '
            </td>
        </tr>
        <tr>
            <td class="td datper"><strong>OBSERVACIONES:</strong></td>
            <td class="td datper" colspan="5">'.$det['observd'].'</td>
        </tr>    
    </tbody>
</table>
</body>
</html>';


if($ident){
    //-------PDF--------
    
    //-------Prueba--------
    echo $html;
    echo "<script type='text/javascript'>window.print();</script>";

    //-------Generarlo--------
    //-------Nombre y destino del pdf--------
    $fold = 'arc/pdf/'.$det['nomprec'].'_'.$det['dprec'].'/';
    $name = $det['aprec']."_".$det['nomprec'].".pdf";

    // //-------Carga informacion y lo crea--------
    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();

    // //-------Crea la carpeta si no existe y lo guarda en la carpeta y en la bd--------
    if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    $file_path = '../'.$fold.$name;
    $mdot->setRutpdf($fold.$name);
    $mdot->savePdf();
    file_put_contents($file_path, $dompdf->output());

    // //-------EMAIL--------

    // //-------Datos destinatario--------
    if($det['fecent'] && !$det['fecdev']){
        $perd = $det['nomprec'];
        $maild = $det['eprec'];
    }elseif($det['fecent'] && $det['fecdev']){
        $perd = $det['nomprec']; 
        $maild = $det['epentd'];
    }
    $partes = explode(" ", $perd);
    $aped = ucfirst(strtolower($partes[0]));
    $nomd = ucfirst(strtolower($partes[count($partes) > 2 ? 2 : 1]));
    $nomperd = $nomd." ".$aped;
    
    // //-------Datos remitente--------
    if($det['fecent'] && !$det['fecdev']){
        $perm = $det['nompent'];
        $mail = $det['epent'];
        $area = $det['apent'];
    }elseif($det['fecent'] && $det['fecdev']){
        $perm = $det['nompent']; 
        $mail = $det['eprecd'];
        $area = $det['aprecd'];
    }
    // //-------Le da un formato a los nombres--------
    $partesm = explode(" ", $perm);
    $ape1 = ucfirst(strtolower($partesm[0]));
    $ini_ape2 = isset($partesm[1]) ? ucfirst($partesm[1][0]) . '.' : '';
    $nom1 = isset($partesm[2]) ? ucfirst(strtolower($partesm[2])) : '';
    $ini_nom2 = isset($partesm[3]) ? ucfirst($partesm[3][0]) . '.' : '';
    $nomperm = trim("$nom1 $ini_nom2 $ape1 $ini_ape2");
    $a = ucfirst(strtolower($area));

    // //-------Contenido del correo--------
    $template="../views/mail.html"; //Plantilla
    $txt_mess = "";
    $txt_mess = "Adjunto a este correo se encuentra el acta de ";
    if($det['fecent'] && !$det['fecdev']) $txt_mess .= "entrega";
    elseif($det['fecent'] && $det['fecdev']) $txt_mess .= "devolución"; 
    $txt_mess .= " firmada de la dotación asignada.<br><br>
    Le solicitamos revisar el documento adjunto y conservar una copia para sus registros. Si tiene alguna pregunta o necesita asistencia adicional, no dude en ponerse en contacto con nuestra area de Talento Humano.<br><br>
    Agradecemos su colaboración y compromiso con el correcto uso de la dotación.<br><br>
    Atentamente,<br><br>";
	$mail_asun = "Confirmación ";
    if($det['fecent'] && !$det['fecdev']) $mail_asun .= "Entrega";
    elseif($det['fecent'] && $det['fecdev']) $mail_asun .= "Devolución"; 
    $mail_asun .= " de Dotación";
    $fir_mail = '<strong>'.$nomperm.'</strong><br>'.$a.' | '.$mail.'<br>'.$direccion.'<br>'.$ubicacion.'<br>'.$web;

    //-------Llama la función que crea y envía el correo--------
    $exito = sendemail($ema, $psem, $nom, $maild, $nomperd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
    while ($exito==2 && $c<$intentos){
        $exito = sendemail($ema, $psem, $nom, $maild, $nomperd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
        sleep(5);
        $c++;
    }
}

?>