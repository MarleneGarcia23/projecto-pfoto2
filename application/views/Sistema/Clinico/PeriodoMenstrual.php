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
                <?php
                $peso_aux = 0;
                foreach ($dados["fichaclinica"] as $valor) {
                    $peso_aux = $valor->peso;
                }
                ?>
                <h4>PERÍODO MENSTRUAL</h4>
                <b>NOME: </b><?= $dados["paciente"][0]->nome ?><br>
                <b>IDADE: </b><?= date('Y') - date('Y', strtotime($dados["paciente"][0]->data)); ?> ANOS (<?= date('d-m-Y', strtotime($dados["paciente"][0]->data)); ?>)<br>
                <b>PESO: </b><?= $peso_aux ?> Kg<br>
                <b>MORADA: </b><?= $dados["paciente"][0]->bairro ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                    <a style="margin-right: 5px; margin-top: 15px;" href="<?= base_url(); ?>clinico/dadosclinico/<?= $dados["paciente"][0]->id; ?>" class="btn btn-success">Dados Clínico</a>
                                <?php if (count($dados["periodomenstrual"]) != 0) { ?>
                            <button type="button" class="btn btn-info pull-left" style="margin-right: 5px; margin-top: 15px;" onClick="imprimirperiodomenstrual(<?= $dados["paciente"][0]->id ?>);">
                                <i class="glyphicon glyphicon-print"></i> Imprimir
                            </button>
                        <?php } ?>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">


                        <form role="form" action="<?= base_url() ?>clinico/cadastrarperiodomenstrual" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idpaciente" value="<?= $dados["paciente"][0]->id ?>" />
                          <div class="box-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Data Da Ultima Menstruação</label>
                                        <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" id="data1" name="data1" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dias De Duração Da Menstruação</label>
                                        <input type="text" value="4" class="form-control" id="dia" name="dia" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Dias De Duração Do Ciclo Menstrual</label>
                                        <input type="text" value="28" class="form-control" id="dias" name="dias" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descrição</label>
                                        <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">
                                    </textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                            </div>
                        </form>
                        <div class="box-header">
                            <br>
                            <h4><b>Dados Do Período Mestrual</b></h4>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Data Da Ultima Menstruação</th>
                                    <th>Dias De Duração Da Menstruação</th>
                                    <th>Dias De Duração Do Ciclo Menstrual</th>
                                    <th>Data Da Proxima Menstruação</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody name="dadosperiodomenstrual">

                                <?php
                                $cont = 0;
                                foreach ($dados["periodomenstrual"] as $valor) {
                                ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($valor->data1)); ?></td>
                                        <td><?= $valor->dia ?></td>
                                        <td><?= $valor->dias ?></td>
                                        <td><?= date('d/m/Y', strtotime($valor->data2)); ?></td>

                                        <td>

                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-periodomenstrual<?= $valor->id ?>"><i class="glyphicon glyphicon-play"></i></button>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-editarperiodomenstrual<?= $valor->id ?>"><i class="glyphicon glyphicon-edit"></i></button>
                                                <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>clinico/eliminarperiodomenstrual/<?= $valor->id; ?>?idpaciente=<?= $valor->idpaciente; ?>':''" class="btn btn-danger"> <i class="glyphicon glyphicon-remove"></i></a>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <!-- Editar Ficha Clínica -->

                                    <div class="modal fade" id="modal-editarperiodomenstrual<?= $valor->id ?>">
                                        <div class="modal-dialog">
                                            <form action="<?= base_url() ?>clinico/actualizarperiodomenstrual" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title">Dados Do Período Menstrual</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $valor->id ?>" />
                                                        <input type="hidden" name="idpaciente" value="<?= $dados["paciente"][0]->id ?>" />

                                                        <div class="form-group">
                                                            <label for="">Data Da Ultima Menstruação</label>
                                                            <input type="date" value="<?= date('Y-m-d', strtotime($valor->data1)); ?>" class="form-control" name="data1" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Dias De Duração Da Menstruação</label>
                                                            <input type="text" value="<?= $valor->dia ?>" class="form-control" name="dia" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Dias De Duração Do Ciclo Menstrual</label>
                                                            <input type="text" value="<?= $valor->dias ?>" class="form-control" name="dias" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Descrição</label>
                                                            <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">
                                                            <?= strip_tags($valor->descricao); ?>
                                                        </textarea>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </form>
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <?php
        foreach ($dados["periodomenstrual"] as $valor) {
        ?>
            <div class="modal fade" id="modal-periodomenstrual<?= $valor->id ?>">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Dados Do Período Menstrual</h4>
                        </div>
                        <div class="modal-body">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ciclo</th>
                                        <th>Data de Inicio</th>
                                        <th>Dias</th>
                                        <th>Data de Termino</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="danger">
                                        <td><b>Período Menstrual</b></td>
                                        <td><?= date('d/m/Y', strtotime($valor->data2)); ?></td>
                                        <td><?= $valor->dia ?></td>
                                        <td><?= date('d/m/Y', strtotime('+' . (intval($valor->dia) - 1) . " days", strtotime($valor->data2)));  ?></td>
                                    </tr>
                                    <!--             <tr class="active">
                                        <td><b>Fase Proliferativa</b></td>
                                        <td>01/01/2021</td>
                                        <td>10</td>
                                        <td>01/01/2021</td>
                                    </tr> -->
                                    <tr class="success">
                                        <td><b>Período Fértil</b></td>
                                        <td><?= date('d/m/Y', strtotime('+10 days', strtotime($valor->data1)));  ?></td>
                                        <td>
                                            <?php
                                            $data1 = new DateTime(date('d-m-Y', strtotime('+10 days', strtotime($valor->data1))));
                                            $data2 = new DateTime(date('d-m-Y', strtotime('+16 days', strtotime($valor->data1))));
                                            echo $intervalo = $data1->diff($data2)->d + 1; ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime('+16 days', strtotime($valor->data1)));  ?></td>
                                    </tr>
                                    <tr class="info">
                                        <td><b>Ovulação</b></td>
                                        <td><?= date('d/m/Y', strtotime('+13 days', strtotime($valor->data1)));  ?></td>
                                        <td>
                                            <?php
                                            $data1 = new DateTime(date('d-m-Y', strtotime('+13 days', strtotime($valor->data1))));
                                            $data2 = new DateTime(date('d-m-Y', strtotime('+14 days', strtotime($valor->data1))));
                                            echo $intervalo = $data1->diff($data2)->d + 1; ?>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime('+14 days', strtotime($valor->data1)));  ?></td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->

                </div>
                <!-- /.modal-dialog -->
            </div>
        <?php } ?>

    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->