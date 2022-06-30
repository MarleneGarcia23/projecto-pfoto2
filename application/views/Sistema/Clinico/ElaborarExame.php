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
                <h4>ELABORAR EXAME</h4>
                <b>NOME: </b><?= $dados["paciente"][0]->nome ?><br>
                <!--      <b>IDADE: </b><?= date('Y') - date('Y', strtotime($dados["paciente"][0]->data)); ?> ANOS<br> -->
               <!--  <b>PESO: </b>0<br> -->
                <b>MORADA: </b><?= $dados["paciente"][0]->bairro ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">



                        <form role="form" action="<?= base_url() ?>clinico/cadastrarelaborarexame" method="post" enctype="multipart/form-data">

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



                                        <?php $cont = 0;
                                        foreach ($dados["itempedidoexame"] as $valor) { ?>
                                            <?php if ($valor->isexameitem != 1) { ?>
                                                <?php $cont++; ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="idpedido<?= $cont ?>" value="<?= $dados["idpedido"] ?>" />
                                                        <input type="hidden" name="idpaciente<?= $cont ?>" value="<?= $dados["paciente"][0]->id ?>" />
                                                        <input type="hidden" name="idexame<?= $cont ?>" value="<?= $valor->idexame ?>" />
                                                        <input type="hidden" name="idexameitem<?= $cont ?>" value="0" />
                                                        <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly><?= $valor->designacaoexame ?></textarea>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" name="resultado<?= $cont ?>" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"  required></textarea>
                                                    </td>

                                                    <td>
                                                        <select class="form-control" id="estado" name="estado<?= $cont ?>">
                                                            <option value=""></option>
                                                            <option value="1">ALTO</option>
                                                            <option value="2">NORMAL</option>
                                                            <option value="3">BAIXO</option>
                                                            <option value="4">NEGATIVO</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $valor->valorexame ?></textarea>
                                                    </td>

                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="col-md-12">
                                                            <div class="box box-solid">
                                                                <div class="box-header with-border">
                                                                    <h3 class="box-title"><?= $valor->designacaoexame ?></h3>
                                                                </div>
                                                                <div class="box-body">
                                                                    <div class="box-group" id="accordion">
                                                                        <div class="panel box box-primary">
                                                                            <?php $contItemGrupo = 0;
                                                                            foreach ($this->baseexame->getIdExameItemIdGrupo($valor->idexame) as $itemgrupo) {
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
                                                                                        <?php $contItem = 0;
                                                                                        foreach ($this->baseexame->getIdExameItem($valor->idexame) as $item) {
                                                                                            $contItem++; ?>

                                                                                            <?php if ($itemgrupo->idgrupoexame == $item->idgrupoexame) { ?>
                                                                                                <?php $cont++; ?>
                                                                                                <div class="col-md-12">
                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <input type="hidden" name="idpedido<?= $cont ?>" value="<?= $dados["idpedido"] ?>" />
                                                                                                            <input type="hidden" name="idpaciente<?= $cont ?>" value="<?= $dados["paciente"][0]->id ?>" />
                                                                                                            <input type="hidden" name="idexame<?= $cont ?>" value="<?= $valor->idexame ?>" />
                                                                                                            <input type="hidden" name="idexameitem<?= $cont ?>" value="<?= $item->idexameitem ?>" />
                                                                                                            <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly><?= $item->designacaoitem ?></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <textarea class="form-control" name="resultado<?= $cont ?>" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" required></textarea>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <select class="form-control" id="estado" name="estado<?= $cont ?>" >
                                                                                                                <option value=""></option>
                                                                                                                <option value="1">ALTO</option>
                                                                                                                <option value="2">NORMAL</option>
                                                                                                                <option value="3">BAIXO</option>
                                                                                                                <option value="4">NEGATIVO</option>
                                                                                                            </select>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <div class="col-md-3">
                                                                                                        <div class="form-group">
                                                                                                            <textarea class="form-control" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" readonly> <?= $item->valor ?></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            <?php } ?>
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
                                            <?php } ?>


                                        <?php } ?>


                                    </tbody>
                                </table>
                                <label for="">Observação</label>

                                <textarea class="form-control" name="observacao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"></textarea>

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