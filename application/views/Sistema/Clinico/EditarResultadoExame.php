<!-- Corpo-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa fa-television"></i> HOME</a></li>
            <li><a href="#"></i><?= strtoupper($this->uri->segment(1)) ?></a></li>
            <li class="active"><?= strtoupper($this->uri->segment(2)) ?></li>
        </ol></br>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="col-md-12">
            <div class="callout callout-success">
                <h4>EDITAR RESULTADO EXAME</h4>
                <b>NOME: </b><?= $paciente->nome ?><br>
                <b>MORADA: </b><?= $paciente->bairro ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">



                        <form role="form" action="<?= base_url() ?>clinico/actualizarresultadoexame" method="post" enctype="multipart/form-data">

                            <div class="box-body">
                                <h4><b>Preencha os campos</b></h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Exame</th>
                                            <th>Resultado</th>
                                            <th>Estado</th>
                                            <th>Valor de Referência</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php $arrayidexame_exameitem = array(); ?>
                                        <?php
                                        foreach ($resultados as $resultado) { ?>
                                            <?php if ($resultado->isexameitem != 1) { ?>
                                                <tr>

                                                    <td>
                                                        <input type="hidden" name="ids[]" value="<?= $resultado->id ?>">
                                                        <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $resultado->designacao ?></textarea>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" name="resultados[]" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $resultado->resultado ?></textarea>
                                                    </td>
                                                    <td>
                                                        <select class="form-control" id="estado" name="estados[]" required>
                                                            <option value="1" <?= ($resultado->estado == 1) ? 'selected' : '' ?>>ALTO</option>
                                                            <option value="2" <?= ($resultado->estado == 2) ? 'selected' : '' ?>>NORMAL</option>
                                                            <option value="3" <?= ($resultado->estado == 3) ? 'selected' : '' ?>>BAIXO</option>
                                                            <option value="4" <?= ($resultado->estado == 4) ? 'selected' : '' ?>>NEGATIVO</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $resultado->valor ?></textarea>
                                                    </td>

                                                </tr>

                                            <?php } else { ?>
                                                <?php if (!in_array($resultado->idexame, $arrayidexame_exameitem)) { ?>
                                                    <?php array_push($arrayidexame_exameitem, $resultado->idexame); ?>

                                                    <tr>
                                                        <td colspan="5">
                                                            <div class="col-md-12">
                                                                <div class="box box-solid">
                                                                    <div class="box-header with-border">
                                                                        <h3 class="box-title"><?= $resultado->designacao ?></h3>
                                                                    </div>
                                                                    <div class="box-body">
                                                                        <div class="box-group" id="accordion">
                                                                            <div class="panel box box-primary">
                                                                                <?php $contItemGrupo = 0;
                                                                                foreach ($this->baseexame->getIdExameItemIdGrupo($resultado->idexame) as $itemgrupo) {
                                                                                    $contItemGrupo++; ?>
                                                                                    <div class="box-header with-border">
                                                                                        <h4 class="box-title">
                                                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $contItemGrupo ?>" aria-expanded="true" class="collapsed">
                                                                                                <?= $itemgrupo->designacaogrupoexame ?>
                                                                                            </a>
                                                                                        </h4>
                                                                                    </div>
                                                                                    <div id="collapse<?= $contItemGrupo ?>" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                                                        <div class="box-body">
                                                                                            <?php foreach ($this->baseexame->getresultadoexamegrupo($pedido_id, $resultado->idexame, $itemgrupo->idgrupoexame) as $resultadositem) { ?>
                                                            
                                                                                                <div class="col-md-12">
                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <input type="hidden" name="ids[]" value="<?= $resultadositem->id ?>">
                                                                                                            <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $resultadositem->designacaoitem ?></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <textarea class="form-control" name="resultados[]" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $resultadositem->resultado ?></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <select class="form-control" id="estado" name="estados[]" required>
                                                                                                                <option value="1" <?= ($resultadositem->estado == 1) ? 'selected' : '' ?>>ALTO</option>
                                                                                                                <option value="2" <?= ($resultadositem->estado == 2) ? 'selected' : '' ?>>NORMAL</option>
                                                                                                                <option value="3" <?= ($resultadositem->estado == 3) ? 'selected' : '' ?>>BAIXO</option>
                                                                                                                <option value="4" <?= ($resultadositem->estado == 4) ? 'selected' : '' ?>>NEGATIVO</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $resultadositem->valor ?></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>

                                                                                            <?php } ?>

                                                                                        </div>
                                                                                    </div>

                                                                            </div>
                                                                        <?php } ?>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }  ?>




                                            <?php }  ?>
                                        <?php } ?>


                                    </tbody>
                                </table>
                                <label for="">Observação</label>
                                <textarea class="form-control" name="observacao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $resultados[0]->observacao ?></textarea>

                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="submit" class="btn btn-default">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->