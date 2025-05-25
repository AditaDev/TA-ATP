<?php

    class Mfor{

        private $idres;
        private $idpereval;
        private $idperevald;
        private $tipeva;
        private $pre1;
        private $pre2;
        private $pre3;
        private $pre4;
        private $pre5;
        private $pre6;
        private $pre7;
        private $pre8;
        private $pre9;
        private $pre10;
        private $pre11;
        private $pre12;
        private $pre13;
        private $pre14;
        private $pre15;
        private $fecres;


        public function getIdres(){
            return $this->idres;
        }
        public function getIdpereval(){
            return $this->idpereval;
        }
        public function getIdperevald(){
            return $this->idperevald;
        }
        public function getTipeva(){
            return $this->tipeva;
        }
        public function getPre1(){
            return $this->pre1;
        }
        public function getPre2(){
            return $this->pre2;
        }
        public function getPre3(){
            return $this->pre3;
        }
        public function getPre4(){
            return $this->pre4;
        }
        public function getPre5(){
            return $this->pre5;
        }
        public function getPre6(){
            return $this->pre6;
        }
        public function getPre7(){
            return $this->pre7;
        }
        public function getPre8(){
            return $this->pre8;
        }
        public function getPre9(){
            return $this->pre9;
        }
        public function getPre10(){
            return $this->pre10;
        }
        public function getPre11(){
            return $this->pre11;
        }
        public function getPre12(){
            return $this->pre12;
        }
        public function getPre13(){
            return $this->pre13;
        }
        public function getPre14(){
            return $this->pre14;
        }
        public function getPre15(){
            return $this->pre15;
        }
        public function getFecres(){
            return $this->fecres;
        }
       

        public function setIdres($idres){
            $this->idres=$idres;
        }
        public function setIdpereval($idpereval){
            $this->idpereval=$idpereval;
        }
        public function setIdperevald($idperevald){
            $this->idperevald=$idperevald;
        }
        public function setTipeva($tipeva){
            $this->tipeva=$tipeva;
        }
        public function setPre1($pre1){
            $this->pre1=$pre1;
        }
        public function setPre2($pre2){
            $this->pre2=$pre2;
        }
        public function setPre3($pre3){
            $this->pre3=$pre3;
        }
        public function setPre4($pre4){
            $this->pre4=$pre4;
        }
        public function setPre5($pre5){
            $this->pre5=$pre5;
        }
        public function setPre6($pre6){
            $this->pre6=$pre6;
        }
        public function setPre7($pre7){
            $this->pre7=$pre7;
        }
        public function setPre8($pre8){
            $this->pre8=$pre8;
        }
        public function setPre9($pre9){
            $this->pre9=$pre9;
        }
        public function setPre10($pre10){
            $this->pre10=$pre10;
        }
        public function setPre11($pre11){
            $this->pre11=$pre11;
        }
        public function setPre12($pre12){
            $this->pre12=$pre12;
        }
        public function setPre13($pre13){
            $this->pre13=$pre13;
        }
        public function setPre14($pre14){
            $this->pre14=$pre14;
        }
        public function setPre15($pre15){
            $this->pre15=$pre15;
        }
        public function setFecres($fecres){
            $this->fecres=$fecres;
        }

        //SELECT p.idper, p.nomper, p.apeper FROM persona p LEFT JOIN jefxper j ON p.idper = j.idjef WHERE j.idjef IS NULL;

        function getAll(){
            $sql = "SELECT r.idres, r.idpereval AS peva, CONCAT(pe.nomper, ' ', pe.apeper) AS nompeva, j.idjef AS peval, CONCAT(pj.nomper, ' ', pj.apeper) AS nompeval, r.tipeva, r.pre1, r.pre2, r.pre3, r.pre4, r.pre5, r.pre6, r.pre7, r.pre8, r.pre9, r.pre10, r.pre11, r.pre12, r.pre13, r.pre14, r.pre15, r.fecres FROM respuesta AS r LEFT JOIN persona AS pe ON r.idpereval = pe.idper LEFT JOIN jefxper AS j ON r.idpereval = j.idper LEFT JOIN persona AS pj ON j.idjef = pj.idper";
                    $modelo = new conexion();
                    $conexion = $modelo->get_conexion();
                    $result = $conexion->prepare($sql);
                    $result->execute();
                    $res = $result->fetchall(PDO::FETCH_ASSOC);
                    return $res;
        }



        function save(){
            // try {
                $sql = "INSERT INTO respuesta (idpereval, idperevald, pre1, pre2, pre3, pre4, pre5, pre6, pre7, pre8, pre9, pre10, pre11, pre12, fecres, tipeva) VALUES (:idpereval, :idperevald, :pre1, :pre2, :pre3, :pre4, :pre5, :pre6, :pre7, :pre8, :pre9, :pre10, :pre11, :pre12, :fecres, :tipeva)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idpereval = $this->getIdpereval();
                $result->bindParam(":idpereval", $idpereval);
                $idperevald = $this->getIdperevald();
                $result->bindParam(":idperevald", $idperevald);
                $pre1 = $this->getPre1();
                $result->bindParam(":pre1", $pre1);
                $pre2 = $this->getPre2();
                $result->bindParam(":pre2", $pre2);
                $pre3 = $this->getPre3();
                $result->bindParam(":pre3", $pre3);
                $pre4 = $this->getPre4();
                $result->bindParam(":pre4", $pre4);
                $pre5 = $this->getPre5();
                $result->bindParam(":pre5", $pre5);
                $pre6 = $this->getPre6();
                $result->bindParam(":pre6", $pre6);
                $pre7 = $this->getPre7();
                $result->bindParam(":pre7", $pre7);
                $pre8 = $this->getPre8();
                $result->bindParam(":pre8", $pre8);
                $pre9 = $this->getPre9();
                $result->bindParam(":pre9", $pre9);
                $pre10 = $this->getPre10();
                $result->bindParam(":pre10", $pre10);
                $pre11 = $this->getPre11();
                $result->bindParam(":pre11", $pre11);
                $pre12 = $this->getPre12();
                $result->bindParam(":pre12", $pre12);
                $fecres = $this->getFecres();
                $result->bindParam(":fecres", $fecres); 
                $tipeva = $this->getTipeva();
                $result->bindParam(":tipeva", $tipeva);  
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }

        function edit(){
            //try {
                $sql = "UPDATE respuuestas SET idpereval=:idpereval, idperevald=:idperevald, pre1=:pre1, pre2=:pre2, pre3=:pre3, pre4=:pre4, pre5=:pre5, pre6=:pre6, pre7=:pre7, pre8=:pre8, pre9=:pre9, pre10=:pre10, pre11=:pre11, pre12=:pre12 WHERE idres=:idres";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idres = $this->getIdres();
                $result->bindParam(":idres", $idres);

                $idpereval = $this->getIdpereval();
                $result->bindParam(":idpereval", $idpereval);
                $idperevald = $this->getIdperevald();
                $result->bindParam(":idperevald", $idperevald);
                $pre1 = $this->getPre1();
                $result->bindParam(":pre1", $pre1);
                $pre2 = $this->getPre2();
                $result->bindParam(":pre2", $pre2);
                $pre3 = $this->getPre3();
                $result->bindParam(":pre3", $pre3);
                $pre4 = $this->getPre4();
                $result->bindParam(":pre4", $pre4);
                $pre5 = $this->getPre5();
                $result->bindParam(":pre5", $pre5);
                $pre6 = $this->getPre6();
                $result->bindParam(":pre6", $pre6);
                $pre7 = $this->getPre7();
                $result->bindParam(":pre7", $pre7);
                $pre8 = $this->getPre8();
                $result->bindParam(":pre8", $pre8);
                $pre9 = $this->getPre9();
                $result->bindParam(":pre9", $pre9);
                $pre10 = $this->getPre10();
                $result->bindParam(":pre10", $pre10);
                $pre11 = $this->getPre11();
                $result->bindParam(":pre11", $pre11);
                $pre12 = $this->getPre12();
                $result->bindParam(":pre12", $pre12);       
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }


        //------------Traer valores-----------
        function getAllDom($iddom){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":iddom", $iddom);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }




?>