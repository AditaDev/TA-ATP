<?php
    class Mfor{

        private $idfor;
        private $nomfor;
        private $codfor;
        private $fecfor;
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
        private $porjef;
        private $porpar;
        private $poraut;
        private $porsub;
        private $actfor;


        public function getIdfor(){
            return $this->idfor;
        }
        public function getNomfor(){
            return $this->nomfor;
        }
        public function getCodfor(){
            return $this->codfor;
        }
        public function getFecfor(){
            return $this->fecfor;
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
        public function getPorjef(){
            return $this->porjef;
        }
        public function getPorpar(){
            return $this->porpar;
        }
        public function getPoraut(){
            return $this->poraut;
        }
        public function getPorsub(){
            return $this->porsub;
        }
        public function getActfor(){
            return $this->actfor;
        }
       

        public function setIdfor($idfor){
            $this->idfor=$idfor;
        }
        public function setNomfor($nomfor){
            $this->nomfor=$nomfor;
        }
        public function setCodfor($codfor){
            $this->codfor=$codfor;
        }
        public function setFecfor($fecfor){
            $this->fecfor=$fecfor;
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
        public function setPorjef($porjef){
            $this->porjef=$porjef;
        }
        public function setPorpar($porpar){
            $this->porpar=$porpar;
        }
        public function setPoraut($poraut){
            $this->poraut=$poraut;
        }
        public function setPorsub($porsub){
            $this->porsub=$porsub;
        }
        public function setActfor($actfor){
            $this->actfor=$actfor;
        }


        function getAll(){
            $sql = "SELECT idfor, nomfor, codfor, fecfor, pre1, pre2, pre3, pre4, pre5, pre6, pre7, pre8, pre9, pre10, pre11, pre12, pre13, pre14, pre15, porjef, porpar, poraut, porsub, actfor FROM formato";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOne(){
            $sql = "SELECT idfor, nomfor, codfor, fecfor, pre1, pre2, pre3, pre4, pre5, pre6, pre7, pre8, pre9, pre10, pre11, pre12, pre13, pre14, pre15, porjef, porpar, poraut, porsub, actfor FROM formato WHERE idfor=:idfor";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idfor = $this->getIdfor();
            $result->bindParam(":idfor", $idfor);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function save(){
            try {
                $sql = "INSERT INTO formato (nomfor, codfor, fecfor, pre1, pre2, pre3, pre4, pre5, pre6, pre7, pre8, pre9, pre10, pre11, pre12, pre13, pre14, pre15, porjef, porpar, poraut, porsub, actfor) VALUES (:nomfor, :codfor, :fecfor, :pre1, :pre2, :pre3, :pre4, :pre5, :pre6, :pre7, :pre8, :pre9, :pre10, :pre11, :pre12, :pre13, :pre14, :pre15, :porjef, :porpar, :poraut, :porsub, :actfor)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $nomfor = $this->getNomfor();
                $result->bindParam(":nomfor", $nomfor);
                $codfor = $this->getCodfor();
                $result->bindParam(":codfor", $codfor);
                $fecfor = $this->getFecfor();
                $result->bindParam(":fecfor", $fecfor);
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
                $pre13 = $this->getPre13();
                $result->bindParam(":pre13", $pre13);
                $pre14 = $this->getPre14();
                $result->bindParam(":pre14", $pre14);
                $pre15 = $this->getPre15();
                $result->bindParam(":pre15", $pre15);
                $porjef = $this->getPorjef();
                $result->bindParam(":porjef", $porjef);
                $porpar = $this->getPorpar();
                $result->bindParam(":porpar", $porpar);
                $poraut = $this->getPoraut();
                $result->bindParam(":poraut", $poraut); 
                $porsub = $this->getPorsub();
                $result->bindParam(":porsub", $porsub);  
                $actfor = $this->getActfor();
                $result->bindParam(":actfor", $actfor);  
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function edit(){
            // try {
                $sql = "UPDATE formato SET nomfor=:nomfor, codfor=:codfor, fecfor=:fecfor, pre1=:pre1, pre2=:pre2, pre3=:pre3, pre4=:pre4, pre5=:pre5, pre6=:pre6, pre7=:pre7, pre8=:pre8, pre9=:pre9, pre10=:pre10, pre11=:pre11, pre12=:pre12, pre13=:pre13, pre14=:pre14, pre15=:pre15, porjef=:porjef, porpar=:porpar, poraut=:poraut, porsub=:porsub, actfor=:actfor WHERE idfor=:idfor";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idfor = $this->getIdfor();
                $result->bindParam(":idfor", $idfor);
                $nomfor = $this->getNomfor();
                $result->bindParam(":nomfor", $nomfor);
                $codfor = $this->getCodfor();
                $result->bindParam(":codfor", $codfor);
                $fecfor = $this->getFecfor();
                $result->bindParam(":fecfor", $fecfor);
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
                $pre13 = $this->getPre13();
                $result->bindParam(":pre13", $pre13);
                $pre14 = $this->getPre14();
                $result->bindParam(":pre14", $pre14);
                $pre15 = $this->getPre15();
                $result->bindParam(":pre15", $pre15);
                $porjef = $this->getPorjef();
                $result->bindParam(":porjef", $porjef);
                $porpar = $this->getPorpar();
                $result->bindParam(":porpar", $porpar);
                $poraut = $this->getPoraut();
                $result->bindParam(":poraut", $poraut); 
                $porsub = $this->getPorsub();
                $result->bindParam(":porsub", $porsub);  
                $actfor = $this->getActfor();
                $result->bindParam(":actfor", $actfor);     
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }

        function editAct(){
            // try{
                $sql = "UPDATE formato SET actfor=:actfor WHERE idfor=:idfor";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idfor = $this->getIdfor();
                $result->bindParam(":idfor",$idfor);
                $actfor = $this->getActfor();
                $result->bindParam(":actfor", $actfor);
                $result->execute();
            // }catch(Exception $e){
            //     ManejoError($e);
            // }
        }

        function del(){
            // try{
                $sql = "DELETE FROM formato WHERE idfor=:idfor";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idfor = $this->getIdfor();
                $result->bindParam(":idfor",$idfor);
                $result->execute();
            // }catch(Exception $e){
            //     ManejoError($e);
            // }
        }

        function getFxP($idfor){
            $sql ="SELECT COUNT(idfor) AS can FROM persona WHERE idfor=:idfor";
            $modelo =new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idfor",$idfor);
            $result->execute();
            $res = $result-> fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
    }
?>