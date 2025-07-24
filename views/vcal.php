<?php include('controllers/ceva.php');

if($_SESSION['idpef']==2){?>
    <form action="home.php?pg=113" method="post" id="frmins">
        <div class="row" style="align-items: end">
            <div class="form-group col-md-10">
                <div class="row" style="align-items: end">
                    <div class="form-group col-sm-3">
                        <label for="fecinib"><strong>Fecha inicial:</strong></label>
                        <input type="date" name="fecini" id="fecinib" value="<?= $fecini; ?>" onchange="this.form.submit();" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="fecfinb"><strong>Fecha final:</strong></label>
                        <input type="date" name="fecfin" id="fecfinb" value="<?= $fecfin; ?>" onchange="this.form.submit()" min="<?= $fecini; ?>" class="form-control">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="nota"><strong>Nota mínima:</strong></label>
                        <input type="text" name="nota" id="nota" value="<?= $nota; ?>" onkeydown="return enter(event, 'nota');" onchange="this.form.submit();" oninput="valNum('nota', '');" onkeypress="return NumDecimal(event);" class="form-control">
                    </div>
                    <input type="hidden" name="ope" value="busc">
                    <div class="form-group col-sm-1" id="btnprm">
                        <button type="submit" title="Limpiar" value="limp" name="ope" style="border:none; background-color: #f7f2ef;">
                            <i class="fa fa-solid fa-eraser fa-2x desact"></i>
                        </button>
                    </div>
                </div>
            </div>
            <?php if($datAll){?>
                <div class="form-group col-md-2" style="text-align: right;">
                    <button type="submit" title="Calcular nota" value="calcular" name="ope" style="border:none; background-color: #f7f2ef;">
                        <strong>Calcular</strong>
                        <i class="fa fa-solid fa-calculator fa-2x iconi"></i>
                    </button>
                </div>
            <?php } ?>
        </div>
        <small id="msjerror" style="color: red; display: none; margin-top: 5px"></small>
    </form>
<?php } ?>
<table id="mytable" class="table table-striped">
    <thead>
        <tr>
            <th>Persona</th>
            <th>Nota</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll as $dta) { ?>
            <tr>
                <td>
                    <div class="row">
                        <div class="form-group col-md-10">
                            <BIG><strong><?php if($dta['eva']) echo $dta['eva']; ?></strong></BIG>
                            <small>
                                <div class="row">
                                    <?php if ($dta['jef']) { ?>
                                        <div class="form-group col-md-6">
                                            <strong>Jefe: </strong> <?= $dta['jef']; ?>
                                        </div>
                                    <?php } if ($dta['par']) { ?>
                                        <div class="form-group col-md-6">
                                            <strong>Par: </strong> <?= $dta['par']; ?>
                                        </div>  
                                    <?php } if ($dta['sub']) { ?>
                                        <div class="form-group col-md-12">
                                            <strong>Subalterno: </strong> <?= $dta['sub']; ?>
                                        </div>
                                    <?php } if ($dta['tfor']) { ?>
                                        <div class="form-group col-md-6">
                                            <strong>Formato: </strong> <?= $dta['tfor']; ?>
                                        </div>
                                    <?php } if ($dta['verfor']) { ?>
                                        <div class="form-group col-md-6">
                                            <strong>Versión: </strong> <?= $dta['verfor']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <?php if($dta['rutpdf'] && file_exists($dta['rutpdf'])) { ?>
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['idcal'] ?>', 'spt', '<?= basename($dta['rutpdf']) ?>', '113')" title="Ver PDF"></i>
                            <?php } else { ?>
                                <a href="views/pdfcal.php?idcal=<?=$dta['idcal'];?>" title="Generar PDF" target="_blank">
                                    <i class="fa fa-solid fa-file-pdf iconi"></i>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </td>
                <td style="text-align: right;">
                    <BIG><strong><?php if($dta['nota']) echo $dta['nota']; else echo "--"; ?></strong></BIG>
                </td>
                <td style="text-align: right;">
                    <BIG><strong><?php if($dta['feccal']) echo date("d/m/Y", strtotime($dta['feccal'])); ?></strong></BIG>
                </td>
            </tr>
        <?php }} ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Persona</th>
            <th>Nota</th>
            <th>Fecha</th>
        </tr>
    </tfoot>
</table>