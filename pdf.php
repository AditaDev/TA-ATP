
<?php
    require_once ("models/seguridad.php");
    require_once ('models/conexion.php');
    require_once ('models/mdot.php');
    require_once ('models/mprm.php');
    require_once ('models/meva.php');

    $mprm = new Mprm();
    $mdot = new Mdot();
    $meva = new Meva();

    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : NULL;
    $arc = isset($_REQUEST['arc']) ? $_REQUEST['arc'] : NULL;
    $pg = isset($_REQUEST['pg']) ? $_REQUEST['pg'] : NULL; 

    if ($pg == 110) {
        $mdot->setIdent($id); 
        if ($arc) {
            $dt = $mdot->getPdf(); 
            $rut = $dt[0]['rut'];
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($rut) . '"');
            readfile($rut);
        }
    }elseif ($pg == 111) {
        $mprm->setIdprm($id); 
        if ($arc) {
            $dt = $mprm->getPdf($arc);
            $rut = $dt[0]['rut'];
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($rut) . '"');
            readfile($rut);
        }
    }elseif ($pg == 113) {
        $meva->setIdcal($id); 
        if ($arc) {
            $dt = $meva->getPdf($arc);
            $rut = $dt[0]['rut'];
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($rut) . '"');
            readfile($rut);
        }
    }
?>
