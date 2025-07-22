<?php
    require_once("models/mfor.php");
   
    $mfor = new Mfor();

    //------------Formato-----------

    $idfor = isset($_REQUEST['idfor']) ? $_REQUEST['idfor']:NULL;
    $tipfor = isset($_POST['tipfor']) ? $_POST['tipfor']:NULL;
    $codfor = isset($_POST['codfor']) ? $_POST['codfor']:NULL;
    $verfor = isset($_POST['verfor']) ? $_POST['verfor']:NULL;
    $actfor = isset($_REQUEST['actfor']) ? $_REQUEST['actfor']:NULL;
    $nomsec1 = isset($_POST['nomsec1']) ? $_POST['nomsec1']:NULL;
    $pre1 = isset($_POST['pre1']) ? $_POST['pre1']:NULL;
    $pre2 = isset($_POST['pre2']) ? $_POST['pre2']:NULL;
    $pre3 = isset($_POST['pre3']) ? $_POST['pre3']:NULL;
    $pre4 = isset($_POST['pre4']) ? $_POST['pre4']:NULL;
    $pre5 = isset($_POST['pre5']) ? $_POST['pre5']:NULL;
    $nomsec2 = isset($_POST['nomsec2']) ? $_POST['nomsec2']:NULL;
    $pre6 = isset($_POST['pre6']) ? $_POST['pre6']:NULL;
    $pre7 = isset($_POST['pre7']) ? $_POST['pre7']:NULL;
    $pre8 = isset($_POST['pre8']) ? $_POST['pre8']:NULL;
    $pre9 = isset($_POST['pre9']) ? $_POST['pre9']:NULL;
    $pre10 = isset($_POST['pre10']) ? $_POST['pre10']:NULL;
    $nomsec3 = isset($_POST['nomsec3']) ? $_POST['nomsec3']:NULL;
    $pre11 = isset($_POST['pre11']) ? $_POST['pre11']:NULL;
    $pre12 = isset($_POST['pre12']) ? $_POST['pre12']:NULL;
    $pre13 = isset($_POST['pre13']) ? $_POST['pre13']:NULL;
    $pre14 = isset($_POST['pre14']) ? $_POST['pre14']:NULL;
    $pre15 = isset($_POST['pre15']) ? $_POST['pre15']:NULL;
    $nomsec4 = isset($_POST['nomsec4']) ? $_POST['nomsec4']:NULL;
    $pre16 = isset($_POST['pre16']) ? $_POST['pre16']:NULL;
    $pre17 = isset($_POST['pre17']) ? $_POST['pre17']:NULL;
    $pre18 = isset($_POST['pre18']) ? $_POST['pre18']:NULL;
    $pre19 = isset($_POST['pre19']) ? $_POST['pre19']:NULL;
    $pre20 = isset($_POST['pre20']) ? $_POST['pre20']:NULL;
    $nomsec5 = isset($_POST['nomsec5']) ? $_POST['nomsec5']:NULL;
    $pre21 = isset($_POST['pre21']) ? $_POST['pre21']:NULL;
    $pre22 = isset($_POST['pre22']) ? $_POST['pre22']:NULL;
    $pre23 = isset($_POST['pre23']) ? $_POST['pre23']:NULL;
    $pre24 = isset($_POST['pre24']) ? $_POST['pre24']:NULL;
    $pre25 = isset($_POST['pre25']) ? $_POST['pre25']:NULL;
    $porjef = isset($_POST['porjef']) ? $_POST['porjef']:NULL;
    $porpar = isset($_POST['porpar']) ? $_POST['porpar']:NULL;
    $poraut = isset($_POST['poraut']) ? $_POST['poraut']:NULL;
    $porsub = isset($_POST['porsub']) ? $_POST['porsub']:NULL;

    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $pg = 109;
    $datOne = NULL;
    $cambforact = NULL;
    
    $mfor->setIdfor($idfor);

    if($ope=="save"){
        $mfor->setTipfor($tipfor);
        $mfor->setCodfor($codfor);
        $mfor->setVerfor($verfor);
        $mfor->setFecfor($hoy);
        $mfor->setNomsec1($nomsec1);
        $mfor->setPre1($pre1);
        $mfor->setPre2($pre2);
        $mfor->setPre3($pre3);
        $mfor->setPre4($pre4);
        $mfor->setPre5($pre5);
        $mfor->setNomsec2($nomsec2);
        $mfor->setPre6($pre6);
        $mfor->setPre7($pre7);
        $mfor->setPre8($pre8);
        $mfor->setPre9($pre9);
        $mfor->setPre10($pre10);
        $mfor->setNomsec3($nomsec3);
        $mfor->setPre11($pre11);
        $mfor->setPre12($pre12);
        $mfor->setPre13($pre13);
        $mfor->setPre14($pre14);
        $mfor->setPre15($pre15);
        $mfor->setNomsec4($nomsec4);
        $mfor->setPre16($pre16);
        $mfor->setPre17($pre17);
        $mfor->setPre18($pre18);
        $mfor->setPre19($pre19);
        $mfor->setPre20($pre20);
        $mfor->setNomsec5($nomsec5);
        $mfor->setPre21($pre21);
        $mfor->setPre22($pre22);
        $mfor->setPre23($pre23);
        $mfor->setPre24($pre24);
        $mfor->setPre25($pre25);
        $mfor->setPorjef($porjef);  
        $mfor->setPorpar($porpar);  
        $mfor->setPoraut($poraut);  
        $mfor->setPorsub($porsub);  
        $mfor->setActfor($actfor);
        if(!$idfor) $mfor->save();
        else $mfor->edit();
        if($actfor==1){
            $cambforact = $mfor->selectFor($tipfor, 1, $codfor);
            if($cambforact){ foreach($cambforact as $cfa){
                $mfor->setIdfor($cfa['idfor']);
                $mfor->setActfor(2);
                $mfor->editAct();
            }}
        }
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    if($ope=='act' && $idfor && $actfor){
        $mfor->setActfor($actfor);
        $mfor->editAct();
        $datOne = $mfor->getOne();
        if($actfor==1){
            $cambforact = $mfor->selectFor($datOne[0]['tipfor'], 1, $datOne[0]['codfor']);
            if($cambforact){ foreach($cambforact as $cfa){
                $mfor->setIdfor($cfa['idfor']);
                $mfor->setActfor(2);
                $mfor->editAct();
            }}
        }
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    
    if($ope=='del' && $idfor){
        $mfor->del();
        echo "<script>window.location='home.php?pg=".$pg."';</script>";
    }
    if($ope=='edi' && $idfor) $datOne = $mfor->getOne();
    
    $datAll = $mfor->getAll();
    $datFor = $mfor->getAllDom(10);
?>