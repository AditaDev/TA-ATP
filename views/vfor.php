<?php
include('controllers/cfor.php');
?>

<form action="home.php?pg=<?= $pg; ?>" method="POST" id="frmins">
    <div class="row">
        <div class="form-group col-md-6">
            <label for="tipfor"><strong>Tipo:</strong></label>
            <select name="tipfor" id="tipfor" class="form-control form-select" required onchange="sumporcent()">
                <option value="" disabled selected>Seleccione...</option>
                <?php foreach ($datFor as $dtf) { ?>
                    <option value="<?= $dtf['idval']; ?>" <?php if ($datOne && $dtf['idval'] == $datOne[0]['tipfor']) echo " selected "; ?>>
                        <?= $dtf['nomval']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="codfor"><strong>Código:</strong></label>
            <input class="form-control" type="text" id="codfor" name="codfor" value="<?php if ($datOne) echo $datOne[0]['codfor']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="verfor"><strong>Versión:</strong></label>
            <input class="form-control" type="text" id="verfor" name="verfor" value="<?php if ($datOne) echo $datOne[0]['verfor']; ?>" onkeypress="return solonum(event);" required>
        </div>
        <div class="form-group col-md-6">
            <label for="fecfor"><strong>Fecha:</strong></label>
            <input class="form-control" type="date" id="fecfor" name="fecfor" value="<?php if ($datOne) echo $datOne[0]['fecfor']; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="actfor" class="titulo"><strong>Activo:</strong></label>
            <select name="actfor" id="actfor" class="form-control form-select" required>
                <option value="1" <?php if ($datOne && $datOne[0]['actfor'] == 1) echo " selected "; ?>>Si</option>
                <option value="2" <?php if ($datOne && $datOne[0]['actfor'] == 2) echo " selected "; ?>>No</option>
            </select>
        </div>
        <?php
        $c = 0;
        $p = 1;
        for($i=1; $i<=25; $i++){
            $p++;
            if($i==1){ 
                $c = 1;
                $color = "#b4eff7";
            }elseif($i==6){ 
                $c = 2;
                $color = "#c7f196";
            }elseif($i==11){ 
                $c = 3;
                $color = "#ffecb3";
            }elseif($i==16){ 
                $c = 4;
                $color = "#ecb5f4";
            }elseif($i==21){ 
                $c = 5;
                $color = "#f78686";
            }if($i==1 || $i==6 || $i==11 || $i==16 || $i==21){
                $p = 1;
            ?>
            <div class="form-group col-sm-12 formato" style="background: <?= $color; ?>">
                <div onclick="ocultarseccion('sec<?= $c; ?>', 'des<?= $c; ?>')">
                    <i id="des<?= $c; ?>" class="fa-solid fa-caret-down"></i>
                    <strong><u>Sección <?= $c; ?></u></strong>
                </div>
                <div class="row" id="sec<?= $c; ?>" style="visibility: hidden; height: 0px; overflow: hidden; transition: height 0.5s ease, visibility 0s linear 0.5s;">
                    <div class="form-group col-lg-6">
                        <label for="nomsec<?= $c; ?>"><strong>Nombre:</strong></label>
                        <input class="form-control" type="text" id="nomsec<?= $c; ?>" name="nomsec<?= $c; ?>" value="<?php if ($datOne) echo $datOne[0]['nomsec'.$c]; ?>" <?php ($c<=3) ? "required" : "";?> oninput="valNomSec('nomsec', <?= $c ?>)">
                        <small id="msjerror<?= $c; ?>" style="color: red; display: none; margin-top: 5px"></small>
                    </div>
            <?php } ?>
                    <div class="form-group col-lg-6">
                        <label for="pre<?= $i; ?>"><strong>Pregunta <?= $p ?>:</strong></label>
                        <input class="form-control" type="text" id="pre<?= $i; ?>" name="pre<?= $i; ?>" value="<?php if ($datOne) echo $datOne[0]['pre'.$i]; ?>" oninput="valNomSec('nomsec', <?=$c;?>)">
                    </div>
            <?php if($i==5 || $i==10 || $i==15 || $i==20 || $i==25){ ?>
                </div>
            </div>
        <?php }} ?>
        <div class="form-group col-sm-12" style="text-align: center; margin-top: 20px">
            <strong><u>Porcentajes</u></strong>
            <small id="porcent"></small>
        </div>
        <div class="form-group col-md-6">
            <label for="porjef"><strong>Jefe:</strong></label>
            <input class="form-control" type="text" id="porjef" name="porjef" value="<?php if ($datOne) echo $datOne[0]['porjef']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);">
        </div>
        <div class="form-group col-md-6">
            <label for="porpar"><strong>Par:</strong></label>
            <input class="form-control" type="text" id="porpar" name="porpar" value="<?php if ($datOne) echo $datOne[0]['porpar']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);">
        </div>
        <div class="form-group col-md-6">
            <label for="poraut"><strong>Autoevaluación:</strong></label>
            <input class="form-control" type="text" id="poraut" name="poraut" value="<?php if ($datOne) echo $datOne[0]['poraut']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);">
        </div>
        <div class="form-group col-md-6">
            <label for="porsub"><strong>Subalterno:</strong></label>
            <input class="form-control" type="text" id="porsub" name="porsub" value="<?php if ($datOne) echo $datOne[0]['porsub']; ?>" onchange="sumporcent()" onkeypress="return solonum(event);">
        </div>
        <div class="form-group col-md-12" id="boxbtn">
            <br><br>
            <input class="btn btn-primary" type="submit" value="Registrar" id="btnEnviar">
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
                        <div class="row">
                            <div class="col-sm-10">
                                <BIG><strong> <?= $dta['codfor']." - ".$dta['nomval'];?></strong></BIG>
                            </div>
                            <div class="col-sm-2">
                                <i class="fa fa-solid fa-eye iconi" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdlfor<?= $dta['idfor']; ?>" title="Detalles"></i>
                                <?php 
                                    $mfor->setIdfor($dta['idfor']);
                                    $det = $mfor->getOne();
                                    modalInfFor("mdlfor", $dta['idfor'], $det[0]);
                                ?>
                            </div>
                        </div>
                        <small>
                            <div class="row">
                                <?php if ($dta['verfor']) { ?>
                                        <div class="form-group col-md-6">
                                        <strong>Versión: </strong> <?= $dta['verfor']; ?>
                                    </div>
                                <?php } if ($dta['fecfor']) { ?>
                                        <div class="form-group col-md-6">
                                        <strong>Fecha: </strong> <?= date("d/m/Y", strtotime($dta['fecfor'])); ?>
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
                                <a href="home.php?pg=<?= $pg; ?>&idfor=<?= $dta['idfor']; ?>&ope=del" onclick="return eliminar('<?= $dta['codfor'].' - '.$dta['nomval']; ?>');" title="Eliminar">
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