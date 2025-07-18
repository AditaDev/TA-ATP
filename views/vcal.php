<?php include('controllers/ceva.php');

if($_SESSION['idpef']==2){?>
    <form action="home.php?pg=113" method="post">
        <div class="row">
            <div class="form-group col-md-10">
                <div class="row">
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
                        <input type="text" name="nota" id="nota" value="<?= $nota; ?>" onkeydown="return enter(event, 'nota');" onchange="this.form.submit();" oninput="valNum('nota', '');" onkeypress="return solonum(event);" class="form-control">
                        <small id="msjerror" style="color: red; display: none; margin-top: 5px"></small>
                    </div>
                    <input type="hidden" name="ope" value="busc">
                    <div class="form-group col-sm-1" id="btnprm">
                        <button type="submit" title="Limpiar" value="limp" name="ope" style="border:none; background-color: #f7f2ef;">
                            <i class="fa fa-solid fa-eraser fa-2x desact"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <a href="excel/xprm.php?exl=prm" title="Calcular Nota">
                    <i class="fa fa-solid fa-file-export fa-2x exp"></i>
                </a>
            </div>
        </div>
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
                                        <div class="form-group col-md-12">
                                            <strong>Formato: </strong> <?= $dta['tfor']; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </small>
                        </div>
                        <div class="form-group col-md-2">
                            <?php
                            if($_SESSION['idpef']==3 && $dta['sptrut'] && file_exists($dta['sptrut'])) { ?>
                                <i class="fa fa-solid fa-file-pdf iconi" onclick="pdf('<?= $dta['idprm'] ?>', 'spt', '<?= basename($dta['sptrut']) ?>')"></i>
                            <?php } ?>
                        </div>
                    </div>
                </td>
                <td style="text-align: center;">
                    <BIG><strong><?php if($dta['nota']) echo $dta['feccal']; else echo "--"; ?></strong></BIG>
                </td>
                <td style="text-align: center;">
                    <BIG><strong><?php if($dta['fcal']) echo $dta['fcal']; ?></strong></BIG>
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