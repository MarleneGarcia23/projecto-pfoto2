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
                <h4>DADOS CLÍNICOS</h4>
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
                    <!-- /.box-header -->
                    <div class="box-body">
                        <a href="<?= base_url(); ?>clinico/fichaclinica/<?= $paciente->id; ?>" class="btn btn-success">Ficha Clínica</a>
                        <a href="<?= base_url(); ?>clinico/pedidoexame/<?= $paciente->id; ?>" class="btn btn-primary">Pedido Exame</a>
                        <a href="#" data-toggle="modal" data-target="#modal-historico-exame" class="btn btn-warning">Historico de Resultados dos Exames </a>
                        <a href="<?= base_url(); ?>clinico/receita/<?= $paciente->id; ?>" class="btn btn-info">Receita</a>
                          <a href="#" data-toggle="modal" data-target="#modal-historico-receita" class="btn btn-warning">Historico das Receitas </a>
                        <?php if ($paciente->genero == 'FEMININO') { ?>
                            <a href="<?= base_url(); ?>clinico/periodomenstrual/<?= $paciente->id; ?>" class="btn btn-danger">Periodo Mestrual</a>
                        <?php  } ?>
                        <a href="<?= base_url(); ?>clinico/cpfiv/<?= $paciente->id; ?>" class="btn btn-danger">Controlo de Procedimento FIV</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<!-- /.content -->


<div class="modal fade" id="modal-historico-exame">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Historico de Resultados dos Exames</h4>
            </div>
            <div class="modal-body" >
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Código Exame</th>
                            <th>Paciente</th>
                            <th>Identificação</th>
                            <th>Telefone</th>
                            <th>Data Exame</th>

                            <th>Opcões</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $cont = 1; ?>
                        <?php foreach ($historicoexame as $valor) { ?>
                            <tr>
                                <td><?= $cont++ ?></td>
                                <td style="color: blue; text-align: center;"><b><?= $valor->idpedido ?></b></td>
                                <td><?= $valor->nome; ?></td>
                                <td><?= $valor->ndi; ?></td>
                                <td><?= $valor->telefone; ?></td>
                                <td><?= date('d/m/Y', strtotime($valor->dataresultadoexame)); ?></td>
                                <td>
                                    <a onclick="imprimirall('<?= base_url() . 'clinico/imprimirresultadoexame/' . $valor->idpedido; ?>');" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimir</a>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-historico-receita">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Historico das Receitas</h4>
            </div>
            <div class="modal-body" >
            <table id="example3" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Receita Nº</th>
                                    <th>Data</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody name="dadosfichaclinica">

                                <?php
                                $cont = 0;
                                foreach ($historicoreceita as $valor) {
                                ?>
                                    <tr>
                                        <td><?= ++$cont ?></td>
                                        <td><?= $valor->idreceita ?></td>
                                        <td><?= date('d/m/Y', strtotime($valor->datareceita)); ?></td>

                                        <td>
                                            <a onclick="imprimirreceita('<?= $valor->idreceita; ?>');" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimir</a>
                                           
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
            </div>
        </div>
    </div>
</div>
<!--******* RODAPE *******-->