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
        <?php if ($this->input->get('key') == 1) { ?>
            <!-- general form elements -->
            <div name="mensagem" class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="fa fa-check"></i>Sucesso!</h4>
            </div>
        <?php } ?>
        <?php if ($this->input->get('key') == 2) { ?>
            <div name="mensagem" class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="fa fa-close"></i>Dados Inválidos!</h4>
            </div>
        <?php } ?>
        <div class="col-md-12">
            <div class="callout callout-success">
                <h4>Controlo de Procedimento FIV</h4>
                <?php
                $peso_aux = 0;
                $heigth = 0;
                foreach ($fichaclinica as $fc) {
                    $peso_aux = $fc->peso;
                    $heigth = $fc->altura;
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
                        <b>IDADE: </b><?= date('Y') - date('Y', strtotime($paciente->dataparceiro)) ?><br>
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
                    </div>
                    <div class="box-body">

                        <form role="form" action="<?= base_url() ?>clinico/cadastrarcpfiv" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idpaciente" value="<?= $paciente->id ?>" />

                            <div class="box-group" id="accordion">
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" class="collapsed">
                                                CARACTERÍSTICAS DO CICLO
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse1" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Tratamento de PMA</label>
                                                    <input type="text" name="cpfiv_s1_i1" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Técnica de inseminação ovocitária</label>
                                                    <input type="text" name="cpfiv_s1_i2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Sémen (origem)</label>
                                                    <input type="text" name="cpfiv_s1_i3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="cpfiv_s1_i4" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">Casal submetido a um tratamento de Procriação Medicamente Assistida pela/s seguintes/s causas/s: Aborto de repetição, Idade materna.
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="cpfiv_s1_i5" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">O IVI é um centro de reprodução assistida autorizado pela autoridade competente de Portugal, o CNPMA.
                                                    </textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="true" class="collapsed">
                                                OBTENÇÃO DE OVÓCITOS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse2" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Data</label>
                                                    <input type="date" name="cpfiv_s2_i1" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Origem ovócitos</label>
                                                    <input type="text" name="cpfiv_s2_i2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nº ovócitos recuperados</label>
                                                    <input type="text" name="cpfiv_s2_i3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Nº ovócitos desvitrificados / sobrevivem </label>
                                                    <input type="text" name="cpfiv_s2_i4" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="true" class="collapsed">
                                                OVÓCITOS RECUPERADOS
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse3" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">
                                            <h5 style="background-color: #bcbcbc;"><b>MICROINJECÇÃO INTRACITOPLASMÁTICA (ICSI)</b></h5>
                                            </br>

                                            <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-itemcpfiv">
                                                <thead>
                                                    <tr>
                                                        <th>OVÓCITOS MADUROS</th>
                                                        <th>OVÓCITOS IMADUROS</th>
                                                        <th>FECUNDAÇÃO</th>
                                                        <th>Opcões</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" name="cpfiv_s3_i1_1_table-itemcpfiv" class="form-control input-sm" placeholder="OVÓCITOS MADUROS">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s3_i1_2_table-itemcpfiv" class="form-control input-sm" placeholder="OVÓCITOS IMADUROS">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s3_i1_3_table-itemcpfiv" class="form-control input-sm" placeholder="FECUNDAÇÃO">
                                                        </td>

                                                        <td>
                                                            <a onclick="adicionarcpfiv('table-itemcpfiv')" class="btn btn-default btn-sm">
                                                                <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                            </br>
                                            <hr>
                                            </br>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">TOTAL DE OVÓCITOS DESTINADOS A ICSI:</label>
                                                    <input type="text" name="cpfiv_s3_i2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">TOTAL DE OVÓCITOS DESTINADOS A FIV:</label>
                                                    <input type="text" name="cpfiv_s3_i3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">TOTAL DE ZIGOTOS OBTIDOS:</label>
                                                    <input type="text" name="cpfiv_s3_i4" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" class="collapsed">
                                                SÉMEN
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse4" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Origem</label>
                                                    <input type="text" name="cpfiv_s4_i1" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Estado</label>
                                                    <input type="text" name="cpfiv_s4_i2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Procedência</label>
                                                    <input type="text" name="cpfiv_s4_i3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Tipo de inseminação</label>
                                                    <input type="text" name="cpfiv_s4_i4" class="form-control">
                                                </div>
                                            </div>


                                            </br>
                                            <hr>
                                            </br>
                                            <h5>O espermograma no dia punção apresentava os seguintes valores:</h5>
                                            <table class="table table-condensed table-bordered table-striped table-hover table-form">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>PRE-CAPACITAÇÃO</th>
                                                        <th>PÓS-CAPACITAÇÃO</th>

                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" value="Volume ( ml.)" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_1_1" class="form-control input-sm">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_1_2" class="form-control input-sm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" value="Concentração (milhões/ml)" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_2_1" class="form-control input-sm">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_2_2" class="form-control input-sm">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" value="Mobilidade progressiva (%)" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_3_1" class="form-control input-sm">
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cpfiv_s4_i5_3_2" class="form-control input-sm">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse5" aria-expanded="true" class="collapsed">
                                                DIAGNÓSTICO GENÉTICO PREIMPLANTAÇÃO (PGT-A)
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse5" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Indicação</label>
                                                    <input type="text" name="cpfiv_s5_i1" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Dia da biópsia</label>
                                                    <input type="text" name="cpfiv_s5_i2" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Embriões informativos</label>
                                                    <input type="text" name="cpfiv_s5_i3" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Embriões normais/não afectos</label>
                                                    <input type="text" name="cpfiv_s5_i4" class="form-control">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse6" aria-expanded="true" class="collapsed">
                                                RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse6" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                        <div class="box-body">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Data da transferência</label>
                                                    <input type="date" name="cpfiv_s6_i1" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Motivo de não ter ocorrido transferência</label>
                                                    <input type="text" name="cpfiv_s6_i2" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Embriões em observação </label>
                                                    <input type="text" name="cpfiv_s6_i3" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Embriões criopreservados</label>
                                                    <input type="text" name="cpfiv_s6_i4" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="cpfiv_s6_i5" style="margin: 0px -17.6563px 0px 0px;  height: 143px;">Não restam embriões criopreservados na clínica.
                                                    </textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="box-footer">
                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                            </div>
                        </form>
                        <br>
                        <br>
                        <hr>
                        <br>
                        <br>
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) : ?>
                            <div class="box-header">

                                <h4><b>Controlo de Procedimento FIV</b></h4>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Nome</th>
                                        <th>Companheiro</th>
                                        <th>Data da Conheita</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody name="dadoscpfiv">

                                    <?php
                                    $cont = 0;
                                    foreach ($cpfiv as $item) {
                                    ?>
                                        <tr>
                                            <td><?= date('d/m/Y', strtotime($item->data)); ?></td>
                                            <td><?= $item->nome ?></td>
                                            <td><?= $item->nomeparceiro ?></td>
                                            <td><?= date('d/m/Y', strtotime($item->cpfiv_s2_i1)); ?></td>
                                            <td>

                                                <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) { ?>
                                                    <button class="btn btn-primary btn-sm" onClick="imprimirall('<?= base_url() . 'clinico/imprimircpfiv/' . $item->id ?>');">
                                                        <i class="glyphicon glyphicon-print"></i> 
                                                    </button>
                                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-cpfiv<?= $item->id ?>"><i class="glyphicon glyphicon-edit"></i></button>
                                                    <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>clinico/eliminarcpfiv/<?= $item->id; ?>?idpaciente=<?= $item->idpaciente; ?>':''" class="btn btn-danger"> <i class="glyphicon glyphicon-remove"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>




                                    <?php } ?>

                                </tbody>
                            </table>
                        <?php endif; ?>
                        <?php foreach ($cpfiv as $item) { ?>
                            <div class="modal fade" id="modal-cpfiv<?= $item->id ?>">
                                <div class="modal-dialog" style="height: 600px; width: 1400px;">
                                    <form action="<?= base_url() ?>clinico/actualizarcpfiv" method="post">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Controlo de Procedimento FIV</h4>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $item->id ?>" />
                                                <input type="hidden" name="idpaciente" value="<?= $paciente->id ?>" />
                                                <div class="box-group" id="accordion">
                                                    <div class="panel box box-primary">
                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE1" aria-expanded="true" class="collapsed">
                                                                    CARACTERÍSTICAS DO CICLO
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE1" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Tratamento de PMA</label>
                                                                        <input type="text" name="cpfiv_s1_i1" value="<?= $item->cpfiv_s1_i1 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Técnica de inseminação ovocitária</label>
                                                                        <input type="text" name="cpfiv_s1_i2" value="<?= $item->cpfiv_s1_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Sémen (origem)</label>
                                                                        <input type="text" name="cpfiv_s1_i3" value="<?= $item->cpfiv_s1_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="cpfiv_s1_i4" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $item->cpfiv_s1_i4 ?></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="cpfiv_s1_i5" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $item->cpfiv_s1_i5 ?>
                                                    </textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE2" aria-expanded="true" class="collapsed">
                                                                    OBTENÇÃO DE OVÓCITOS
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE2" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Data</label>
                                                                        <input type="date" name="cpfiv_s2_i1" value="<?= $item->cpfiv_s2_i1 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Origem ovócitos</label>
                                                                        <input type="text" name="cpfiv_s2_i2" value="<?= $item->cpfiv_s2_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nº ovócitos recuperados</label>
                                                                        <input type="text" name="cpfiv_s2_i3" value="<?= $item->cpfiv_s2_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="">Nº ovócitos desvitrificados / sobrevivem </label>
                                                                        <input type="text" name="cpfiv_s2_i4" value="<?= $item->cpfiv_s2_i4 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE3" aria-expanded="true" class="collapsed">
                                                                    OVÓCITOS RECUPERADOS
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE3" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">
                                                                <h5 style="background-color: #bcbcbc;"><b>MICROINJECÇÃO INTRACITOPLASMÁTICA (ICSI)</b></h5>
                                                                </br>

                                                                <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-itemcpfiv-edit">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>OVÓCITOS MADUROS</th>
                                                                            <th>OVÓCITOS IMADUROS</th>
                                                                            <th>FECUNDAÇÃO</th>
                                                                            <th>Opcões</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s3_i1_1_table-itemcpfiv-edit" class="form-control input-sm" placeholder="OVÓCITOS MADUROS">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s3_i1_2_table-itemcpfiv-edit" class="form-control input-sm" placeholder="OVÓCITOS IMADUROS">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s3_i1_3_table-itemcpfiv-edit" class="form-control input-sm" placeholder="FECUNDAÇÃO">
                                                                            </td>

                                                                            <td>
                                                                                <a onclick="adicionarcpfiv('table-itemcpfiv-edit')" class="btn btn-default btn-sm">
                                                                                    <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php foreach ($this->basecpfivitem->getId($item->id) as $cpfivitem) { ?>
                                                                            <tr>
                                                                                <td><input type="text" name="cpfiv_s3_i1_1[]" class="form-control" value="<?= $cpfivitem->cpfiv_s3_i1_1 ?>"></td>
                                                                                <td><input type="text" name="cpfiv_s3_i1_2[]" class="form-control" value="<?= $cpfivitem->cpfiv_s3_i1_2 ?>"></td>
                                                                                <td><input type="text" name="cpfiv_s3_i1_3[]" class="form-control" value="<?= $cpfivitem->cpfiv_s3_i1_3 ?>"></td>
                                                                                <td><button class="btn btn-default btn-sm" onClick="remove_itemcpfiv(this);">
                                                                                        <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td>
                                                                            </tr>
                                                                        <?php } ?>

                                                                    </tbody>
                                                                </table>
                                                                </br>
                                                                <hr>
                                                                </br>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">TOTAL DE OVÓCITOS DESTINADOS A ICSI:</label>
                                                                        <input type="text" name="cpfiv_s3_i2" value="<?= $item->cpfiv_s3_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">TOTAL DE OVÓCITOS DESTINADOS A FIV:</label>
                                                                        <input type="text" name="cpfiv_s3_i3" value="<?= $item->cpfiv_s3_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">TOTAL DE ZIGOTOS OBTIDOS:</label>
                                                                        <input type="text" name="cpfiv_s3_i4" value="<?= $item->cpfiv_s3_i4 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE4" aria-expanded="true" class="collapsed">
                                                                    SÉMEN
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE4" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Origem</label>
                                                                        <input type="text" name="cpfiv_s4_i1" value="<?= $item->cpfiv_s4_i1 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Estado</label>
                                                                        <input type="text" name="cpfiv_s4_i2" value="<?= $item->cpfiv_s4_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Procedência</label>
                                                                        <input type="text" name="cpfiv_s4_i3" value="<?= $item->cpfiv_s4_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Tipo de inseminação</label>
                                                                        <input type="text" name="cpfiv_s4_i4" value="<?= $item->cpfiv_s4_i4 ?>" class="form-control">
                                                                    </div>
                                                                </div>


                                                                </br>
                                                                <hr>
                                                                </br>
                                                                <h5>O espermograma no dia punção apresentava os seguintes valores:</h5>
                                                                <table class="table table-condensed table-bordered table-striped table-hover table-form">
                                                                    <thead>
                                                                        <tr>
                                                                            <th></th>
                                                                            <th>PRE-CAPACITAÇÃO</th>
                                                                            <th>PÓS-CAPACITAÇÃO</th>

                                                                        </tr>

                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control input-sm" value="Volume ( ml.)" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_1_1" value="<?= $item->cpfiv_s4_i5_1_1 ?>" class="form-control input-sm">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_1_2" value="<?= $item->cpfiv_s4_i5_1_2 ?>" class="form-control input-sm">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control input-sm" value="Concentração (milhões/ml)" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_2_1" value="<?= $item->cpfiv_s4_i5_2_1 ?>" class="form-control input-sm">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_2_2" value="<?= $item->cpfiv_s4_i5_2_2 ?>" class="form-control input-sm">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <input type="text" class="form-control input-sm" value="Mobilidade progressiva (%)" readonly>
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_3_1" value="<?= $item->cpfiv_s4_i5_3_1 ?>" class="form-control input-sm">
                                                                            </td>
                                                                            <td>
                                                                                <input type="text" name="cpfiv_s4_i5_3_2" value="<?= $item->cpfiv_s4_i5_3_2 ?>" class="form-control input-sm">
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>

                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE5" aria-expanded="true" class="collapsed">
                                                                    DIAGNÓSTICO GENÉTICO PREIMPLANTAÇÃO (PGT-A)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE5" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Indicação</label>
                                                                        <input type="text" name="cpfiv_s5_i1" value="<?= $item->cpfiv_s5_i1 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Dia da biópsia</label>
                                                                        <input type="text" name="cpfiv_s5_i2" value="<?= $item->cpfiv_s5_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Embriões informativos</label>
                                                                        <input type="text" name="cpfiv_s5_i3" value="<?= $item->cpfiv_s5_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Embriões normais/não afectos</label>
                                                                        <input type="text" name="cpfiv_s5_i4" value="<?= $item->cpfiv_s5_i4 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="box-header with-border">
                                                            <h4 class="box-title">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseE6" aria-expanded="true" class="collapsed">
                                                                    RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseE6" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                                            <div class="box-body">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Data da transferência</label>
                                                                        <input type="date" name="cpfiv_s6_i1" value="<?= $item->cpfiv_s6_i1 ?>" class="form-control" >
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Motivo de não ter ocorrido transferência</label>
                                                                        <input type="text" name="cpfiv_s6_i2" value="<?= $item->cpfiv_s6_i2 ?>" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Embriões em observação </label>
                                                                        <input type="text" name="cpfiv_s6_i3" value="<?= $item->cpfiv_s6_i3 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Embriões criopreservados</label>
                                                                        <input type="text" name="cpfiv_s6_i4" value="<?= $item->cpfiv_s6_i4 ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <textarea class="form-control" name="cpfiv_s6_i5" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $item->cpfiv_s6_i5 ?>
                                                    </textarea>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->