<?php
include('controllers/ceva.php');
if($_SESSION['idpef']==2){ if($pendientes){ ?>
    <table id="mytable" class="table table-striped">
        <thead>
            <tr>
                <th>Relación</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pendientes as $pdt) { ?>
                <tr>
                    <td>
                        <BIG><strong><?= $pdt['nombre']; ?></strong></BIG>
                        <small>
                            <div class="row">
                                <?php foreach ($pdt['faltantes'] as $flt) { ?>
                                    <div class="form-group col-md-12">
                                        <strong><?= $flt['nomtip'].(($flt['tipo']==1)?"":":"); ?></strong>
                                        <?php if ($flt['evaluador'] && ($flt['tipo']!=1)) { ?>
                                            <?= implode(', ', array_column($flt['evaluador'], 'nom')); ?>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </small>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Relación</th>
            </tr>
        </tfoot>
    </table>
<?php } else { ?>
    <div class="fin">
	    <div class="row">
            <div class="imgfin form-group col-md-4">
                <img class="imgerr" src="img/fin.png" alt="">
                </div>
            <div class="text form-group col-md-8">
                <h1><strong></strong>Al día!</strong></h1>
                <h3>No hay evaluaciones pendientes.</h3>
            </div>
        </div>
    </div>
<?php }} else{ if($datPer){?>
    <form action="home.php?pg=112" method="POST" id="frmins">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="idperevald"><strong>Evaluado:</strong></label>
                <select name="idperevald" id="idperevald" class="form-control form-select" onChange="recFormato(this.value); TipoEvaluacion(this)" required>
                    <option value="" disabled selected>Seleccione...</option>
                    <?php foreach ($datPer AS $dtp) { ?>
                        <option value="<?= $dtp['idper']; ?>" data-tipo="<?= $dtp['tipeva'] ?? 0 ?>" <?php if (isset($datOne[0]['idperevald']) && $dtp['idper'] == $datOne[0]['idperevald']) echo "selected"; ?>>
                            <?= $dtp['nomper'].(($dtp['idper']==$_SESSION['idper'])?" / (Autoevaluación)":""); ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="hidden" name="tipeva" id="tipeva">
            </div>
            <div class="form-group col-md-12" id="recFormato"></div>
            <div class="form-group col-md-12" id="boxbtn">
                <br>
                <input class="btn btn-primary" type="submit" value="Registrar" id="btns">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="ideva" value="<?php if ($datOne) echo $datOne[0]['ideva']; ?>">
            </div>
        </div>
    </form>
<?php } else { ?>
    <div class="fin">
	    <div class="row">
            <div class="imgfin form-group col-md-4">
                <img class="imgerr" src="img/fin.png" alt="">
                </div>
            <div class="text form-group col-md-8">
                <h1><strong></strong>Felicitaciones!</strong></h1>
                <h3>Completaste todas las evaluaciones asignadas.</h3>
            </div>
        </div>
    </div>
<?php }} ?>


<style>
	.fin {
        background-color: rgba(255, 255, 255);
        padding: 40px;
        border-radius: 10px;
        backdrop-filter: blur(10px);
        box-shadow: 6px 10px 20px 0 rgba(0, 0, 0, 0.4);
        margin: 120px auto;
        position: relative;
        width: 90%;
	}
    
    .imgfin{
        text-align: center;
    }
    
    .imgerr{
        width: 100%;
    }
    
    .text{
        padding: 10px 20px;
        display: flex;
        align-items: flex-start;
        text-align: left;
        flex-direction: column;
        flex-wrap: nowrap;
        justify-content: center;
    }

    h1{
        color: #073663;
    }

    @media screen and (max-width: 767px) {
        .text {
            text-align: center;
            display: inline-block;
        }

        /* .imgerr{
            width: 80%;
        } */
    }
</style>