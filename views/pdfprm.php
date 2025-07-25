<?php
echo "<script>window.close();</script>";
require_once ("../models/seguridad.php");
require_once ('../models/conexion.php');
require_once ('../models/mprm.php');
require_once ('../controllers/sendemail.php');
include("../models/datos.php");

require ('../vendor/autoload.php');

ini_set('memory_limit', '4096M');

use Dompdf\Dompdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

$dompdf = new Dompdf();
$fpdi = new Fpdi();

 
date_default_timezone_set('America/Bogota');
$nmfl = date('d-m-Y H-i-s');
$hoy = date("Y-m-d");
$sptrut = NULL;

$mprm = new Mprm();


$idprm = isset($_REQUEST['idprm']) ? $_REQUEST['idprm']:NULL;
$estprm = isset($_REQUEST['estprm']) ? $_REQUEST['estprm']:NULL;
$obsprm = isset($_POST['obsprm']) ? $_POST['obsprm']:NULL;
$idrev = isset($_REQUEST['idrev']) ? $_REQUEST['idrev']:NULL;
$numprm = array_reverse($mprm->getAll("prop"));

if ($numprm){
    foreach($numprm AS $np){
        if($np['noprm']){
            $noprm = ($np['noprm']) + 1;
            break;
        }else $noprm = 1; 
}}else $noprm = 1;

$logo = "../img/logoartepan_sinfondo.png";
$logob64 = "data:image/png;base64,".base64_encode(file_get_contents($logo));

$mprm->setIdprm($idprm);
$comest = $mprm->getOne();

$intentos = 5;

