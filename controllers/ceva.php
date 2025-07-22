<?php
    require_once("models/meva.php");
   
    $meva = new Meva();

    /*Los tipos de evaluacion se guardan según la relación del evaluador con el evaluado
    Si yo como evaluador me evaluo a mi mismo      --> autoevaluacion = 1
    Si yo como evaluador evaluo a mi subalterno    --> jefe = 2
    Si yo como evaluador evaluo a mi jefe          --> subalterno = 3
    Si yo como evaluador evaluo a par              --> par = 4

    Por lo que como evaluado yo debo buscar los siguiente
    Si a mi como evaluado me evalue a mi mismo     --> autoevaluacion = 1
    Si a mi como evaluado me evaluo mi subalterno  --> lo hizo desde la posicion de subalterno = 3
    Si a mi como evaluado me evaluo mi jefe        --> lo hizo desde la posicion jefe = 2
    Si a mi como evaluado me evaluo mi par         --> par = 4
    */
    
    //------------Evaluacion-----------
    
    $fecini = isset($_POST['fecini']) ? $_POST['fecini']:NULL;
    $fecfin = isset($_POST['fecfin']) ? $_POST['fecfin']:NULL;
    $nota = isset($_POST['nota']) ? $_POST['nota']:NULL;

    //------------Evaluacion-----------
    
    $ideva = isset($_REQUEST['ideva']) ? $_REQUEST['ideva']:NULL;
    $idpereval = isset($_POST['idpereval']) ? $_POST['idpereval']:$_SESSION['idper'];
    $idperevald = isset($_POST['idperevald']) ? $_POST['idperevald']:NULL;
    $idfor = isset($_REQUEST['idfor']) ? $_REQUEST['idfor']:NULL;
    $tipeva = isset($_REQUEST['tipeva']) ? $_REQUEST['tipeva']:NULL;
    
    //------------Respuesta-----------
    
    $idres = isset($_REQUEST['idres']) ? $_REQUEST['idres']:NULL;
    $res1 = isset($_POST['res1']) ? $_POST['res1']:NULL;
    $res2 = isset($_POST['res2']) ? $_POST['res2']:NULL;
    $res3 = isset($_POST['res3']) ? $_POST['res3']:NULL;
    $res4 = isset($_POST['res4']) ? $_POST['res4']:NULL;
    $res5 = isset($_POST['res5']) ? $_POST['res5']:NULL;
    $res6 = isset($_POST['res6']) ? $_POST['res6']:NULL;
    $res7 = isset($_POST['res7']) ? $_POST['res7']:NULL;
    $res8 = isset($_POST['res8']) ? $_POST['res8']:NULL;
    $res9 = isset($_POST['res9']) ? $_POST['res9']:NULL;
    $res10 = isset($_POST['res10']) ? $_POST['res10']:NULL;
    $res11 = isset($_POST['res11']) ? $_POST['res11']:NULL;
    $res12 = isset($_POST['res12']) ? $_POST['res12']:NULL;
    $res13 = isset($_POST['res13']) ? $_POST['res13']:NULL;
    $res14 = isset($_POST['res14']) ? $_POST['res14']:NULL;
    $res15 = isset($_POST['res15']) ? $_POST['res15']:NULL;
    $res16 = isset($_POST['res16']) ? $_POST['res16']:NULL;
    $res17 = isset($_POST['res17']) ? $_POST['res17']:NULL;
    $res18 = isset($_POST['res18']) ? $_POST['res18']:NULL;
    $res19 = isset($_POST['res19']) ? $_POST['res19']:NULL;
    $res20 = isset($_POST['res20']) ? $_POST['res20']:NULL;
    $res21 = isset($_POST['res21']) ? $_POST['res21']:NULL;
    $res22 = isset($_POST['res22']) ? $_POST['res22']:NULL;
    $res23 = isset($_POST['res23']) ? $_POST['res23']:NULL;
    $res24 = isset($_POST['res24']) ? $_POST['res24']:NULL;
    $res25 = isset($_POST['res25']) ? $_POST['res25']:NULL;
    
    $ope = isset($_REQUEST['ope']) ? $_REQUEST['ope']:NULL;

    $datOne = NULL;
    $tiposRequeridos = [
        57 => [1, 2, 3, 4], // Calificado por auto, jefe, sub, par
        58 => [1, 2, 4],    // Calificado por auto, jefe, par
        59 => [1, 2, 4],    // Calificado por auto, jefe, par
        60 => [1, 2, 4],    // Calificado por auto, jefe, par
    ];
    $tiposNombre = [
        1 => "Autoevaluación",
        2 => "Jefe",
        3 => "Subalternos",
        4 => "Pares"
    ];
    $agrupadas = [];
    $tiposEvaluados = [];
    $pendientes = [];
    $cantsub = NULL;
    $cantmin = NULL;
    
    $meva->setIdeva($ideva);
    $meva->setIdres($idres);

    if($ope=="save"){
        //------------Evaluacion-----------
        $meva->setIdpereval($idpereval);
        $meva->setIdperevald($idperevald);
        $meva->setFeceva($hoy);
        $meva->setIdfor($idfor);
        $meva->setTipeva($tipeva);
        $evaluacion = $meva->selectEva();
        if (!$evaluacion){
            $meva->save();
            
            //------------Respuestas-----------
            $evaluacion = $meva->selectEva();
            $meva->setIdeva($evaluacion[0]['ideva']);
            $meva->setRes1($res1);
            $meva->setRes2($res2);
            $meva->setRes3($res3);
            $meva->setRes4($res4);
            $meva->setRes5($res5);
            $meva->setRes6($res6);
            $meva->setRes7($res7);
            $meva->setRes8($res8);
            $meva->setRes9($res9);
            $meva->setRes10($res10);
            $meva->setRes11($res11);
            $meva->setRes12($res12);
            $meva->setRes13($res13);
            $meva->setRes14($res14);
            $meva->setRes15($res15);
            $meva->setRes16($res16);
            $meva->setRes17($res17);
            $meva->setRes18($res18);
            $meva->setRes19($res19);
            $meva->setRes20($res20);
            $meva->setRes21($res21);
            $meva->setRes22($res22);
            $meva->setRes23($res23);
            $meva->setRes24($res24);
            $meva->setRes25($res25);
            $meva->saveRxE();

            //------------Calificaciones-----------
            
            //Valida las evaluaciones que se han realizado a esa personas y las elige
            $evaluaciones = $meva->EvalxTipo($idperevald);

            if($evaluaciones){ foreach ($evaluaciones as $eva) {
                $tipo = $eva['tipeva'];
                $eval = $eva['ideva'];
            
                if ($tipo == 2) $agrupadas[2][] = $eval;
                else $tiposEvaluados[$tipo] = $eval;
            }}

            //Valida que la cantidad de subalternos que lo evaluaron sea proporcional a los que tiene
            $cantsub = $meva->getJxP($idperevald);
            $cantmin = $cantsub[0]['can'];
            if($cantmin>=15) $cantmin -= 5;  
            else if($cantmin>=12) $cantmin -= 4;
            else if($cantmin>=9) $cantmin -= 3;
            else if($cantmin>=6) $cantmin -= 2;
            $cantmin = max(1, $cantmin); // Asegura que al menos requiera 1


            if (!empty($agrupadas[2]) && count($agrupadas[2])>=$cantmin) $tiposEvaluados[2] = $agrupadas[2][array_rand($agrupadas[2])]; //aleatorio

            //Valida cuales evaluaciones requiere la persona evaluada
            $req = $meva->TipoRequeridos($idperevald);
            $idvalfor = $req[0]['idvfor'];
            
            $requeridos = $tiposRequeridos[$idvalfor] ?? [];

            // Verifica que todos los tipos requeridos estén presentes
            $todosCompletos = true;
            if($requeridos){ foreach ($requeridos as $tipo) {
                if (!isset($tiposEvaluados[$tipo])) {
                    $todosCompletos = false;
                    break;
            }}}

            //Inserta solo cuando esten las requeridas
            if ($todosCompletos && !$meva->selectCal($idperevald)) $meva->saveCal($idperevald, $tiposEvaluados);
        }
        echo "<script>window.location='home.php?pg=112';</script>";
    }

    //------------Evaluaciones-----------

    $person = $meva->getAllPer();

    //Valida las evaluaciones que le hacen falta a cada persona
    if($person){ foreach ($person as $prs) {     
        $requeridos = $tiposRequeridos[$prs['idvfor']] ?? []; //Requeridos para la persona
        $evaluados = $meva->EvalxTipo($prs['idper']); //Existentes para la persona

        $tiposEval = array_column($evaluados, 'tipeva');
        $faltantes = array_diff($requeridos, $tiposEval); //Diferencia entre los que hay y se necesitan para dejar solo los faltantes

        if (!empty($faltantes)) {
            $faltantesDetalle = [];
            foreach ($faltantes as $tipo) {
                $evaluadores = $meva->getEvaluador($prs['idper'], $tipo);
                $faltantesDetalle[] = [
                    'tipo' => $tipo,
                    'nomtip' => $tiposNombre[$tipo],
                    'evaluador' => $evaluadores
                ];
            }

            $pendientes[] = [
                'id' => $prs['idper'],
                'nombre' => $prs['nom'],
                'faltantes' => $faltantesDetalle
            ];
        }
    }}
    

    //------------Calificacion-----------
    
    if($ope=='busc'){
        $meva->setFecini($fecini);
        $meva->setFecfin($fecfin);
        $meva->setNota($nota);
        $datAll = $meva->getAll("bus");
    } else $datAll = $meva->getAll("all");
    
    if($ope=='limp') echo "<script>window.location='home.php?pg=113';</script>";
    
    $datPer = $meva->getPer($_SESSION['idper']); 
    
    //------------Calcular nota-----------

    if($ope=='calcular'){
        foreach($datAll AS $reg){
            if(!$reg['nota']){
                $final = calcularNota($reg);
                $meva->setIdperevald($reg['idper']);
                $meva->setNota($final);
                $meva->saveNota();
            }
        }
        echo "<script>window.location='home.php?pg=113';</script>";
    }


?>