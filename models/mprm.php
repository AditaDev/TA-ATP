<?php
    class Mprm{
        private $idprm;
        private $noprm;
        private $fecini;
        private $fecfin;
        private $idjef;
        private $idvtprm;
        private $sptrut;
        private $desprm;
        private $obsprm;
        private $estprm;
        private $idper;
        private $fecsol;
        private $fecrev;
        private $idrev;
        private $rutpdf;

        private $ndper;
        

        public function getIdprm(){
            return $this->idprm;
        }
        public function getNoprm(){
            return $this->noprm;
        }
        public function getFecini(){
            return $this->fecini;
        }
        public function getFecfin(){
            return $this->fecfin;
        }
        public function getIdjef(){
            return $this->idjef;
        }
        public function getIdvtprm(){
            return $this->idvtprm;
        }
        public function getSptrut(){
            return $this->sptrut;
        }
        public function getDesprm(){
            return $this->desprm;
        }
        public function getObsprm(){
            return $this->obsprm;
        }
        public function getEstprm(){
            return $this->estprm;
        }
        public function getIdper(){
            return $this->idper;
        }
        public function getFecsol(){
            return $this->fecsol;
        }
        public function getFecrev(){
            return $this->fecrev;
        }
        public function getIdrev(){
            return $this->idrev;
        }
        public function getRutpdf(){
            return $this->rutpdf;
        }

        public function getNdper(){
            return $this->ndper;
        }


        public function setIdprm($idprm){
            $this->idprm=$idprm;
        }
        public function setNoprm($noprm){
            $this->noprm=$noprm;
        }
        public function setFecini($fecini){
            $this->fecini=$fecini;
        }
        public function setFecfin($fecfin){
            $this->fecfin=$fecfin;
        }
        public function setIdjef($idjef){
            $this->idjef=$idjef;
        }
        public function setIdvtprm($idvtprm){
            $this->idvtprm=$idvtprm;
        }
        public function setSptrut($sptrut){
            $this->sptrut=$sptrut;
        }
        public function setDesprm($desprm){
            $this->desprm=$desprm;
        }
        public function setObsprm($obsprm){
            $this->obsprm=$obsprm;
        }
        public function setEstprm($estprm){
            $this->estprm=$estprm;
        }
        public function setIdper($idper){
            $this->idper=$idper;
        }
        public function setFecsol($fecsol){
            $this->fecsol=$fecsol;
        }
        public function setFecrev($fecrev){
            $this->fecrev=$fecrev;
        }
        public function setIdrev($idrev){
            $this->idrev=$idrev;
        }
        public function setRutpdf($rutpdf){
            $this->rutpdf=$rutpdf;
        }

        public function setNdper($ndper){
            $this->ndper=$ndper;
        }

        function getAll($id){
            $fecini = $this->getFecini();
            $fecfin = $this->getFecfin();
            $ndper = $this->getNdper();
            $idvtprm = $this->getIdvtprm();
            $estprm = $this->getEstprm();
            $sql ="SELECT r.idprm, r.noprm, r.fecini, r.fecfin, r.idvtprm, r.rutpdf, DATE_FORMAT(r.fecini, '%e de %M de %Y') AS fini, DATE_FORMAT(r.fecini, '%h:%i %p') AS hini, DATE_FORMAT(r.fecfin, '%e de %M de %Y') AS ffin, DATE_FORMAT(r.fecfin, '%h:%i %p') AS hfin, r.sptrut, r.desprm, r.obsprm, r.estprm, r.fecsol, r.fecrev,
    -- Ajuste de duración con condiciones
    FLOOR((TIME_TO_SEC(TIMEDIFF(r.fecfin, r.fecini)) - 
    CASE 
        WHEN (HOUR(r.fecini) < 14 AND HOUR(r.fecfin) > 13) THEN TIME_TO_SEC('1:00:00') 
        ELSE 0 
    END) / TIME_TO_SEC('8:30:00')) AS ddif, 
    SEC_TO_TIME((TIME_TO_SEC(TIMEDIFF(r.fecfin, r.fecini)) - 
    CASE 
        WHEN (HOUR(r.fecini) < 14 AND HOUR(r.fecfin) > 13) THEN TIME_TO_SEC('1:00:00') 
        ELSE 0 
    END) % TIME_TO_SEC('8:30:00')) AS hdif, DATE_FORMAT(r.fecsol, '%e de %M de %Y') AS fsol, DATE_FORMAT(r.fecrev, '%e de %M de %Y') AS frev, vt.nomval AS tprm, pp.idper AS iper, pp.nomper AS nper, pp.apeper AS aper, pp.ndper AS dper, pp.emaper AS eper, vap.nomval AS cper, pj.idper AS ijef, pj.nomper AS njef, pj.apeper AS ajef, pj.ndper AS djef, pj.emaper AS ejef, vaj.nomval AS cjef, pr.idper AS irev, pr.nomper AS nrev, pr.apeper AS arev, pr.ndper AS drev, pr.emaper AS erev, var.nomval AS crev FROM permiso AS r INNER JOIN persona AS pp ON r.idper = pp.idper INNER JOIN persona AS pj ON r.idjef = pj.idper LEFT JOIN persona AS pr ON r.idrev = pr.idper INNER JOIN valor AS vt ON r.idvtprm = vt.idval INNER JOIN valor AS vap ON pp.area = vap.idval INNER JOIN valor AS vaj ON pp.area = vaj.idval INNER JOIN valor AS var ON pp.area = var.idval";
            if($id=="prop") $sql .= " WHERE r.idper=:id";
            if($id=="rrhhf") $sql .= " WHERE r.estprm=3 OR r.estprm=4";
            if($id=="rrhhp") $sql .= " WHERE r.estprm=2";
            if($id=="rrhhx") $sql .= " WHERE r.estprm=3 AND (r.idvtprm=41 OR r.idvtprm=42 OR r.idvtprm=43 OR r.idvtprm=44 OR r.idvtprm=48)";
            if($id==$_SESSION['idper']) $sql .= " WHERE r.idjef=:id AND r.estprm!=1";
            if($id=="bus"){
                $sql .= " WHERE (r.estprm=3 OR r.estprm=4)";
                if($fecini) $sql .= " AND DATE(r.fecini)>=:fecini";
		        if($fecfin) $sql .= " AND DATE(r.fecini)<=:fecfin";
		        if($ndper) $sql .= " AND pp.ndper LIKE CONCAT('%', :ndper, '%')";
		        if($idvtprm) $sql .= " AND r.idvtprm=:idvtprm";
		        if($estprm) $sql .= " AND r.estprm=:estprm";
                $sql .= " ORDER BY r.fecini ASC";
            }
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            if($id=="prop") $result->bindParam(":id", $_SESSION['idper']);
            if($id==$_SESSION['idper']) $result->bindParam(":id", $id);
            if($id=="bus"){
                if($fecini) $result->bindParam(":fecini", $fecini);
		        if($fecfin) $result->bindParam(":fecfin", $fecfin);
		        if($ndper) $result->bindParam(":ndper", $ndper);
		        if($idvtprm) $result->bindParam(":idvtprm", $idvtprm);
		        if($estprm) $result->bindParam(":estprm", $estprm);
            }
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getOne(){
            $sql ="SELECT r.idprm, r.noprm, r.fecini, r.fecfin, r.idvtprm, r.rutpdf, DATE_FORMAT(r.fecini, '%e de %M de %Y') AS fini, DATE_FORMAT(r.fecini, '%h:%i %p') AS hini, DATE_FORMAT(r.fecfin, '%e de %M de %Y') AS ffin, DATE_FORMAT(r.fecfin, '%h:%i %p') AS hfin, r.sptrut, r.desprm, r.obsprm, r.estprm, r.fecsol, r.fecrev,
    -- Ajuste de duración con condiciones
    FLOOR((TIME_TO_SEC(TIMEDIFF(r.fecfin, r.fecini)) - 
    CASE 
        WHEN (HOUR(r.fecini) < 14 AND HOUR(r.fecfin) > 13) THEN TIME_TO_SEC('1:00:00') 
        ELSE 0 
    END) / TIME_TO_SEC('8:30:00')) AS ddif, 
    SEC_TO_TIME((TIME_TO_SEC(TIMEDIFF(r.fecfin, r.fecini)) - 
    CASE 
        WHEN (HOUR(r.fecini) < 14 AND HOUR(r.fecfin) > 13) THEN TIME_TO_SEC('1:00:00') 
        ELSE 0 
    END) % TIME_TO_SEC('8:30:00')) AS hdif, DATE_FORMAT(r.fecsol, '%e de %M de %Y') AS fsol, DATE_FORMAT(r.fecrev, '%e de %M de %Y') AS frev, vt.nomval AS tprm, pp.idper AS iper, pp.nomper AS nper, pp.apeper AS aper, pp.ndper AS dper, pp.emaper AS eper, vap.nomval AS cper, pj.idper AS ijef, pj.nomper AS njef, pj.apeper AS ajef, pj.ndper AS djef, pj.emaper AS ejef, vaj.nomval AS cjef, pr.idper AS irev, pr.nomper AS nrev, pr.apeper AS arev, pr.ndper AS drev, pr.emaper AS erev, var.nomval AS crev FROM permiso AS r INNER JOIN persona AS pp ON r.idper = pp.idper INNER JOIN persona AS pj ON r.idjef = pj.idper LEFT JOIN persona AS pr ON r.idrev = pr.idper INNER JOIN valor AS vt ON r.idvtprm = vt.idval INNER JOIN valor AS vap ON pp.area = vap.idval INNER JOIN valor AS vaj ON pp.area = vaj.idval INNER JOIN valor AS var ON pp.area = var.idval WHERE r.idprm=:idprm";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $conexion->query("SET lc_time_names = 'es_ES';");
            $result = $conexion->prepare($sql);
            $idprm = $this->getIdprm();
            $result->bindParam(":idprm", $idprm);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function save(){
            try{
                $sptrut = $this->getSptrut();
                $sql = "INSERT INTO permiso (fecini, fecfin, idjef, idvtprm,";
                if($sptrut) $sql .= " sptrut,";
                $sql .= " desprm, estprm, idper) VALUES (:fecini, :fecfin, :idjef, :idvtprm,";
                if($sptrut) $sql .= " :sptrut,";
                $sql .= " :desprm, :estprm, :idper)";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $fecini = $this->getFecini();
                $result->bindParam(":fecini", $fecini);
                $fecfin = $this->getFecfin();
                $result->bindParam(":fecfin", $fecfin);
                $idjef = $this->getIdjef();
                $result->bindParam(":idjef", $idjef);
                $idvtprm = $this->getIdvtprm();
                $result->bindParam(":idvtprm", $idvtprm);
                if($sptrut) $result->bindParam(":sptrut", $sptrut);
                $desprm = $this->getDesprm();
                $result->bindParam(":desprm", $desprm);
                $estprm = $this->getEstprm();
                $result->bindParam(":estprm", $estprm);
                $idper = $this->getIdper();
                $result->bindParam(":idper", $idper);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function edit(){
            try{
                $sptrut = $this->getSptrut();
                $sql = "UPDATE permiso SET fecini=:fecini, fecfin=:fecfin, idjef=:idjef, idvtprm=:idvtprm,";
                if($sptrut) $sql .= " sptrut=:sptrut,";
                $sql .= " desprm=:desprm, estprm=:estprm, idper=:idper WHERE idprm=:idprm";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idprm = $this->getIdprm();
                $result->bindParam(":idprm", $idprm);
                $fecini = $this->getFecini();
                $result->bindParam(":fecini", $fecini);
                $fecfin = $this->getFecfin();
                $result->bindParam(":fecfin", $fecfin);
                $idjef = $this->getIdjef();
                $result->bindParam(":idjef", $idjef);
                $idvtprm = $this->getIdvtprm();
                $result->bindParam(":idvtprm", $idvtprm);
                if($sptrut) $result->bindParam(":sptrut", $sptrut);
                $desprm = $this->getDesprm();
                $result->bindParam(":desprm", $desprm);
                $estprm = $this->getEstprm();
                $result->bindParam(":estprm", $estprm);
                $idper = $this->getIdper();
                $result->bindParam(":idper", $idper);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function editAct(){
            try{
                $estprm = $this->getEstprm();
                $sql = "UPDATE permiso SET estprm=:estprm";
                if($estprm==2) $sql .= ", fecsol=:fecsol";
                if($estprm==3 || $estprm==4){ 
                    $sql .= ", fecrev=:fecrev, idrev=:idrev";
                    if($estprm==3) $sql .= ", noprm=:noprm";
                    else $sql .= ", obsprm=:obsprm";
                }
                $sql .= " WHERE idprm=:idprm";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idprm = $this->getIdprm();
                $result->bindParam(":idprm", $idprm);
                $result->bindParam(":estprm", $estprm);
                if($estprm==2){
                    $fecsol = $this->getFecsol();
                    $result->bindParam(":fecsol", $fecsol);
                }
                if($estprm==3 || $estprm==4){
                    $fecrev = $this->getFecrev();
                    $result->bindParam(":fecrev", $fecrev);
                    $idrev = $this->getIdrev();
                    $result->bindParam(":idrev", $idrev);
                    if($estprm==3){
                        $noprm = $this->getNoprm();
                        $result->bindParam(":noprm", $noprm);
                    }else{ 
                        $obsprm = $this->getObsprm();
                        $result->bindParam(":obsprm", $obsprm);
                }}
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function savePdf(){
            try{
                $sql = "UPDATE permiso SET rutpdf=:rutpdf WHERE idprm=:idprm";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idprm = $this->getIdprm();
                $result->bindParam(":idprm",$idprm);
                $rutpdf = $this->getRutpdf();
                $result->bindParam(":rutpdf", $rutpdf);
                $result->execute();
            } catch (Exception $e) {
                ManejoError($e);
            }
        }

        function del(){
            try{
                $sql = "DELETE FROM permiso WHERE idprm=:idprm";
                $modelo = new conexion();
                $conexion = $modelo->get_conexion();
                $result = $conexion->prepare($sql);
                $idprm = $this->getIdprm();
                $result->bindParam(":idprm", $idprm);
                $result->execute();
            }catch(Exception $e){
                ManejoError($e);
            }
        }

        function getAllDom($id){
            $sql = "SELECT idval, nomval FROM valor WHERE iddom=:id";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":id", $id);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllPer(){
            $sql = "SELECT j.idper, CONCAT(j.nomper,' ', j.apeper) AS nomjef FROM jefxper AS jp INNER JOIN persona AS p ON jp.idper=p.idper INNER JOIN persona AS j ON jp.idjef=j.idper WHERE j.actper=1 AND jp.idper=:id";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":id", $_SESSION['idper']);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getPdf($arc){
            $sql = "SELECT";
            if($arc=="spt") $sql .= " sptrut";
            elseif($arc=="pdf") $sql .= " rutpdf";
            $sql .= " AS rut FROM permiso WHERE idprm=:idprm";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idprm = $this->getIdprm();
            $result->bindParam(":idprm", $idprm);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }

        function getAllGraf(){
            $fecini = $this->getFecini();
            $fecfin = $this->getFecfin();
            $idvtprm = $this->getIdvtprm();
            $estprm = $this->getEstprm();
            $sql = "SELECT t.nomval AS tipo, COUNT(r.idvtprm) AS cant, DATE_FORMAT(r.fecini, '%Y-%m') AS periodo FROM permiso AS r INNER JOIN valor AS t ON r.idvtprm=t.idval WHERE (r.estprm=3 OR r.estprm=4)";
            // Filtros adicionales
            if($fecini) $sql .= " AND DATE(r.fecini)>=:fecini";
            if($fecfin) $sql .= " AND DATE(r.fecini)<=:fecfin";
            if($idvtprm) $sql .= " AND r.idvtprm=:idvtprm";
            if($estprm) $sql .= " AND r.estprm=:estprm";
            $sql .= " GROUP BY t.idval, t.nomval, DATE_FORMAT(r.fecini, '%Y-%m') ORDER BY periodo, t.nomval";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            // Vincular parámetros
            if($fecini) $result->bindParam(":fecini", $fecini);
            if($fecfin) $result->bindParam(":fecfin", $fecfin);
            if($idvtprm) $result->bindParam(":idvtprm", $idvtprm);
            if($estprm) $result->bindParam(":estprm", $estprm);
            $result->execute();
            $res = $result->fetchall(PDO::FETCH_ASSOC);
            return $res;
        }
        
    }
?>