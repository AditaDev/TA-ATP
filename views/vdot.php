<?php

require_once('controllers/cdot.php');
$hoy = date("Y-m-d");
$mañana = date("Y-m-d", strtotime($hoy . ' +1 day'));
if($_SESSION['idpef']==2){
?>
    <div style="text-align: right;">
        <a href="excel/xdot.php" title="Exportar Dotaciones">
            <i class="fa fa-solid fa-file-export fa-2x exp"></i>
        </a>
    </div>
<?php } ?>
<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-sm-8 ui-widget">
            <label for="idperrec"><strong>Usuario:</strong></label>
            <select id="combobox1" name="idperrec" class="form-control form-select" <?php if ($datOne) echo 'disabled'; else echo 'required';?>>
                <option value="0"></option>
                <?php if ($datPer) {
                    foreach ($datPer as $dep) { ?>
                        <option value='<?= $dep['idper']; ?>' <?php if ($datOne && $dep['idper'] == $datOne[0]['prec']) echo " selected "; ?>>
                            <?= $dep['ndper'] . " - " . $dep['nomper'] . "  " . $dep['apeper']; ?>
                        </option>
                <?php }
                } ?>
            </select>
        </div>
        <?php ?>
        <div class="form-group col-sm-4">
            <label for="fecent"><strong>Fecha Entrega:</strong></label>
            <input class="form-control" type="date" id="fecent" name="fecent" max=<?php echo $hoy; ?> <?php if ($datOne) echo 'value="' . $datOne[0]['fecent'] . '" disabled';
                else echo 'value="' . $hoy . '" required'; ?>>
        </div>
        <div class="form-group col-sm-6" style="text-align: center; margin-top: 20px">
            <strong><u>Horario de Camisa</u></strong>
            <div class="row" style="margin-top: 20px">
                <?php if ($datDia && $datCol ) {
                    foreach ($datDia as $ddo) { ?>
                        <div class="form-group col-sm-6" style="text-align: left;">
                            <label for="idvdia"><strong><?= $ddo['nomval']; ?></strong></label>
                        </div>
                        <div class="form-group col-sm-6" style="text-align: right;">
                            <select name="idvcol[]" id="idvcol" class="form-control form-select">
                                <option value="0"></option>
                                <?php if ($datCol) { foreach ($datCol as $ddt) { ?>
                                    <option value="<?= $ddt['idval'] ?>" <?php if ($datCxD){ foreach ($datCxD as $ddot){ if ($ddt['idval'] == $ddot['idvcol'] && $ddot['idvdia'] == $ddo['idval']) echo " selected ";}}?>>
                                        <?= $ddt['nomval']; ?>
                                    </option>
                                <?php }} ?>
                            </select>
                        </div>
                <?php }} ?>
            </div>
        </div>
        <div class="form-group col-sm-6" style="text-align: center; margin-top: 20px">
            <div class="row">
                <div class="form-group col-6"><strong><u>Cantidad - Elemento</u></strong></div>
                <div class="form-group col-6"><strong><u>Tallas</u></strong></div>
            </div>
            <div class="row" style="margin-top: 20px">
                <?php if ($datDot && $datTalS && $datTalP && $datTalZ) {
                    $i = 0;
                    foreach ($datDot as $ddo) {?>
                        <div class="form-group col-6" style="text-align: left;">
                            <div class="row">
                                <div class="form-group col-3">
                                    <input class="form-control" type="text" name="cant[]" value="<?php if ($datTxD) {
                                        foreach ($datTxD as $ddt) {
                                            if ($ddo['idval'] == $ddt['idvdot']){ echo $datTxD[$i]['cant']; $i++;
                                                }}
                                            } ?>" onkeypress="return solonum(event);">
                                    <input type="hidden" name="idvdot[]" value="<?= $ddo['idval'] ?>">
                                </div>
                                <div class="form-group col-9">   
                                    <label for="idvdot"><strong><?= $ddo['nomval']; ?></strong></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6" style="text-align: right;">
                            <select name="idvtal[]" id="idvtal" class="form-control form-select">
                                <option value="0"></option>
                                <?php
                                if ($ddo['idval'] == 13 or $ddo['idval'] == 14) $datTal = $datTalS;
                                elseif ($ddo['idval'] == 12) $datTal = $datTalP;
                                elseif ($ddo['idval'] == 15) $datTal = $datTalZ;
                                elseif ($ddo['idval'] == 16) $datTal = $datTalG;
                                if ($datTal) {
                                    foreach ($datTal as $ddt) { ?>
                                        <option value="<?= $ddt['idval'] ?>" <?php if ($datTxD) {
                                            foreach ($datTxD as $ddot) {
                                                if ($ddt['idval'] == $ddot['idvtal'] && $ddo['idval'] == $ddot['idvdot']) echo " selected ";
                                                }
                                            } ?>>
                                            <?= $ddt['nomval']; ?>
                                        </option>
                                <?php }} ?>
                            </select>
                        </div>
                    <?php }} ?>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <br>
            <label for="observ"><strong>Observaciones Entrega:</strong></label>
            <textarea class="form-control" type="text" id="observ" name="observ" <?php if ($datOne) echo 'required'; ?>><?php if ($datOne) echo $datOne[0]['observ']; ?></textarea>
        </div>
        <div class="form-group col-sm-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="ident" value="<?php if ($datOne) echo $datOne[0]['ident']; ?>">
        </div>         
    </div>
