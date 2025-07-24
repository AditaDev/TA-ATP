<?php
class Mper
{   
    //------------Persona-----------
    private $idper;
    private $nomper;
    private $apeper;
    private $ndper;
    private $area;
    private $cargo;
    private $idvfor;
    private $emaper;
    private $actper;
    private $idval;
    private $nivel;
    private $hash;
    private $salt;
    private $token;
    private $feccam;


    //------------Jefe-----------
    private $idjef;

    //------------Perfil-----------
    private $idpef;

    //------------Persona-----------
    public function getIdper(){
        return $this->idper;
    }
    public function getNomper(){
        return $this->nomper;
    }
    public function getApeper(){
        return $this->apeper;
    }
    public function getNdper(){
        return $this->ndper;
    }
    public function getArea(){
        return $this->area;
    }
    public function getCargo(){
        return $this->cargo;
    }
    public function getIdvfor(){
        return $this->idvfor;
    }
    public function getEmaper(){
        return $this->emaper;
    }
    public function getActper(){
        return $this->actper;
    }
    public function getIdval(){
        return $this->idval;
    }
    public function getNivel(){
        return $this->nivel;
    }
    public function getHash(){
        return $this->hash;
    }
    public function getSalt(){
        return $this->salt;
    }
    public function getToken(){
        return $this->token;
    }
    public function getFeccam(){
        return $this->feccam;
    }
    
    //------------Jefe-----------
    public function getIdjef(){
        return $this->idjef;
    }

