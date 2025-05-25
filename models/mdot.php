<?php
    class Mdot{

        //------------Dotacion-----------
        private $ident;
        private $idperent;
        private $idperrec;
        private $fecent;
        private $observ;
        private $estent;
        private $firpent;
        private $firprec;
        private $idperentd;
        private $idperrecd;
        private $fecdev;
        private $observd;
        private $difent;
        private $rutpdf;

        private $firma;

        private $ndper;

        //------------DotxEnt-----------

        private $idvdot; 
        private $idvtal;
        private $cant;

         //------------CCxEnt-----------

         private $idvdia; 
         private $idvcol;

        //------------Dotacion-----------
         public function getIdent(){
            return $this->ident;
        }
        public function getIdperent(){
            return $this->idperent;
        }
        public function getIdperrec(){
            return $this->idperrec;
        }
        public function getFecent(){
            return $this->fecent;
        }
        public function getObserv(){
            return $this->observ;
        }
        public function getFirpent(){
            return $this->firpent;
        }
        public function getFirprec(){
            return $this->firprec;
        }
        public function getDifent(){
            return $this->difent;
        }
        public function getEstent(){
            return $this->estent;
        }
        public function getIdperentd(){
            return $this->idperentd;
        }
        public function getIdperrecd(){
            return $this->idperrecd;
        }
        public function getFecdev(){
            return $this->fecdev;
        }
        public function getObservd(){
            return $this->observd;
        }
        public function getRutpdf(){
            return $this->rutpdf;
        }


        public function getFirma(){
            return $this->firma;
        }

        public function getNdper(){
            return $this->ndper;
        }

        //------------DotxEnt-----------
        public function getIdvdot(){
            return $this->idvdot;
        }
        public function getIdvtal(){
            return $this->idvtal;
        }
        public function getCant(){
            return $this->cant;
        }

         //------------CCxEnt-----------
         public function getIdvdia(){
            return $this->idvdia;
        }
        public function getIdvcol(){
            return $this->idvcol;
        }

        //---------Dotacion---------------
        public function setIdent($ident){
            $this->ident=$ident;
        }
        public function setIdperent($idperent){
            $this->idperent=$idperent;
        }
        public function setIdperrec($idperrec){
            $this->idperrec=$idperrec;
        }
        public function setFecent($fecent){
            $this->fecent=$fecent;
        }
        public function setObserv($observ){
            $this->observ=$observ;
        }
        public function setFirpent($firpent){
            $this->firpent=$firpent;
        }
        public function setfirprec($firprec){
            $this->$firprec=$firprec;
        }
        public function setDifent($difent){
            $this->difent=$difent;
        }
        public function setIdperentd($idperentd){
            $this->idperentd=$idperentd;
        }
        public function setIdperrecd($idperrecd){
            $this->idperrecd=$idperrecd;
        }
        public function setFecdev($fecdev){
            $this->fecdev=$fecdev;
        }
        public function setObservd($observd){
            $this->observd=$observd;
        }
        public function setRutpdf($rutpdf){
            $this->rutpdf=$rutpdf;
        }

        public function setFirma($firma){
            $this->firma=$firma;
        }

        public function setNdper($ndper){
            $this->ndper = $ndper;
        }
        public function setEstent($estent){
            $this->estent = $estent;
        }

        //------------DotxEnt-----------
        public function setIdvdot($idvdot){
            $this->idvdot = $idvdot;
        }
        public function setIdvtal($idvtal){
            $this->idvtal = $idvtal;
        }
        public function setCant($cant){
            $this->cant = $cant;
        }

        //------------CCxEnt-----------
        public function setIdvdia($idvdia){
            $this->idvdia = $idvdia;
        }
        public function setIdvcol($idvcol){
            $this->idvcol = $idvcol;
        }
        
        //------------Dotacion-----------

        function getAllD(){
            $sql = "SELECT d.ident, d.fecent, d.fecdev, d.observ, d.observd, d.firpent, d.firprec, d.difent, d.estent, d.rutpdf, d.idperent AS pent, CONCAT(pe.nomper,' ',pe.apeper) AS nompent, pe.ndper AS dpent, pe.emaper AS epent, ve.nomval AS apent, d.idperrec AS prec, CONCAT(pr.nomper,' ',pr.apeper) AS nomprec, pr.ndper AS dprec, pr.emaper AS eprec, vr.nomval AS aprec, d.idperentd AS pentd, CONCAT(ped.nomper,' ',ped.apeper) AS nompentd, ped.ndper AS dpentd, ped.emaper AS epentd, ved.nomval AS apentd, d.idperrecd AS precd, CONCAT(prd.nomper,' ',prd.apeper) AS nomprecd, prd.ndper AS dprecd, prd.emaper AS eprecd, vrd.nomval AS aprecd FROM dotacion AS d LEFT JOIN persona AS pe ON d.idperent=pe.idper LEFT JOIN persona AS pr ON d.idperrec=pr.idper LEFT JOIN persona AS ped ON d.idperentd=ped.idper LEFT JOIN persona AS prd ON d.idperrecd=prd.idper LEFT JOIN valor AS ve ON pe.area=ve.idval LEFT JOIN valor AS vr ON pr.area=vr.idval LEFT JOIN valor AS ved ON ped.area=ved.idval LEFT JOIN valor AS vrd ON prd.area=vrd.idval";
                    $modelo = new conexion();
                    $conexion = $modelo->get_conexion();
                    $result = $conexion->prepare($sql);
                    $result->execute();
                    $res = $result->fetchall(PDO::FETCH_ASSOC);
                    return $res;
        }

        function getOne(){
            $sql = "SELECT d.ident, d.fecent, d.fecdev, d.observ, d.observd, d.firpent, d.firprec, d.difent, d.estent, d.rutpdf, d.idperent AS pent, CONCAT(pe.nomper,' ',pe.apeper) AS nompent, pe.ndper AS dpent, pe.emaper AS epent, ve.nomval AS apent, d.idperrec AS prec, CONCAT(pr.nomper,' ',pr.apeper) AS nomprec, pr.ndper AS dprec, pr.emaper AS eprec, vr.nomval AS aprec, d.idperentd AS pentd, CONCAT(ped.nomper,' ',ped.apeper) AS nompentd, ped.ndper AS dpentd, ped.emaper AS epentd, ved.nomval AS apentd, d.idperrecd AS precd, CONCAT(prd.nomper,' ',prd.apeper) AS nomprecd, prd.ndper AS dprecd, prd.emaper AS eprecd, vrd.nomval AS aprecd FROM dotacion AS d LEFT JOIN persona AS pe ON d.idperent=pe.idper LEFT JOIN persona AS pr ON d.idperrec=pr.idper LEFT JOIN persona AS ped ON d.idperentd=ped.idper LEFT JOIN persona AS prd ON d.idperrecd=prd.idper LEFT JOIN valor AS ve ON pe.area=ve.idval LEFT JOIN valor AS vr ON pr.area=vr.idval LEFT JOIN valor AS ved ON ped.area=ved.idval LEFT JOIN valor AS vrd ON prd.area=vrd.idval WHERE d.ident=:ident";
                    $modelo = new conexion();
                    $conexion = $modelo->get_conexion();
                    $result = $conexion->prepare($sql);
                    $ident = $this->getIdent();
                    $result->bindParam(":ident",$ident);
                    $result->execute();
                    $res = $result->fetchall(PDO::FETCH_ASSOC);
                    return $res;
        }

        function save(){
            // try{
                $sql = "INSERT INTO dotacion (idperent, idperrec, fecent, observ, estent, difent) VALUES (:idperent, :idperrec, :fecent, :observ, :estent, :difent)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idperent = $_SESSION['idper'];
                $result->bindParam(":idperent", $idperent);
                $idperrec = $this->getIdperrec();
                $result->bindParam(":idperrec", $idperrec);
                $fecent = $this->getFecent();
                $result->bindParam(":fecent", $fecent);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);
                $estent = $this->getEstent();
                $result->bindParam(":estent", $estent);
                $difent = $this->getDifent();
                $result->bindParam(":difent", $difent);
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }

        function edit(){
            try {
                $sql = "UPDATE dotacion SET observ=:observ WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $observ = $this->getObserv();
                $result->bindParam(":observ", $observ);           
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function saveFir($fir){
            try{
                $sql = "UPDATE dotacion SET";
                if($fir==1) $sql .= " firpent=:firma";
                if($fir==2) $sql .= " firprec=:firma";
                $sql .= " WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident",$ident);
                $firma = $this->getFirma();
                $result->bindParam(":firma", $firma);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function savePdf(){
            try{
                $sql = "UPDATE dotacion SET rutpdf=:rutpdf WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident",$ident);
                $rutpdf = $this->getRutpdf();
                $result->bindParam(":rutpdf", $rutpdf);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function getPdf(){
            $sql = "SELECT rutpdf AS rut FROM dotacion WHERE ident=:ident";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $ident = $this->getIdent();
            $result->bindParam(":ident", $ident);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function dev(){
            //try{
                $sql = "UPDATE dotacion SET idperentd=:idperentd, idperrecd=:idperrecd, fecdev=:fecdev, observd=:observd, estent=:estent WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $idperentd = $this->getIdperentd();
                $result->bindParam(":idperentd", $idperentd);
                $idperrecd = $this->getIdperrecd();
                $result->bindParam(":idperrecd", $idperrecd);
                $fecdev = $this->getFecdev();
                $result->bindParam(":fecdev", $fecdev);
                $observd = $this->getObservd();
                $result->bindParam(":observd", $observd);
                $estent = $this->getEstent();
                $result->bindParam(":estent", $estent);
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }

    //------------Elementos x dotacion-----------

        function getAllTxD($ident){
            $sql = "SELECT de.idvdot, v.nomval AS nomvdot, vv.nomval AS nomvtal, de.idvtal, de.cant FROM dotxent AS de INNER JOIN valor AS v ON de.idvdot=v.idval INNER JOIN valor AS vv ON de.idvtal=vv.idval WHERE ident=:ident";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":ident", $ident);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function saveExD() 
        {
            // try{
                $sql = "INSERT INTO dotxent (ident, idvdot, idvtal, cant) VALUES (:ident, :idvdot, :idvtal, :cant)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $idvdot = $this->getIdvdot();
                $result->bindParam(":idvdot", $idvdot);
                $idvtal = $this->getIdvtal();
                $result->bindParam(":idvtal", $idvtal);
                $cant = $this->getCant();
                $result->bindParam(":cant", $cant); 
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }


        function delExD()
        {
            try{
                $sql = "DELETE FROM dotxent WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }


         //------------Color x Camisa-----------

         function getAllCxc($ident){
            $sql = "SELECT de.idvdia, v.nomval AS nomvdia, vv.nomval AS nomvcol, de.idvcol FROM ccxent AS de INNER JOIN valor AS v ON de.idvdia=v.idval INNER JOIN valor AS vv ON de.idvcol=vv.idval WHERE ident=:ident";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":ident", $ident);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function saveCxc() 
        {
            // try{
                $sql = "INSERT INTO ccxent (ident, idvdia, idvcol) VALUES (:ident, :idvdia, :idvcol)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $idvdia = $this->getIdvdia();
                $result->bindParam(":idvdia", $idvdia);
                $idvcol = $this->getIdvcol();
                $result->bindParam(":idvcol", $idvcol);
                $result->execute();
            // } catch (Exception $e) {
            //     ManejoError($e);
            // }
        }

        function delCxc()
        {
            try{
                $sql = "DELETE FROM ccxent WHERE ident=:ident";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $ident = $this->getIdent();
                $result->bindParam(":ident", $ident);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
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

        function getOneAsg($difent)
        {
            $sql = "SELECT ident FROM dotacion WHERE difent=:difent";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":difent", $difent);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllPer($ope){

                    $sql = "SELECT DISTINCT idper, nomper, apeper, ndper FROM persona";
                    if(!$ope) $sql.= " WHERE actper=1";
                    $sql .= " ORDER BY apeper";
                    $modelo = new conexion();
                    $conexion = $modelo->get_conexion();
                    $result = $conexion->prepare($sql);
                    $result->execute();
                    $res = $result->fetchall(PDO::FETCH_ASSOC);
                    return $res;
                 }

    function del(){
        try{
            $sql = "DELETE FROM dotacion WHERE ident=:ident";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion-> prepare($sql);
            $ident = $this->getIdent();
            $result->bindParam(":ident", $ident);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
        }
        

    }
?>