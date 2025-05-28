<?php
    class Meva{

       //------------Evaluacion-----------
       
        private $ideva;
        private $idpereval;
        private $idperevald;
        private $feceva;

       //------------Respuestas-----------

        private $idres;
        private $res1;
        private $res2;
        private $res3;
        private $res4;
        private $res5;
        private $res6;
        private $res7;
        private $res8;
        private $res9;
        private $res10;
        private $res11;
        private $res12;
        private $res13;
        private $res14;
        private $res15;
        private $res16;
        private $res17;
        private $res18;
        private $res19;
        private $res20;
        private $res21;
        private $res22;
        private $res23;
        private $res24;
        private $res25;
      
       
        //------------Evaluacion-----------
       
        public function getIdeva(){
            return $this->ideva;
        }
        public function getIdpereval(){
            return $this->idpereval;
        }
        public function getIdperevald(){
            return $this->idperevald;
        }
        public function getFeceva(){
            return $this->feceva;
        }
        
        public function setIdeva($ideva){
            $this->ideva=$ideva;
        }
        public function setIdpereval($idpereval){
            $this->idpereval=$idpereval;
        }
        public function setIdperevald($idperevald){
            $this->idperevald=$idperevald;
        }
        public function setFeceva($feceva){
            $this->feceva=$feceva;
        }

       //------------Respuestas-----------

        public function getIdres(){
            return $this->idres;
        }
        public function getRes1(){
            return $this->res1;
        }
        public function getRes2(){
            return $this->res2;
        }
        public function getRes3(){
            return $this->res3;
        }
        public function getRes4(){
            return $this->res4;
        }
        public function getRes5(){
            return $this->res5;
        }
        public function getRes6(){
            return $this->res6;
        }
        public function getRes7(){
            return $this->res7;
        }
        public function getRes8(){
            return $this->res8;
        }
        public function getRes9(){
            return $this->res9;
        }
        public function getRes10(){
            return $this->res10;
        }
        public function getRes11(){
            return $this->res11;
        }
        public function getRes12(){
            return $this->res12;
        }
        public function getRes13(){
            return $this->res13;
        }
        public function getRes14(){
            return $this->res14;
        }
        public function getRes15(){
            return $this->res15;
        }
        public function getRes16(){
            return $this->res16;
        }
        public function getRes17(){
            return $this->res17;
        }
        public function getRes18(){
            return $this->res18;
        }
        public function getRes19(){
            return $this->res19;
        }
        public function getRes20(){
            return $this->res20;
        }
        public function getRes21(){
            return $this->res21;
        }
        public function getRes22(){
            return $this->res22;
        }
        public function getRes23(){
            return $this->res23;
        }
        public function getRes24(){
            return $this->res24;
        }
        public function getRes25(){
            return $this->res25;
        }

        public function setIdres($idres){
            $this->idres=$idres;
        }
        public function setRes1($res1){
            $this->res1=$res1;
        }
        public function setRes2($res2){
            $this->res2=$res2;
        }
        public function setRes3($res3){
            $this->res3=$res3;
        }
        public function setRes4($res4){
            $this->res4=$res4;
        }
        public function setRes5($res5){
            $this->res5=$res5;
        }
        public function setRes6($res6){
            $this->res6=$res6;
        }
        public function setRes7($res7){
            $this->res7=$res7;
        }
        public function setRes8($res8){
            $this->res8=$res8;
        }
        public function setRes9($res9){
            $this->res9=$res9;
        }
        public function setRes10($res10){
            $this->res10=$res10;
        }
        public function setRes11($res11){
            $this->res11=$res11;
        }
        public function setRes12($res12){
            $this->res12=$res12;
        }
        public function setRes13($res13){
            $this->res13=$res13;
        }
        public function setRes14($res14){
            $this->res14=$res14;
        }
        public function setRes15($res15){
            $this->res15=$res15;
        }
        public function setRes16($res16){
            $this->res16=$res16;
        }
        public function setRes17($res17){
            $this->res17=$res17;
        }
        public function setRes18($res18){
            $this->res18=$res18;
        }
        public function setRes19($res19){
            $this->res19=$res19;
        }
        public function setRes20($res20){
            $this->res20=$res20;
        }
        public function setRes21($res21){
            $this->res21=$res21;
        }
        public function setRes22($res22){
            $this->res22=$res22;
        }
        public function setRes23($res23){
            $this->res23=$res23;
        }
        public function setRes24($res24){
            $this->res24=$res24;
        }
        public function setRes25($res25){
            $this->res25=$res25;
        }

        // function getAll(){
        //     $sql = "SELECT idfor, nomfor, codfor, fecfor, nomsec1, pre1, pre2, pre3, pre4, pre5, nomsec2, pre6, pre7, pre8, pre9, pre10, nomsec3, pre11, pre12, pre13, pre14, pre15, nomsec4, pre16, pre17, pre18, pre19, pre20, nomsec5, pre21, pre22, pre23, pre24, pre25, porjef, porpar, poraut, porsub, actfor FROM formato;";
        //     $modelo = new conexion();
        //     $conexion = $modelo->get_conexion();
        //     $result = $conexion->prepare($sql);
        //     $result->execute();
        //     $res = $result->fetchall(PDO::FETCH_ASSOC);
        //     return $res;
        // }

        // function getOne(){
        //     $sql = "SELECT idfor, nomfor, codfor, fecfor, nomsec1, pre1, pre2, pre3, pre4, pre5, nomsec2, pre6, pre7, pre8, pre9, pre10, nomsec3, pre11, pre12, pre13, pre14, pre15, nomsec4, pre16, pre17, pre18, pre19, pre20, nomsec5, pre21, pre22, pre23, pre24, pre25, porjef, porpar, poraut, porsub, actfor FROM formato WHERE idfor=:idfor";
        //     $modelo = new conexion();
        //     $conexion = $modelo->get_conexion();
        //     $result = $conexion->prepare($sql);
        //     $idfor = $this->getIdfor();
        //     $result->bindParam(":idfor", $idfor);
        //     $result->execute();
        //     $res = $result->fetchall(PDO::FETCH_ASSOC);
        //     return $res;
        // }

        function saveRxE(){
            try {
                $sql = "INSERT INTO respuesta (ideva, res1, res2, res3, res4, res5, res6, res7, res8, res9, res10, res11, res12, res13, res14, res15, res16, res17, res18, res19, res20, res21, res22, res23, res24, res25) VALUES (:ideva, :res1, :res2, :res3, :res4, :res5, :res6, :res7, :res8,res9, :res10, :res11, :res12, :res13, :res14, :res15, :res16, :res17, :res18, :res19, :res20, :res21, :res22, :res23, :res24, :res25)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ideva = $this->getIdeva();
                $result->bindParam(":ideva", $ideva);
                $res1 = $this->getRes1();
                $result->bindParam(":res1", $res1);
                $res2 = $this->getRes2();
                $result->bindParam(":res2", $res2);
                $res3 = $this->getRes3();
                $result->bindParam(":res3", $res3);
                $res4 = $this->getRes4();
                $result->bindParam(":res4", $res4);
                $res5 = $this->getRes5();
                $result->bindParam(":res5", $res5);
                $res6 = $this->getRes6();
                $result->bindParam(":res6", $res6);
                $res7 = $this->getRes7();
                $result->bindParam(":res7", $res7);
                $res8 = $this->getRes8();
                $result->bindParam(":res8", $res8);
                $res9 = $this->getRes9();
                $result->bindParam(":res9", $res9);
                $res10 = $this->getRes10();
                $result->bindParam(":res10", $res10);
                $res11 = $this->getRes11();
                $result->bindParam(":res11", $res11);
                $res12 = $this->getRes12();
                $result->bindParam(":res12", $res12);
                $res13 = $this->getRes13();
                $result->bindParam(":res13", $res13);
                $res14 = $this->getRes14();
                $result->bindParam(":res14", $res14);
                $res15 = $this->getRes15();
                $result->bindParam(":res15", $res15);
                $res16 = $this->getRes16();
                $result->bindParam(":res16", $res16);
                $res17 = $this->getRes17();
                $result->bindParam(":res17", $res17);
                $res18 = $this->getRes18();
                $result->bindParam(":res18", $res18);
                $res19 = $this->getRes19();
                $result->bindParam(":res19", $res19);
                $res20 = $this->getRes20();
                $result->bindParam(":res20", $res20);
                $res21 = $this->getRes21();
                $result->bindParam(":res21", $res21);
                $res22 = $this->getRes22();
                $result->bindParam(":res22", $res22);
                $res23 = $this->getRes23();
                $result->bindParam(":res23", $res23);
                $res24 = $this->getRes24();
                $result->bindParam(":res24", $res24);
                $res25 = $this->getRes25();
                $result->bindParam(":res25", $res25);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        // function edit(){
        //     try {
        //         $sql = "UPDATE formato SET nomfor=:nomfor, codfor=:codfor, fecfor=:fecfor, nomsec1=:nomsec1, pre1=:pre1, pre2=:pre2, pre3=:pre3, pre4=:pre4, pre5=:pre5, nomsec2=:nomsec2, pre6=:pre6, pre7=:pre7, pre8=:pre8, pre9=:pre9, pre10=:pre10, nomsec3=:nomsec3, pre11=:pre11, pre12=:pre12, pre13=:pre13, pre14=:pre14, pre15=:pre15, nomsec4=:nomsec4, pre16=:pre16, pre17=:pre17, pre18=:pre18, pre19=:pre19, pre20=:pre20, nomsec5=:nomsec5, pre21=:pre21, pre22=:pre22, pre23=:pre23, pre24=:pre24, pre25=:pre25, porjef=:porjef, porpar=:porpar, poraut=:poraut, porsub=:porsub, actfor=:actfor WHERE idfor=:idfor";
        //         $modelo = new conexion();
        //         $conexion = $modelo->get_conexion();
        //         $result = $conexion->prepare($sql);
        //         $idfor = $this->getIdfor();
        //         $result->bindParam(":idfor", $idfor);
        //         $nomfor = $this->getNomfor();
        //         $result->bindParam(":nomfor", $nomfor);
        //         $codfor = $this->getCodfor();
        //         $result->bindParam(":codfor", $codfor);
        //         $fecfor = $this->getFecfor();
        //         $result->bindParam(":fecfor", $fecfor);
        //         $nomsec1 = $this->getNomsec1();
        //         $result->bindParam(":nomsec1", $nomsec1);
        //         $pre1 = $this->getPre1();
        //         $result->bindParam(":pre1", $pre1);
        //         $pre2 = $this->getPre2();
        //         $result->bindParam(":pre2", $pre2);
        //         $pre3 = $this->getPre3();
        //         $result->bindParam(":pre3", $pre3);
        //         $pre4 = $this->getPre4();
        //         $result->bindParam(":pre4", $pre4);
        //         $pre5 = $this->getPre5();
        //         $result->bindParam(":pre5", $pre5);
        //         $nomsec2 = $this->getNomsec2();
        //         $result->bindParam(":nomsec2", $nomsec2);
        //         $pre6 = $this->getPre6();
        //         $result->bindParam(":pre6", $pre6);
        //         $pre7 = $this->getPre7();
        //         $result->bindParam(":pre7", $pre7);
        //         $pre8 = $this->getPre8();
        //         $result->bindParam(":pre8", $pre8);
        //         $pre9 = $this->getPre9();
        //         $result->bindParam(":pre9", $pre9);
        //         $pre10 = $this->getPre10();
        //         $result->bindParam(":pre10", $pre10);
        //         $nomsec3 = $this->getNomsec3();
        //         $result->bindParam(":nomsec3", $nomsec3);
        //         $pre11 = $this->getPre11();
        //         $result->bindParam(":pre11", $pre11);
        //         $pre12 = $this->getPre12();
        //         $result->bindParam(":pre12", $pre12);
        //         $pre13 = $this->getPre13();
        //         $result->bindParam(":pre13", $pre13);
        //         $pre14 = $this->getPre14();
        //         $result->bindParam(":pre14", $pre14);
        //         $pre15 = $this->getPre15();
        //         $result->bindParam(":pre15", $pre15);
        //         $nomsec4 = $this->getNomsec4();
        //         $result->bindParam(":nomsec4", $nomsec4);                
        //         $pre16 = $this->getPre16();
        //         $result->bindParam(":pre16", $pre16);
        //         $pre17 = $this->getPre17();
        //         $result->bindParam(":pre17", $pre17);
        //         $pre18 = $this->getPre18();
        //         $result->bindParam(":pre18", $pre18);
        //         $pre19 = $this->getPre19();
        //         $result->bindParam(":pre19", $pre19);
        //         $pre20 = $this->getPre20();
        //         $result->bindParam(":pre20", $pre20);
        //         $nomsec5 = $this->getNomsec5();
        //         $result->bindParam(":nomsec5", $nomsec5);
        //         $pre21 = $this->getPre21();
        //         $result->bindParam(":pre21", $pre21);
        //         $pre22 = $this->getPre22();
        //         $result->bindParam(":pre22", $pre22);
        //         $pre23 = $this->getPre23();
        //         $result->bindParam(":pre23", $pre23);
        //         $pre24 = $this->getPre24();
        //         $result->bindParam(":pre24", $pre24);
        //         $pre25 = $this->getPre25();
        //         $result->bindParam(":pre25", $pre25);
        //         $porjef = $this->getPorjef();
        //         $result->bindParam(":porjef", $porjef);
        //         $porpar = $this->getPorpar();
        //         $result->bindParam(":porpar", $porpar);
        //         $poraut = $this->getPoraut();
        //         $result->bindParam(":poraut", $poraut); 
        //         $porsub = $this->getPorsub();
        //         $result->bindParam(":porsub", $porsub);  
        //         $actfor = $this->getActfor();
        //         $result->bindParam(":actfor", $actfor);   
        //         $result->execute();
        //     } catch (Exception $e) {
        //         ManejoError($e);
        //     }
        // }

        // function editAct(){
        //     try{
        //         $sql = "UPDATE formato SET actfor=:actfor WHERE idfor=:idfor";
        //         $modelo = new conexion();
        //         $conexion = $modelo->get_conexion();
        //         $result = $conexion->prepare($sql);
        //         $idfor = $this->getIdfor();
        //         $result->bindParam(":idfor",$idfor);
        //         $actfor = $this->getActfor();
        //         $result->bindParam(":actfor", $actfor);
        //         $result->execute();
        //     }catch(Exception $e){
        //         ManejoError($e);
        //     }
        // }

        // function del(){
        //     try{
        //         $sql = "DELETE FROM formato WHERE idfor=:idfor";
        //         $modelo = new conexion();
        //         $conexion = $modelo->get_conexion();
        //         $result = $conexion->prepare($sql);
        //         $idfor = $this->getIdfor();
        //         $result->bindParam(":idfor",$idfor);
        //         $result->execute();
        //     }catch(Exception $e){
        //         ManejoError($e);
        //     }
        // }

        function getPer($sel, $id){
            // $sql ="SELECT p.idper, CONCAT(p.nomper,' ', p.apeper) AS nomper FROM jefxper AS jp INNER JOIN persona AS p ON jp.idper=p.idper INNER JOIN persona AS j ON jp.idjef=j.idper WHERE j.actper=1 AND jp.idper=:id";
            $sql ="SELECT p.idper, CONCAT(p.nomper,' ', p.apeper) AS nomper FROM persona AS p WHERE p.actper=1";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            // $result->bindParam(":id",$id);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getRxE($ideva){
            $sql ="SELECT COUNT(ideva) AS can FROM respuesta WHERE ideva=:ideva";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":ideva",$ideva);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>