    //------------Perfil-----------
    public function getIdpef()
    {
        return $this->idpef;
    }
    //------------Persona-----------
    public function setIdper($idper){
        $this->idper = $idper;
    }
    public function setNomper($nomper){
        $this->nomper = $nomper;
    }
    public function setApeper($apeper){
        $this->apeper = $apeper;
    }
    public function setNdper($ndper){
        $this->ndper = $ndper;
    }
    public function setArea($area){
        $this->area = $area;
    }
    public function setCargo($cargo){
        $this->cargo = $cargo;
    }
    public function setIdvfor($idvfor){
        $this->idvfor = $idvfor;
    }
    public function setEmaper($emaper){
        $this->emaper = $emaper;
    }
    public function setActper($actper){
        $this->actper = $actper;
    }
    public function setIdval($idval){
        $this->idval = $idval;
    }
    public function setNivel($nivel){
        $this->nivel = $nivel;
    }
    public function setHash($hash){
        $this->hash = $hash;
    }
    public function setSalt($salt){
        $this->salt = $salt;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function setFeccam($feccam){
        $this->feccam = $feccam;
    }

    //------------Jefe-----------
    public function setIdjef($idjef){
        $this->idjef = $idjef;
    }

    //------------Perfil-----------
    public function setIdpef($idpef)
    {
        $this->idpef = $idpef;
    }
    //------------Persona-----------
    function getAll()
    {
        $sql = "SELECT p.idper, p.nomper, p.apeper, p.ndper, p.emaper, p.area, p.idvfor, p.cargo, p.actper, p.nivel, va.idval, va.nomval AS area, vf.idval, vf.nomval AS form FROM persona AS p INNER JOIN valor AS va ON p.area=va.idval LEFT JOIN valor AS vf ON p.idvfor=vf.idval";
        if($_SESSION['idpef']==3) $sql .= " WHERE p.idper=:idper ";
        $sql .= " GROUP BY p.idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        if($_SESSION['idpef']==3){
            $idper = $_SESSION['idper'];
            $result->bindParam(":idper", $idper);
        }
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);                                    
        return $res;
    }

    function getOne()
    {
        $sql = "SELECT p.idper, p.nomper, p.apeper, p.ndper, p.emaper, p.area, p.idvfor, p.cargo, p.actper, p.nivel, va.idval, va.nomval AS area, vf.idval, vf.nomval AS form FROM persona AS p INNER JOIN valor AS va ON p.area=va.idval LEFT JOIN valor AS vf ON p.idvfor=vf.idval WHERE p.idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function save()
    {
        try {
            $hash = $this->getHash();
            $salt = $this->getSalt();
            $sql = "INSERT INTO persona(nomper, apeper, ndper, area, idvfor, cargo, emaper, actper, nivel";
            if ($hash) $sql .= ", hashl";
            if ($salt) $sql .= ", salt";
            $sql .= ") VALUES (:nomper, :apeper, :ndper, :area, :idvfor, :cargo, :emaper, :actper, :nivel";
            if ($hash) $sql .= ", :hashl";
            if ($salt) $sql .= ", :salt";
            $sql .= ")";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $nomper = $this->getNomper();
            $result->bindParam(":nomper", $nomper);
            $apeper = $this->getApeper();
            $result->bindParam(":apeper", $apeper);
            $ndper = $this->getNdper();
            $result->bindParam(":ndper", $ndper);
            $area = $this->getArea();
            $result->bindParam(":area", $area);
            $idvfor = $this->getIdvfor();
            $result->bindParam(":idvfor", $idvfor);
            $cargo = $this->getCargo();
            $result->bindParam(":cargo", $cargo);
            $emaper = $this->getEmaper();
            $result->bindParam(":emaper", $emaper);
            $actper = $this->getActper();
            $result->bindParam(":actper", $actper);
            $nivel = $this->getNivel();
            $result->bindParam(":nivel", $nivel);
            if ($hash) $result->bindParam(":hashl", $hash);
            if ($salt) $result->bindParam(":salt", $salt);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function editAct()
    {
        $sql = "UPDATE persona SET actper=:actper WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $actper = $this->getActper();
        $result->bindParam(":actper", $actper);
        $result->execute();
    }

    function edit(){
        try{
            $sql = "UPDATE persona SET nomper=:nomper, apeper=:apeper, ndper=:ndper, area=:area, idvfor=:idvfor, cargo=:cargo, emaper=:emaper, actper=:actper, nivel=:nivel WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $nomper = $this->getNomper();
            $result->bindParam(":nomper", $nomper);
            $apeper = $this->getApeper();
            $result->bindParam(":apeper", $apeper);
            $ndper = $this->getNdper();
            $result->bindParam(":ndper", $ndper);
            $area = $this->getArea();
            $result->bindParam(":area", $area);
            $idvfor = $this->getIdvfor();
            $result->bindParam(":idvfor", $idvfor);
            $cargo = $this->getCargo();
            $result->bindParam(":cargo", $cargo);
            $emaper = $this->getEmaper();
            $result->bindParam(":emaper", $emaper);
            $actper = $this->getActper();
            $result->bindParam(":actper", $actper);
            $nivel = $this->getNivel();
            $result->bindParam(":nivel", $nivel);
            $result->execute();
        }catch (Exception $e) {
            ManejoError($e);
        }
    }

    function updpass(){
        try {
            $token = $this->getToken();
            $sql = "UPDATE persona SET hashl=:hashl, salt=:salt, feccam=:feccam";
            if ($token) $sql .= ", token=:token";
            $sql .= " WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $hash = $this->getHash();
            $result->bindParam(":hashl", $hash);
            $salt = $this->getSalt();
            $result->bindParam(":salt", $salt);
            $feccam = $this->getFeccam();
            $result->bindParam(":feccam", $feccam);
            if ($token) $result->bindParam(":token", $token);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function del()
    {
        try {
            $sql = "DELETE FROM persona WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }
 
    function getPFxP($idper){
        $res = null;
        $modelo = new conexion();
		$sql = "SELECT COUNT(idper) AS can FROM perxpef WHERE idper=:idper";
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result->bindParam(':idper',$idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

    //------------Jefe-----------
    function getOneJxP()
    {
        $sql = "SELECT idjef, tipjef FROM jefxper WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function saveJxP($tip)
    {
        try{
            $sql = "INSERT INTO jefxper (idper, idjef, tipjef) VALUES (:idper, :idjef, :tipjef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $idjef = $this->getIdjef();
            $result->bindParam(":idjef", $idjef);
            $result->bindParam(":tipjef", $tip);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delJxP()
    {
        try{
            $sql = "DELETE FROM jefxper WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    //------------Perfil-----------
    
    function getOnePxF()
    {
        $sql = "SELECT idpef FROM perxpef WHERE idper=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $idper = $this->getIdper();
        $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getOneSPxF($ndper)
    {
        $sql = "SELECT p.idper FROM persona AS p WHERE p.ndper=:ndper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":ndper", $ndper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function savePxF()
    {
        try{
            $sql = "INSERT INTO perxpef (idper, idpef) VALUES (:idper,:idpef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $idpef = $this->getIdpef();
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function savePxFAut($idper,$idpef)
    {
        try{
            $sql = "INSERT INTO perxpef (idper, idpef) VALUES (:idper,:idpef)";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $result->bindParam(":idper", $idper);
            $result->bindParam(":idpef", $idpef);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

    function delPxF()
    {
        try{
            $sql = "DELETE FROM perxpef WHERE idper=:idper";
            $modelo = new conexion();
            $conexion = $modelo->get_conexion();
            $result = $conexion->prepare($sql);
            $idper = $this->getIdper();
            $result->bindParam(":idper", $idper);
            $result->execute();
        } catch (Exception $e) {
            ManejoError($e);
        }
    }

     //------------Traer valores-----------

      function getAllDom($iddom)
    {
        $sql = "SELECT idval, nomval FROM valor WHERE iddom=:iddom";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->bindParam(":iddom", $iddom);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getPer($idper)
    {
        $sql = "SELECT idper, nomper, apeper, ndper, nivel FROM persona WHERE actper=1";
        if($idper!="") $sql .= " AND idper!=:idper";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        if($idper!="") $result->bindParam(":idper", $idper);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function getPef()
    {
        $sql = "SELECT idpef, nompef FROM perfil";
        $modelo = new conexion();
        $conexion = $modelo->get_conexion();
        $result = $conexion->prepare($sql);
        $result->execute();
        $res = $result->fetchall(PDO::FETCH_ASSOC);
        return $res;
    }

    function CompVal(){
		$sql = "SELECT idval, COUNT(*) AS sum FROM valor WHERE idval=:idval GROUP BY idval";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
        $idval = $this->getIdval();
        $result->bindParam(":idval", $idval);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
    function selectUsu(){
		$sql = "SELECT idper, COUNT(*) AS sum FROM persona WHERE ndper=:ndper GROUP BY idper";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$ndper=$this->getNdper();
		$result->bindParam(":ndper",$ndper);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}
    function CompPef(){
		$sql = "SELECT idpef, COUNT(*) AS sum FROM perfil WHERE idpef=:idpef GROUP BY idpef";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
        $idpef = $this->getIdpef();
        $result->bindParam(":idpef", $idpef);
		$result->execute();
		$res = $result->fetchAll(PDO::FETCH_ASSOC);
		return $res;
	}  
}
