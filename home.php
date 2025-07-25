<?php
include("models/seguridad.php");
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TUMMY</title>
    <link rel="icon" href="img/Icono_TUMMY.png">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/data.js"></script>
	<script src="https://code.highcharts.com/modules/drilldown.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<script src="https://code.highcharts.com/modules/export-data.js"></script>
	<script src="https://code.highcharts.com/modules/accessibility.js"></script>
	<script src="https://code.highcharts.com/highcharts-more.js"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.esm.js" integrity="sha512-oa6kn7l/guSfv94d8YmJLcn/s3Km4mm/t4RqFqyorSMXkKlg6pFM6HmLXsJvOP/Cl/dv/N5xW7zuaA+paSc55Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.esm.min.js" integrity="sha512-OxXHRCrHZMOqbrhaUX+wMD4pRxO+Ym5CKOf0qsPkBTeBOXBjAKirtaTH87wKgEikZBPOMQPOEqE/3fpWa1wiuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.js" integrity="sha512-sn/GHTj+FCxK5wam7k9w4gPPm6zss4Zwl/X9wgrvGMFbnedR8lTUSLdsolDRBRzsX6N+YgG6OWyvn9qaFVXH9w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

	<!-- Resources -->
	<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
	<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

	<script type="text/javascript" src="js/code.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
	<header>
		<?php
		date_default_timezone_set('America/Bogota');
		$nmfl = date('YmdHis');
		$nomarc = date('d-m-Y_His');
		$hoy = date("Y-m-d");
    	$mañana = date("Y-m-d", strtotime($hoy . ' +1 day'));
		$pasadom = date("Y-m-d", strtotime($hoy . ' +2 days'));
		require_once("models/conexion.php");
		include("controllers/optimg.php");
		include("controllers/library.php");
		include("views/cabe.php");
		$pg = isset($_REQUEST['pg']) ? $_REQUEST['pg'] : NULL;
		$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : NULL;
		?>
	</header>
	<section class="cont">
		<?php
		$mos = 0;
		$est = 0;
		$rut = validarpg($pg);
		if ($rut) {
			if ($_SESSION['idpef']==3 && $pg==106) $mos = 2;
			else if ($_SESSION['idpef']!=2 && $pg==110) $mos = 0;
			else if ($_SESSION['idpef']==2 && $pg==111) $mos = 0;
			else if ($pg==112 || $pg==113) $mos = 2;
			else $mos = $rut[0]['mospag'];
			if ($ope == "edi") $est = 1;
			// if (!$_SESSION['new']){
			// 	echo '<div id="cpass"></div>';
			// 	echo "<script>cpass('Para empezar, por favor <a class=\"lcon\" href=\"pmod.php?ope=cg\">cambia tu contraseña');</script>";
			// }
			titulo($rut[0]['icono'], $rut[0]['nompag'], $mos, $pg);
			echo '<div id="err"></div>';
			echo "<script>err();</script>";
			echo '<div id="satf"></div>';
			echo "<script>satf();</script>";
			require_once($rut[0]['arcpag']);
		} else {
			// echo "<h1>Usted no tiene permisos, para ingresar a esta página. Comuníquese con su administrador</h1>";
			echo "<script>window.location.href = '404.php';</script>";
		}
		?>
	</section>
	<footer>
		<?php 
			include("views/foot.php");
		?>
	</footer>
</body>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
	ocul(<?= $mos; ?>, <?= $est; ?>);
</script>
</html>