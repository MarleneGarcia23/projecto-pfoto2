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
                <h4>FICHA CLÍNICA</h4>
                <?php
                $peso_aux = 0;
                $heigth = 0;
                foreach ($fichaclinica as $fc) {
                    $peso_aux = $fc->peso;
                }
                ?>


                <div class="row">

                    <div class="col-12 col-sm-6 col-md-6 ">
                        <b>NOME: </b><?= $paciente->nome ?><br>
                        <b>IDADE: </b><?= $age . (($age > 1) ? ' ANOS' : ' ANO') ?> e <?= $months_to_birth_day . (($months_to_birth_day > 1) ? ' MESES' : ' MÊS') ?><br>
                        <b>PESO: </b><?= $peso_aux ?> Kg<br>
                        <b>ALTURA: </b><?= $paciente->altura ?> <br>
                        <b>MORADA: </b><?= $paciente->bairro ?><br>
                        <b>TELEFONE: </b><?= $paciente->telefone ?><br>
                        <b>EMAIL: </b><?= $paciente->email ?><br>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 ">
                        <b>NOME PARCEIRO: </b><?= $paciente->nomeparceiro ?><br>
                        <b>IDADE: </b><?= (date('Y', strtotime($paciente->dataparceiro)) > 0 ? date('Y') - date('Y', strtotime($paciente->dataparceiro)):'') ?><br>
                        <b>ALTURA: </b><?= $paciente->alturaparceiro ?> <br>
                        <b>MORADA: </b><?= $paciente->bairroparceiro ?><br>
                        <b>TELEFONE: </b><?= $paciente->telefoneparceiro ?><br>
                        <b>EMAIL: </b><?= $paciente->emailparceiro ?><br>
                    </div>

                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a style="margin-right: 5px; margin-top: 15px;" href="<?= base_url(); ?>clinico/dadosclinico/<?= $paciente->id; ?>" class="btn btn-success">Dados Clínico</a>
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) { ?>
                            <?php if (count($fichaclinica) != 0) { ?>
                                <button type="button" class="btn btn-info pull-left" style="margin-right: 5px; margin-top: 15px;" onClick="imprimirfichaclinica(<?= $paciente->id ?>,0);">
                                    <i class="glyphicon glyphicon-print"></i> Imprimir
                                </button>
                                <button type="button" class="btn btn-info pull-left" style="margin-right: 5px; margin-top: 15px;" onClick="imprimirfichaclinica(<?= $paciente->id ?>,1);">
                                    <i class="glyphicon glyphicon-print"></i> Imprimir Q.C
                                </button>
                            <?php } ?>
                        <?php } ?>

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!--            <div class="col-md-4">
                            <label for="">Cardapio</label>
                            <select class="form-control" name="idcardapio" required>
                                <?php foreach ($cardapio as $valor) { ?>
                                    <option value="<?= $valor->id ?>"><?= $valor->designacao ?></b></option>
                                <?php } ?>
                            </select><br>
                        </div> -->


                        <form role="form" action="<?= base_url() ?>clinico/cadastrarfichaclinica" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idpaciente" value="<?= $paciente->id ?>" />
                            <div class="box-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Data</label>
                                        <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" name="data1" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Peso Kg</label>
                                        <input type="text" value="0" class="form-control" maxlength="15" name="peso" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Temperatura</label>
                                        <input type="text" class="form-control" value="0" maxlength="15" name="temperatura" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">P. Arterial</label>
                                        <input type="text" class="form-control" value="0" maxlength="15" name="pa" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Pulso</label>
                                        <input type="text" class="form-control" value="0" maxlength="15" name="pulso" required>
                                    </div>
                                </div>
                                <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) : ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Proxima Consulta</label>
                                            <input type="date" value="<?= date('Y-m-d'); ?>" class="form-control" maxlength="15" name="data2" required>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Quadro Clínico</label>
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
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) : ?>
                            <div class="box-header">
                                <br>
                                <h4><b>Dados Clínicos</b></h4>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Peso Kg</th>
                                        <th>Temperatura</th>
                                        <th>P. Arterial</th>
                                        <th>Pulso</th>
                                        <th>Proxima Consulta</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody name="dadosfichaclinica">

                                    <?php
                                    $cont = 0;
                                    foreach ($fichaclinica as $valor) {
                                    ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($valor->data1)); ?></td>
                                            <td><?= $valor->peso ?></td>
                                            <td><?= $valor->temperatura ?></td>
                                            <td><?= $valor->pa ?></td>
                                            <td><?= $valor->pulso ?></td>
                                            <td><?= date('d/m/Y', strtotime($valor->data2)); ?></td>

                                            <td>

                                                <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) { ?>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-fichaclinica<?= $valor->id ?>"><i class="glyphicon glyphicon-edit"></i></button>

                                                    <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>clinico/eliminarfichaclinica/<?= $valor->id; ?>?idpaciente=<?= $valor->idpaciente; ?>':''" class="btn btn-danger"> <i class="glyphicon glyphicon-remove"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <!-- Editar Ficha Clínica -->

                                        <div class="modal fade" id="modal-fichaclinica<?= $valor->id ?>">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url() ?>clinico/actualizarfichaclinica" method="post">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Ficha Clinica</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id" value="<?= $valor->id ?>" />
                                                            <input type="hidden" name="idpaciente" value="<?= $paciente->id ?>" />

                                                            <div class="form-group">
                                                                <label for="">Data</label>
                                                                <input type="date" value="<?= date('Y-m-d', strtotime($valor->data1)); ?>" class="form-control" name="data1" required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">Peso Kg</label>
                                                                <input type="text" value="<?= $valor->peso ?>" class="form-control" maxlength="15" name="peso" required>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Temperatura</label>
                                                                <input type="text" value="<?= $valor->temperatura ?>" class="form-control" maxlength="5" name="temperatura" required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">P. Arterial</label>
                                                                <input type="text" class="form-control" value="<?= $valor->pa ?>" maxlength="15" name="pa" required>
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">Pulso</label>
                                                                <input type="text" class="form-control" value="<?= $valor->peso ?>" maxlength="15" name="pulso" required>
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="">Proxima Consulta</label>
                                                                <input type="date" value="<?= date('Y-m-d', strtotime($valor->data2)); ?>" class="form-control" maxlength="15" name="data2" required>
                                                            </div>



                                                            <div class="form-group">
                                                                <label for="">Quadro Clínico</label>
                                                                <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">
                                                            <?= $valor->descricao ?>
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
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->