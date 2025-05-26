<?php
include('controllers/cfor.php');
?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="nomfor"><strong>Nombre:</strong></label>
            <input class="form-control" type="text" id="nomfor" name="nomfor" value="<?php if ($datOne) echo $datOne[0]['nomfor']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="codfor"><strong>Código:</strong></label>
            <input class="form-control" type="text" id="codfor" name="codfor" value="<?php if ($datOne) echo $datOne[0]['codfor']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre1"><strong>Pregunta 1:</strong></label>
            <input class="form-control" type="text" id="pre1" name="pre1" value="<?php if ($datOne) echo $datOne[0]['pre1']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre2"><strong>Pregunta 2:</strong></label>
            <input class="form-control" type="text" id="pre2" name="pre2" value="<?php if ($datOne) echo $datOne[0]['pre2']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre3"><strong>Pregunta 3:</strong></label>
            <input class="form-control" type="text" id="pre3" name="pre3" value="<?php if ($datOne) echo $datOne[0]['pre3']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre4"><strong>Pregunta 4:</strong></label>
            <input class="form-control" type="text" id="pre4" name="pre4" value="<?php if ($datOne) echo $datOne[0]['pre4']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre5"><strong>Pregunta 5:</strong></label>
            <input class="form-control" type="text" id="pre5" name="pre5" value="<?php if ($datOne) echo $datOne[0]['pre5']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre6"><strong>Pregunta 6:</strong></label>
            <input class="form-control" type="text" id="pre6" name="pre6" value="<?php if ($datOne) echo $datOne[0]['pre6']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre7"><strong>Pregunta 7:</strong></label>
            <input class="form-control" type="text" id="pre7" name="pre7" value="<?php if ($datOne) echo $datOne[0]['pre7']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre8"><strong>Pregunta 8:</strong></label>
            <input class="form-control" type="text" id="pre8" name="pre8" value="<?php if ($datOne) echo $datOne[0]['pre8']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre9"><strong>Pregunta 9:</strong></label>
            <input class="form-control" type="text" id="pre9" name="pre9" value="<?php if ($datOne) echo $datOne[0]['pre9']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre10"><strong>Pregunta 10:</strong></label>
            <input class="form-control" type="text" id="pre10" name="pre10" value="<?php if ($datOne) echo $datOne[0]['pre10']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre11"><strong>Pregunta 11:</strong></label>
            <input class="form-control" type="text" id="pre11" name="pre11" value="<?php if ($datOne) echo $datOne[0]['pre11']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre12"><strong>Pregunta 12:</strong></label>
            <input class="form-control" type="text" id="pre12" name="pre12" value="<?php if ($datOne) echo $datOne[0]['pre12']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre13"><strong>Pregunta 13:</strong></label>
            <input class="form-control" type="text" id="pre13" name="pre13" value="<?php if ($datOne) echo $datOne[0]['pre13']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre14"><strong>Pregunta 14:</strong></label>
            <input class="form-control" type="text" id="pre14" name="pre14" value="<?php if ($datOne) echo $datOne[0]['pre14']; ?>" required>
        </div>
        <div class="form-group col-lg-6">
            <label for="pre15"><strong>Pregunta 15:</strong></label>
            <input class="form-control" type="text" id="pre15" name="pre15" value="<?php if ($datOne) echo $datOne[0]['pre15']; ?>" required>
        </div>
        <div class="form-group col-sm-12" style="text-align: center; margin-top: 20px">
            <strong><u>Porcentajes</u></strong>
            <small id="porcent"></small>
        </div>
        <div class="form-group col-md-6">
            <label for="porjef"><strong>Jefe:</strong></label>
            <input class="form-control" type="text" id="porjef" name="porjef" value="<?php if ($datOne) echo $datOne[0]['porjef']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-6">
            <label for="porpar"><strong>Par:</strong></label>
            <input class="form-control" type="text" id="porpar" name="porpar" value="<?php if ($datOne) echo $datOne[0]['porpar']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-6">
            <label for="poraut"><strong>Autoevaluación:</strong></label>
            <input class="form-control" type="text" id="poraut" name="poraut" value="<?php if ($datOne) echo $datOne[0]['poraut']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-6">
            <label for="porsub"><strong>Subalterno:</strong></label>
            <input class="form-control" type="text" id="porsub" name="porsub" value="<?php if ($datOne) echo $datOne[0]['porsub']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idfor" value="<?php if ($datOne) echo $datOne[0]['idfor']; ?>">
        </div>
    </div>
</form>

<table id="mytable" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Formulario</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) {
            foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <BIG><strong> <?= $dta['idfor']." - ".$dta['nomfor'];?></strong></BIG>
                        <small>
                            <div class="row">
                                <?php if ($dta['codfor']) { ?>
                                    <div class="form-group col-md-6">
                                        <strong>Código: </strong> <?= $dta['codfor']; ?>
                                    </div> 
                                    <?php } if ($dta['fecfor']) { ?>
                                        <div class="form-group col-md-6">
                                        <strong>Fecha: </strong> <?= $dta['fecfor']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </small>
                    </td>
                    <td style="text-align: right;">
                        <?php if ($dta['actfor'] == 1) { ?>
                            <span style="font-size: 1px;opacity: 0;">+</span>
                            <a href="home.php?pg=<?= $pg; ?>&idfor=<?= $dta['idfor']; ?>&actfor=2&ope=act" title="Activo">
                                <i class="fa fa-solid fa-circle-check fa-2x act"></i>
                            </a>
                        <?php } else { ?>
                            <span style="font-size: 1px;">--</span>
                            <a href="home.php?pg=<?= $pg; ?>&idfor=<?= $dta['idfor']; ?>&actfor=1&ope=act" title="Inactivo">
                                <i class="fa fa-solid fa-circle-xmark fa-2x desact"></i>
                            </a>
                        <?php } ?>
                        <a href="home.php?pg=<?= $pg; ?>&idfor=<?= $dta['idfor']; ?>&ope=edi" title="Editar">
                            <i class="fa fa-solid fa-pen-to-square fa-2x iconi"></i>
                        </a>
                        <?php 
                            $ct = $mfor->getFxP($dta['idfor']);
                            if($ct && $ct[0]['can']==0){ ?> 
                                <a href="home.php?pg=<?= $pg; ?>&idfor=<?= $dta['idfor']; ?>&ope=del" onclick="return eliminar('<?= $dta['nomfor']; ?>');" title="Eliminar">
                                    <i class="fa fa-solid fa-trash-can fa-2x iconi"></i>
                                </a>
                        <?php } ?>
                    </td>
                </tr>
        <?php }
        } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Formato</th>
            <th></th>
        </tr>
    </tfoot>
</table>