</form>

<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Datos persona</th>
            <th>Estado</th>
            <?php if($_SESSION['idpef']==2){ ?><th>Acciones</th><?php } ?>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAllD) {
            foreach ($datAllD as $dta) { ?>
                <tr>
                    <td tyle="text-align: left;">
                        <div class="row">
                            <div class="form-group col-sm-10">
                                <strong> <?= ($dta['fecent']) .  " - "  . $dta['nomprec']; ?></strong>
                                <div class="row">
                                <?php if($dta['aprec']){?>
                                    <div class="form-group col-sm-6">
                                        <small><strong>Área: </strong> <?= $dta['aprec']; ?></small>
                                    </div>
                                <?php } if ($dta['observ']) { ?>
                                    <div class="form-group col-sm-6">
                                        <small><strong>Observación: </strong><?= $dta['observ']; ?></small>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="form-group col-sm-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbdet<?= $dta['ident']; ?>" title="Detalles"></i>
                                <?php
                                    $mdot->setIdent($dta['ident']);
                                    $acc = $mdot->getAllTxD($dta['ident']);
                                    $cxc = $mdot->getAllCxc($dta['ident']);
                                    $det = $mdot->getOne();
                                    modalInfAsg("mcbdet", $dta['ident'], $acc, $det, $cxc);
                                ?>
                                <i class="fa fa-solid fa-pen-clip iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbfir<?= $dta['ident']; ?>" title="Firmar"></i>
                                <?php  
                                    $mdot->setIdent($dta['ident']);
                                    $det = $mdot->getOne();
                                    modalFir("mcbfir", $dta['ident'], $det, $pg);
                                   if(($dta['firpent'] && !$dta['firprec'] && !$dta['fecdev']) OR ($dta['firpent'] && $dta['firprec'])){
                                ?>
                                <a href="views/pdfdot.php?ident=<?=$dta['ident'];?>" title="Enviar confirmación" target="_blank">
                                    <i class="fa fa-solid fa-envelopes-bulk iconi"></i>
                                </a>
                                <?php } if($dta['rutpdf'] && file_exists($dta['rutpdf'])) { ?>
                                    <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['ident'] ?>', 'rut', '<?= basename($dta['rutpdf']) ?>', '<?= $pg ?>')"></i>
                                <?php } ?>
                                
                            </div>
                        </div>
                    </td>
                    <td style="text-align: left;">
                        <?php if ($dta['estent'] == 1) { ?>
                            <span style="font-size: 1px;opacity: 0;">1</span>
                            <i class="fa fa-solid fa-circle-check fa-2x act" title="Asignado"></i>
                        <?php } else if ($dta['estent'] == 2) { ?>
                            <span style="font-size: 1px;">2</span>
                            <i class="fa fa-solid fa-circle-xmark fa-2x desact" title="Devuelto"></i>
                        <?php } ?>
                    </td>
                    <?php if($_SESSION['idpef']==2){ ?>
                    <td tyle="text-align: half;">
                        <span style="font-size: 1px;opacity: 0;"><?= $dta['fecdev']; ?></span>
                        <?php if ($dta['estent'] != 2) { ?>
                            <i class="fa fa-solid fa-arrows-turn-to-dots fa-2x iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcbdev<?= $dta['ident']; ?>" title="Devolver"></i>
                            <?php
                            $mdot->setIdent($dta['ident']);
                            $acc = $mdot->getAllTxD($dta['ident']);
                            $det = $mdot->getOne();
                            modalDev("mcbdev", $dta['ident'], $acc, $det, $pg, $nmfl);
                            ?>
                            <a href="home.php?pg=<?= $pg; ?>&ident=<?= $dta['ident']; ?>&ope=edi">
                                <i class="fa fa-solid fa-pen-to-square fa-2x iconi" title="Editar"></i>
                            </a>                            
                        <?php } ?>
                    </td>
                    <?php } ?>
                </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Datos persona</th>
            <th>Estado</th>
            <?php if($_SESSION['idpef']==2){ ?><th>Acciones</th><?php } ?>
        </tr>
    </tfoot>
</table>
<style>
    .custom-combobox1,
    .custom-combobox2-input {
        position: relative;
        display: inline-block;
        width: 100%;
        text-align: left;
    }

    .custom-combobox1-toggle,
    .custom-combobox2-toggle {
        position: absolute;
        top: 0;
        bottom: 0;
        margin-left: -1px;
        padding: 0;
    }

    .custom-combobox1-input,
    .custom-combobox2-input {
        margin: 0;
        padding: 5px 10px;
        width: 100%;
        text-align: left;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }
</style>