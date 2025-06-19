<?php require_once 'controllers/cpmod.php';?>

<div class="secmod">
	<?php if ($datAll) { foreach ($datAll as $dt) {
			$modact = "No";
			if ($datPfPr) {
				foreach ($datPfPr as $dtfp) {
					if ($dt['idmod'] == $dtfp['idmod']){
						$modact = "Si";
						$idpef = $dtfp['idpef'];
					}
				}
			}
			if ($modact == "Si") { ?>
				<form action="pmod.php" method="POST">
					<button type="submit" class="modulo">
						<?php if (file_exists($dt['imgmod'])) { ?>
							<img class="logmod" src="<?= $dt['imgmod']; ?>" alt="Logo módulo <?= $dt['nommod']; ?>" />
						<?php } else { ?>
							<img class="logmod" src="img/logo.png" alt="Logo módulo <?= $dt['nommod']; ?>" />
						<?php } ?>
						<br>
						<?= $dt['nommod']; ?>
					</button>
					<input type="hidden" name="idmod" value="<?= $dt['idmod']; ?>">
					<input type="hidden" name="ope" value="dircc">
				</form>
			<?php } else { ?>
				<form>
					<button disabled class="modulo1">
						<?php if (file_exists($dt['imgmod'])) { ?>
							<img class="logmod" src="<?= $dt['imgmod']; ?>" alt="Logo módulo <?= $dt['nommod']; ?>" />
						<?php } else { ?>
							<img class="logmod" src="img/logo.png" alt="Logo módulo <?= $dt['nommod']; ?>" />
						<?php } ?>
						<br>
						<?= $dt['nommod']; ?>
					</button>
				</form>
	<?php }}} ?>
</div>
<?php 
	if ($mosmdl) {
	    modalPef($datPfPrMd);
	    echo '<script>$(document).ready(function() { $("#myModal").modal("show"); });</script>'; 
	}
?>