if($idprm && ($comest[0]['estprm']!=3 || $comest[0]['estprm']!=4)){
    $mprm->setNoprm($noprm);
    $mprm->setEstprm($estprm);
    $mprm->setObsprm($obsprm);
    $mprm->setFecsol($hoy);
    $mprm->setIdrev($idrev);
    $mprm->setFecrev($hoy);
    $mprm->editAct();
    $datDet = $mprm->getOne();
    $det = $datDet[0];
    $datTprm = $mprm->getAllDom(1);

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
                background-color: #A6C9EC;
            }
            .fond2{
                background-color: #DAE9F8;
            }
        </style>
    </head>
    <body>
    <table>
        <tbody>
            <tr>
                <td class="tit td" style="width: 100px" colspan="2" rowspan="3"><img style="width: 80%;" src="'.$logob64.'" alt="Logo ARTEPAN SAS"></td>
                <td class="tit td" colspan="2" rowspan="4"><strong>FORMATO CONTROL DE PERMISOS</strong></td>
                <td class="td" colspan="1"><strong>Código: THM-FOR04</strong></td>
            </tr>
            <tr>
                <td class="td" colspan="1"><strong>Fecha: 26/01/2023</strong></td>
            </tr>
            <tr>
                <td class="td" colspan="1"><strong>Versión: 1</strong></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="datper" style="width: 40%">FECHA SOLICITUD : '.strtoupper($det['fsol']).'</td>
                <td class="datper" style="width: 60%">AREA : '.$det['cper'].'</td>
            </tr>
            <tr>
                <td class="datper" style="width: 60%">NOMBRE SOLICITANTE : '.$det['nper'].' '.$det['aper'].'</td>
                <td class="datper" style="width: 40%">NÚMERO DE CÉDULA : '.$det['dper'].'</td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <thead>
            <th class="tit datper fond1" colspan="5" style="width: 100%"><strong>FECHA DEL PERMISO</strong></th>
        </thead>
        <tbody>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>DESDE : </strong></td>
                <td class="datper" style="width: 21%">HORA : '.date("H:i", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 21%">DÍA : '.date("d", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 21%">MES : '.date("m", strtotime($det['fecini'])).'</td>
                <td class="datper" style="width: 22%">AÑO : '.date("Y", strtotime($det['fecini'])).'</td>
            </tr>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>HASTA : </strong></td>
                <td class="datper" style="width: 21%">HORA : '.date("H:i", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 21%">DÍA : '.date("d", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 21%">MES : '.date("m", strtotime($det['fecfin'])).'</td>
                <td class="datper" style="width: 22%">AÑO : '.date("Y", strtotime($det['fecfin'])).'</td>
            </tr>
            <tr style="border: 1px solid #000">
                <td class="td datper fond2" style="width: 15%"><strong>TOTAL : </strong></td>
                <td class="datper" style="width: 21%">DÍAS : '.$det['ddif'].'</td>
                <td class="datper" style="width: 21%">HORAS : '.$det['hdif'].'</td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <thead>
            <th class="tit datper fond1" colspan="4" style="width: 100%"><strong>TIPO DE PERMISO</strong></th>
        </thead>
        <tbody>
            <tr>';
            if($datTprm){ foreach($datTprm AS $i=>$dtp){
            $html .= '<td class="td datper" style="width: 45%">'.strtoupper($dtp['nomval']).'</td>
                <td class="td datper fond2 tit" style="width: 5%">'.(($dtp['idval']==$det['idvtprm']) ? 'X' : '').'</td>';
                if($i%2==1 && $dtp['idval']!=8) $html .= '</tr><tr>';
            }}
    $html .= '
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="td datper">DESCRIPCIÓN DEL PERMISO :<br><br>'.$det['desprm'].'</td>
            </tr>
            <tr>
                <td class="td datper">OBSERVACIONES :<br><br>'.$det['obsprm'].'</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr>
                <td class="datper" style="width: 55%"><strong>APROBADA POR:</strong> ' .($det['nrev']." ".$det['arev']). '</td>
                <td class="datper" style="width: 8%">SI : </td> 
                <td class="datper tit" style="width: 7%">'.(($det['estprm']==3) ? 'X' : '').'</td>
                <td class="datper" style="width: 8%">NO : </td>
                <td class="datper tit" style="width: 7%">'.(($det['estprm']==4) ? 'X' : '').'</td>
                <td style="width: 40%"></td>
            </tr>
        </tbody>
    </table>
    <span><br></span>
    <table>
        <tbody>
            <tr>
                <td class="datper td"><span style="color: blue"><b>NOTA:</b></span><br> <b>TRABAJO EN CASA</b> Se permite solo una vez al mes en los cargos en los cuales es posible realizarlo y avisando con tres (03) dias de anticipación. Cualquier otra ausencia que no califique como calamidad domestica debe ser tramitada como incapacidad en el caso de estar enfermos o licencia no remunerada, la cual debe ser aceptada por el jefe directo de acuerdo a los compromisos que se tengan en cada área.</td>
            </tr>
        </tbody>
    </table>
    </body>
    </html>';

    $fold = 'arc/'.$det['aper'].' '.$det['nper'].'_'.$det['dper'].'/Permisos/';
    $name = $det['tprm']."_".date("d-m-Y", strtotime($det['fecini'])).".pdf";

    $dompdf->loadHtml($html);
    $dompdf->setPaper('Letter', 'portrait');
    $dompdf->render();
    $pdfgen = $dompdf->output();

    if($det['sptrut']) $sptrut = "../".$det['sptrut'];
    
    //-------Unir pdf generado y soporte--------
    if($sptrut && file_exists($sptrut)){
        //-------Cargar pdf generado--------
        $pCountGen = $fpdi->setSourceFile(StreamReader::createByString($pdfgen));
        for ($pageNo = 1; $pageNo <= $pCountGen; $pageNo++) {
            $tplIdx = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($tplIdx);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplIdx);
        }
        
        //-------Cargar pdf soporte--------
        $pCountSpt = $fpdi->setSourceFile($sptrut);
        for ($pageNo = 1; $pageNo <= $pCountSpt; $pageNo++) {
            $tplIdx = $fpdi->importPage($pageNo);
            $size = $fpdi->getTemplateSize($tplIdx);
            $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $fpdi->useTemplate($tplIdx);
        }
        $output = $fpdi->Output('S');
    }else $output = $pdfgen;

    //-------Guardar pdf--------
    if (!file_exists('../'.$fold)) mkdir('../'.$fold, 0755, true);
    $file_path = '../'.$fold.$name;
    file_put_contents($file_path, $output);
    $mprm->setRutpdf($fold.$name);
    $mprm->savePdf();

    //-------Datos jefe--------
    $nompd = nombre($det['ajef']." ".$det['njef']);
    $maild = $det['ejef'];

    //-------Datos aprueba--------
    $nompa = nombre($det['arev']." ".$det['nrev']); 
    $maila = $det['erev'];
    
    //-------Datos colaborador--------
    $nompp = nombre($det['aper']." ".$det['nper']); 
    $mailp = $det['eper'];
    
    $pfec = explode(' ', $det['fini']);
    $fec = $pfec[0].' de '.$pfec[2];

    $fir_mail = '<strong>'.$nom.'</strong><br>'.$direccion.'<br>'.$ubicacion.'<br>'.$web;

    if($estprm==2){
        $template="../views/mailprm.html";
        
        //-------Datos correo jefe--------
        $mail_asun = "Solicitud Permiso ".$nompp." - ".$fec;
        $link = $url."views/pdfprm.php?idprm=".$idprm."&estprm=3&idrev=".$det['ijef'];
        $txt_mess = "";
        $txt_mess = "Te informamos que ".$nompp." está solicitando un permiso para el ".$fec.(($det['tprm']!=48) ? " por motivos de ".$det['tprm'] : "").".<br><br>
        Adjunto a este correo se encuentra el formato debidamente diligenciado.<br><br>
        En los siguientes enlaces podrá aceptar o rechazar la solicitud respectivamente";
        
        $c = 0;
        $exito = sendemail($ema, $psem, $nom, $maild, $nompd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, $link, $url, "../");
        while ($exito==2 && $c<$intentos){
            $exito = sendemail($ema, $psem, $nom, $maild, $nompd, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, $link, $url, "../");
            sleep(5);
            $c++;
    }} elseif($estprm==3 || $estprm==4){
        $template="../views/mail.html";
        
        if($estprm==3){
            //-------Datos correo RRHH y DirAdm--------
            $mail_asun = "Aprobación Permiso ".$nompp." - ".$fec;
            $txt_mess = "";
            $txt_mess = "Informamos que ".$nompa." ha aprobado el permiso de ".$nompp." para el día ".$fec." de ".$det['hini']." a ".$det['hfin']."<br><br>
            Adjunto a este correo se encuentra el formato diligenciado con la aprobación.<br><br>.";

            $c = 0;
            $exito = sendemail($ema, $psem, $nom, $rrhh, $nomrh, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
            while ($exito==2 && $c<$intentos){
                $exito = sendemail($ema, $psem, $nom, $rrhh, $nomrh, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
                sleep(5);
                $c++;
            }

            $c = 0;
            $exito = sendemail($ema, $psem, $nom, $diradm, $nomadm, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
            while ($exito==2 && $c<$intentos){
                $exito = sendemail($ema, $psem, $nom, $diradm, $nomadm, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
                sleep(5);
                $c++;
        }}
        //-------Datos correo colaborador--------
        $mail_asun = (($estprm==3) ? "Aprobación" : "Rechazo"). " Permiso - ".$fec;
        $txt_mess = "";
        $txt_mess = "Te informamos que el permiso solicitado para el día ".$fec." ha sido ".(($estprm==3) ? "aprobado" : "rechazado"). " por ".$nompa."<br><br>
        Adjunto a este correo se encuentra el formato con la respuesta.<br><br>.";

        $c = 0;
        $exito = sendemail($ema, $psem, $nom, $mailp, $nompp, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
        while ($exito==2 && $c<$intentos){
            $exito = sendemail($ema, $psem, $nom, $mailp, $nompp, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, "", "", "../");
            sleep(5);
            $c++;
}}}

function nombre($nombre){
    $partesp = explode(" ", $nombre);
    $apefor = ucfirst(strtolower($partesp[0]));
    $nomfor = ucfirst(strtolower($partesp[count($partesp) > 2 ? 2 : 1]));
    return $nomfor." ".$apefor;
}

?>