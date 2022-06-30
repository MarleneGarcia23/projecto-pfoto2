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
                <h4>PEDIDO DE EXAME</h4>
                <?php
                $peso_aux = 0;
                foreach ($dados["fichaclinica"] as $valor) {
                    $peso_aux = $valor->peso;
                }
                ?>
                <b>NOME: </b><?= $dados["paciente"][0]->nome ?><br>
                <!--         <b>IDADE: </b><?= date('Y') - date('Y', strtotime($dados["paciente"][0]->data)); ?> ANOS<br> -->
                <b>PESO: </b><?= $peso_aux ?> Kg<br>
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


                        <form role="form" action="<?= base_url() ?>clinico/cadastrarpedidoexame" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idpaciente" value="<?= $dados["paciente"][0]->id ?>" />
                            <div class="box-body">
                                <a style="margin-right: 5px; margin-top: 15px;" href="<?= base_url(); ?>clinico/dadosclinico/<?= $dados["paciente"][0]->id; ?>" class="btn btn-success">Dados Clínico</a>
                                <h4><b>Preencha os campos:</b> <b style="color: red;" name="contadorExame"> </b></h4>

                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Designação</th>
                                            <th>Marcação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 1; ?>
                                        <?php foreach ($dados["exame"] as $valor) { ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td> <?= strtoupper($valor->designacao) ?></td>
                                                <td> <input name="<?= $valor->id ?>" value="<?= $valor->id ?>" onclick="contadorExame(checked,0);" type="checkbox"></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <!--          <?php foreach ($dados["exame"] as $valor) { ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input name="<?= $valor->id ?>" value="<?= $valor->id ?>" type="checkbox">
                                                    <?= strtoupper($valor->designacao) ?>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?> -->
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                                <button type="submit" class="btn btn-default">Cancelar</button>
                            </div>
                        </form>

                        <br>
                        <h4><b>Listar Dados</b></h4>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pedido</th>
                                    <th>Data</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["pedidoexame"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->idpedidoexame; ?></td>
                                        <td><?= date('d-m-Y', strtotime($valor->datapedidoexame)); ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>clinico/mostrarpedidoexame/<?= $valor->idpedidoexame; ?>" class="btn btn-primary">Editar</a>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
                                                <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>clinico/eliminarpedidoexame/<?= $valor->idpedidoexame; ?>/<?= $dados['paciente'][0]->id ?>':''" class="btn btn-danger">Eliminar</a>
                                                <a href="<?= base_url(); ?>clinico/imprimiritempedidoexame/<?= $valor->idpedidoexame; ?>" target="_blank" class="btn btn-success">Imprimir</a>

                                            <?php } ?>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->