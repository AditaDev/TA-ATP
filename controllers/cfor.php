<?php
    require_once("models/mfor.php");
   

    $mfor = new Mfor();

    //------------Factura-----------

    $idres = isset($_REQUEST['idres']) ? $_REQUEST['idres']:NULL;
    $idpereval = isset($_POST['idpereval']) ? $_POST['idpereval']:$_SESSION['idper']; //Evaluado
    $idperevald = isset($_REQUEST['idperevald']) ? $_REQUEST['idperevald']:NULL; //Evaluador
    $tipeva = isset($_POST['tipeva']) ? $_POST['tipeva']:NULL;
    $pre1 = isset($_POST['pre1']) ? $_POST['pre1']:NULL;
    $pre2 = isset($_POST['pre2']) ? $_POST['pre2']:NULL; // fecha emision
    $pre3 = isset($_POST['pre3']) ? $_POST['pre3']:NULL; // fecha vencimiento
    $pre4 = isset($_POST['pre4']) ? $_POST['pre4']:NULL;
    $pre5 = isset($_POST['pre5']) ? $_POST['pre5']:NULL;
    $pre6 = isset($_POST['pre6']) ? $_POST['pre6']:NULL;
    $pre7 = isset($_POST['pre7']) ? $_POST['pre7']:NULL;
    $pre8 = isset($_POST['pre8']) ? $_POST['pre8']:NULL;
    $pre9 = isset($_POST['pre9']) ? $_POST['pre9']:NULL;
    $pre10 = isset($_POST['pre10']) ? $_POST['pre10']:NULL;
    $pre11 = isset($_POST['pre11']) ? $_POST['pre11']:NULL;
    $pre12 = isset($_POST['pre12']) ? $_POST['pre12']:NULL;
    $fecres = date("Y-m-d H:i:s"); // fecha actual
   
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $datOne = NULL;
    // $datALL = NULL;
    $datcal = $mfor->getAllDom(16);
    $datAll = $mfor->getAll();


    if($ope=="save"){
        $mfor->setIdpereval($idpereval);
        $mfor->setIdperevald($idperevald);
        $mfor->setTipeva($tipeva);
        $mfor->setPre2($pre2);
        $mfor->setPre1($pre1);
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
        $mfor->setFecres($fecres);  
        if(!$idres) $mfor->save();
        else $mfor->edit();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }