<?php
require_once 'conexion.php';

class Majax{
	function getFor($idper){
        $sql = "SELECT f.idfor, f.tipfor, f.codfor, f.fecfor, f.nomsec1, f.pre1, f.pre2, f.pre3, f.pre4, f.pre5, f.nomsec2, f.pre6, f.pre7, f.pre8, f.pre9, f.pre10, f.nomsec3, f.pre11, f.pre12, f.pre13, f.pre14, f.pre15, f.nomsec4, f.pre16, f.pre17, f.pre18, f.pre19, f.pre20, f.nomsec5, f.pre21, f.pre22, f.pre23, f.pre24, f.pre25, f.porjef, f.porpar, f.poraut, f.porsub, f.actfor, v.nomval, p.idper FROM formato AS f INNER JOIN valor AS v ON f.tipfor=v.idval INNER JOIN persona AS p ON p.idvfor=f.tipfor WHERE p.idper=:idper AND f.actfor=1";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result -> bindParam(":idper", $idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}

	function getNivel($idper){
        $sql = "SELECT idper, nivel FROM persona WHERE idper=:idper";
		$modelo = new conexion();
		$conexion = $modelo->get_conexion();
		$result = $conexion->prepare($sql);
		$result -> bindParam(":idper", $idper);
		$result->execute();
		$res = $result-> fetchall(PDO::FETCH_ASSOC);
		return $res;
	}
}
?>