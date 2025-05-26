<?php
    require_once("models/mfor.php");
   
    $mfor = new Mfor();

    //------------Formato-----------

    $idfor = isset($_REQUEST['idfor']) ? $_REQUEST['idfor']:NULL;
    $nomfor = isset($_POST['nomfor']) ? $_POST['nomfor']:NULL;
    $codfor = isset($_POST['codfor']) ? $_POST['codfor']:NULL;
    $pre1 = isset($_POST['pre1']) ? $_POST['pre1']:NULL;
    $pre2 = isset($_POST['pre2']) ? $_POST['pre2']:NULL;
    $pre3 = isset($_POST['pre3']) ? $_POST['pre3']:NULL;
    $pre4 = isset($_POST['pre4']) ? $_POST['pre4']:NULL;
    $pre5 = isset($_POST['pre5']) ? $_POST['pre5']:NULL;
    $pre6 = isset($_POST['pre6']) ? $_POST['pre6']:NULL;
    $pre7 = isset($_POST['pre7']) ? $_POST['pre7']:NULL;
    $pre8 = isset($_POST['pre8']) ? $_POST['pre8']:NULL;
    $pre9 = isset($_POST['pre9']) ? $_POST['pre9']:NULL;
    $pre10 = isset($_POST['pre10']) ? $_POST['pre10']:NULL;
    $pre11 = isset($_POST['pre11']) ? $_POST['pre11']:NULL;
    $pre12 = isset($_POST['pre12']) ? $_POST['pre12']:NULL;
    $pre13 = isset($_POST['pre13']) ? $_POST['pre13']:NULL;
    $pre14 = isset($_POST['pre14']) ? $_POST['pre14']:NULL;
    $pre15 = isset($_POST['pre15']) ? $_POST['pre15']:NULL;
    $porjef = isset($_POST['porjef']) ? $_POST['porjef']:NULL;
    $porpar = isset($_POST['porpar']) ? $_POST['porpar']:NULL;
    $poraut = isset($_POST['poraut']) ? $_POST['poraut']:NULL;
    $porsub = isset($_POST['porsub']) ? $_POST['porsub']:NULL;
    $actfor = isset($_REQUEST['actfor']) ? $_REQUEST['actfor']:1;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $pg = 109;
    $datOne = NULL;
    
    $mfor->setIdfor($idfor);

    if($ope=="save"){
        $mfor->setNomfor($nomfor);
        $mfor->setCodfor($codfor);
        $mfor->setFecfor($hoy);
        $mfor->setPre1($pre1);
        $mfor->setPre2($pre2);
        $mfor->setPre3($pre3);
        $mfor->setPre4($pre4);
        $mfor->setPre5($pre5);
        $mfor->setPre6($pre6);
        $mfor->setPre7($pre7);
        $mfor->setPre8($pre8);
        $mfor->setPre9($pre9);
        $mfor->setPre10($pre10);
        $mfor->setPre11($pre11);
        $mfor->setPre12($pre12);
        $mfor->setPre13($pre13);
        $mfor->setPre14($pre14);
        $mfor->setPre15($pre15);
        $mfor->setPorjef($porjef);  
        $mfor->setPorpar($porpar);  
        $mfor->setPoraut($poraut);  
        $mfor->setPorsub($porsub);  
        $mfor->setActfor($actfor);  
        if(!$idfor) $mfor->save();
        else $mfor->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }

    if($ope=='act' && $idfor && $actfor){
        $mfor->setActfor($actfor);
        $mfor->editAct();
    }

    if($ope=='del' && $idfor) $mfor->del();
    if($ope=='edi' && $idfor) $datOne = $mfor->getOne();
    
    $datAll = $mfor->getAll();
?>