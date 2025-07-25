<?php
    require_once("models/mper.php");
    include("models/datos.php");
    require ('vendor/autoload.php');
    require ('controllers/sendemail.php');

    use PhpOffice\PhpSpreadsheet\IOFactory;

    $mper = new Mper();

    //------------Persona-----------
    $idper = isset($_REQUEST['idper']) ? $_REQUEST['idper']:NULL;
    $nomper = isset($_POST['nomper']) ? $_POST['nomper']:NULL;
    $apeper = isset($_POST['apeper']) ? $_POST['apeper']:NULL;
    $ndper = isset($_POST['ndper']) ? $_POST['ndper']:NULL;
    $area = isset($_POST['area']) ? $_POST['area']:NULL;
    $cargo = isset($_POST['cargo']) ? $_POST['cargo']:NULL;
    $idvfor = isset($_POST['idvfor']) ? $_POST['idvfor']:NULL;
    $emaper = isset($_POST['emaper']) ? strtolower($_POST['emaper']):NULL;
    $actper = isset($_REQUEST['actper']) ? $_REQUEST['actper']:1;
    $nivel = isset($_REQUEST['nivel']) ? $_REQUEST['nivel']:NULL;

     //------------Contraseña-----------
    $pass = "A".$ndper."P";
    $pasper = encripta($pass);
    $hash = $pasper['hash'];
    $salt = $pasper['salt'];

    //------------Jefe-----------
    $idjef = isset($_POST['idjef']) ? $_POST['idjef']:NULL;

    //------------Perfil-----------
    $idpef = isset($_POST['idpef']) ? $_POST['idpef']:3;
    
    $arc = isset($_FILES["arc"]["name"]) ? $_FILES["arc"]["name"] : NULL;
    $arc = substr($arc, 0, strpos($arc, ".xls"));

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;
    $datOne = NULL;
    $datJxP=NULL;
    $pg = 106;
    $intentos = 5;

    //------------Correo-----------
    $nombre = nombre($apeper." ".$nomper);
    $template = "views/mail.html";
    $mail_asun = "¡Bienvenido a TUMMY!";
    $txt_mess = "Es un placer darte la bienvenida a TUMMY, nuestra nueva aplicación diseñada para optimizar la gestión de permisos laborales, facilitar el seguimiento de entregas de dotaciones y permitir la realización de evaluaciones de desempeño periódicas de manera eficiente.<br><br>
    Aquí tienes tus credenciales de acceso:<br><br>
    <strong>• Usuario: </strong>".$ndper.(($emaper) ? " / ".$emaper : "")."<br>
    <strong>• Contraseña: </strong>".$pass."<br><br><br>
    <mark><strong>Importante:</strong></mark><br><br>
    Por tu seguridad, te pedimos que cambies tu contraseña al iniciar sesión por primera vez.<br><br>
    Para acceder a la aplicación, ingrese en el siguiente enlace: <a href='".$url."'>👉 Acceder a TUMMY</a><br><br>
    Si tiene alguna pregunta o requiere asistencia, no dude en ponerse en contacto con nosotros.<br><br>
    Agradecemos su confianza y esperamos que disfrute de la nueva experiencia.<br><br>";
    $fir_mail = '<strong>'.$nom.'</strong><br>'.$direccion.'<br>'.$ubicacion.'<br>'.$web;

    //------------Traer valores-----------
    $datAll = $mper->getAll();
    $datarea = $mper->getAllDom(2);
    $datPer = $mper->getPer("");
    $datFor = $mper->getAllDom(10);

    $mper->setIdper($idper);
    //------------Persona-----------
    if($ope=="save"){
        $mper->setNomper($nomper); 
        $mper->setApeper($apeper);
        $mper->setEmaper($emaper);
        $mper->setNdper($ndper);
        $mper->setArea($area);
        $mper->setCargo($cargo);
        $mper->setIdvfor($idvfor);
        $mper->setActper($actper);
        $mper->setNivel($nivel);
        $mper->setIdjef($idjef);
        $mper->setHash($hash);
        $mper->setSalt($salt);
        $existusu = $mper->selectUsu();
        if($existusu){
           $idper = $existusu[0]['idper'];
           $mper->setIdper($idper);
        }if(!$idper) {
            $mper->save();
            $per = $mper->getOneSPxF($ndper); 
            $mper->savePxFAut($per[0]['idper'],$idpef);
            $mper->setIdper($per[0]['idper']);
            if($emaper){ 
                $c = 0;
                $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                while ($exito==2 && $c<$intentos){
                    $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                    sleep(5);
                    $c++;
                }
                if($exito==2) echo '<script>err("Ooops... No se pudo enviar el correo.");</script>';
        }}else{
            $mper->edit();
            if($idper == $_SESSION["idper"]){
                $_SESSION['nomper'] = $nomper;
                $_SESSION['apeper'] = $apeper;
                $_SESSION['emaper'] = $emaper;
                $_SESSION['ndper'] = $ndper;
                $_SESSION['area'] = $area;
            }
        } 
        if($idper) $mper->delJxP();
        if($idjef){ foreach ($idjef as $i=>$jf) {
            if($jf){
                $mper->setIdjef($jf);
                $mper->saveJxP($i+1);
            }
        }}
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 5000);</script>";
    }

    if($ope=="act" && $idper && $actper){
        $mper->setActper($actper);
        $mper->editAct();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=="edi"&& $idper){
        $datPer=$mper->getPer($idper);
        $datOne=$mper->getOne();
        $datJxP=$mper->getOneJxP();
    }

    if($_SESSION['idpef']==3){
        $mper->setIdper($_SESSION['idper']);
        $datOne=$mper->getOne();
        $datJxP=$mper->getOneJxP();
        $est = 1;
    }

   if($ope=="eli"&& $idper){
        $mper->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    //------------Perfil-----------
    if($ope=="savepxf"){
        if($idper) $mper->delPxF();
        if($idpef){ foreach ($idpef as $pf) {
            if($pf){
                $mper->setIdpef($pf);
                $mper->savePxF();
            }
        }}
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
        //------------Importar empleados-----------
    if ($ope=="carper" && $arc) {
        $dat = opti($_FILES["arc"], $arc, "arc/xls", $nomarc);
        $inputFileType = IOFactory::identify($dat);
        $objReader = IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($dat);
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 3; $row <= $highestRow; $row++) {
            // obtengo el valor de la celda
            $pf = 0;
            $idpefA = [];
            $idjefi = NULL;
            $idjefa = NULL;
            $idjefa = NULL;
            $idvfor = NULL;
            $ndper = $sheet->getCell("B" . $row)->getValue();
            $nomper = $sheet->getCell("C" . $row)->getValue();
            $apeper = $sheet->getCell("D" . $row)->getValue();
            $emaper = $sheet->getCell("E" . $row)->getValue();
            $cargo = $sheet->getCell("F" . $row)->getValue();
            $area = $sheet->getCell("G" . $row)->getValue();
            $mper->setIdval($area);
            $carea = $mper->CompVal();
            $areai = $carea[0]['idval'];
            
            $idvfor = $sheet->getCell("H" . $row)->getValue();
            $mper->setIdval($idvfor);
            $cidvfor = $mper->CompVal();
            $idvfori = $cidvfor[0]['idval'];
            
            $actper = $sheet->getCell("I" . $row)->getValue();
            $nivel = $sheet->getCell("J" . $row)->getValue();
            $idpef = $sheet->getCell("K" . $row)->getValue();
            $idpef = str_replace(' ', '', $idpef);
            $idpefA = explode("*", $idpef);
            foreach($idpefA AS $pa){
                $mper->setIdpef($pa); 
                $pef = $mper->CompPef();
                $pef = $pef[0]['idpef'];
                if($pef) $pf++;
            }
            $ndjefi = $sheet->getCell("L" . $row)->getValue();
            $mper->setNdper($ndjefi); 
            $idjefia = $mper->selectUsu(); 
            if($idjefia) $idjefi = $idjefia[0]['idper'];


            $ndjefa = $sheet->getCell("N" . $row)->getValue();
            $mper->setNdper($ndjefa); 
            $idjefaa = $mper->selectUsu(); 
            if($idjefaa) $idjefa = $idjefaa[0]['idper'];


            $pass = "A".$ndper."P";
            $pasper = encripta($pass);
            $hash = $pasper['hash'];
            $salt = $pasper['salt'];
            $nombre = nombre($apeper." ".$nomper);
            $txt_mess = "Es un placer darle la bienvenida a nuestra nueva aplicación. A continuación, le proporcionamos sus credenciales de acceso:<br><br>
            <strong>Usuario: </strong>".$ndper.(($emaper) ? "/".$emaper : "")."<br>
            <strong>Contraseña: </strong>".$pass."<br><br>
            Le solicitamos que, al iniciar sesión por primera vez, cambie su contraseña para garantizar la seguridad de su cuenta.<br><br>
            Para acceder a la aplicación, ingrese en el siguiente enlace: <a href='".$url."'>App Tummy</a><br><br>
            Si tiene alguna pregunta o requiere asistencia, no dude en ponerse en contacto con nosotros.<br><br>
            Agradecemos su confianza y esperamos que disfrute de la nueva experiencia.<br><br>";
            $mper->setNomper($nomper);
            $mper->setApeper($apeper);
            $mper->setNdper($ndper);
            $mper->setEmaper($emaper);
            $mper->setArea($area);
            $mper->setCargo($cargo);
            $mper->setIdvfor($idvfor);
            $mper->setActper($actper);
            $mper->setNivel($nivel);
            $mper->setIdpef($idpef);
            $mper->setHash($hash);
            $mper->setSalt($salt);
            $existingData = $mper->selectUsu();
    		 if($existingData){
                $idper = $existingData[0]['idper'];
                $mper->setIdper($idper);
    		} if ($emaper && count($idpefA)==$pf && (!$area OR ($areai && $area)) && (!$idvfor OR ($idvfori && $idvfor)) && (!$ndjefi OR ($ndjefi && $idjefi)) && (!$ndjefa OR ($ndjefa && $idjefa))) {
                if (!empty($ndper)) {
    		    	if (!$idper) {
    		    		$mper->save();
                        $per = $mper->getOneSPxF($ndper);
                        $mper->setIdper($per[0]['idper']);
                        if($emaper){
                            $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                            while ($exito==2) $exito = sendemail($ema, $psem, $nom, $emaper, $nombre, "", $txt_mess, $mail_asun, $fir_mail, $template, "", "", "");
                        }
    		    	}else {
    		    		$mper->edit();
                        $mper->delPxF();
                        $mper->delJxP();
    		    	} if($idjefi){
                        $mper->setIdjef($idjefi);
                        $mper->saveJxP(1);
                    } if($idjefa){
                        $mper->setIdjef($idjefa);
                        $mper->saveJxP(2);
                    } if($idpefA){ foreach ($idpefA as $pf) {
                        if($pf){
                            $mper->setIdpef($pf);
                            $mper->savePxF();
                        }
                    }} 
                }
    		}else{
                $reg = $row;
                $row = $highestRow+5;
            }
    	}
        if($row>$highestRow+5) echo '<script>err("Ooops... Algo esta mal en la fila #'.$reg.', corrígelo y vuelve a subir el archivo");</script>';
        else echo '<script>satf("Todos los datos han sido registrados con exito, por favor espere un momento");</script>';
        echo "<script>setTimeout(function(){ window.location='home.php?pg=".$pg."';}, 7000);</script>";
    }

    function nombre($nombre){
        $partesp = explode(" ", $nombre);
        $apefor = ucfirst(strtolower($partesp[0]));
        $nomfor = ucfirst(strtolower($partesp[count($partesp) > 2 ? 2 : 1]));
        return $nomfor." ".$apefor;
    }
?>
