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
                <h4>RECEITA</h4>
								                           <?php
                                $peso_aux = 0;
                                foreach ($dados["fichaclinica"] as $valor) {
									$peso_aux = $valor->peso;
								}
                                ?>
                <b>NOME: </b><?= $dados["paciente"][0]->nome ?><br>
<!--                 <b>IDADE: </b><?= date('Y') - date('Y', strtotime($dados["paciente"][0]->data)); ?> ANOS<br> -->
                <b>PESO: </b><?=$peso_aux?> Kg<br>
                <b>MORADA: </b><?= $dados["paciente"][0]->bairro ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">
                        <!--            <div class="col-md-4">
                            <label for="">Cardapio</label>
                            <select class="form-control" name="idcardapio" required>
                                <?php foreach ($dados['cardapio'] as $valor) { ?>
                                    <option value="<?= $valor->id ?>"><?= $valor->designacao ?></b></option>
                                <?php } ?>
                            </select><br>
                        </div> -->


                        <form role="form" action="<?= base_url() ?>clinico/cadastrarreceita" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idpaciente" value="<?= $dados["paciente"][0]->id ?>" />
                             <a style="margin-right: 5px; margin-top: 15px;" href="<?= base_url(); ?>clinico/dadosclinico/<?= $dados["paciente"][0]->id; ?>" class="btn btn-success">Dados Clínico</a>
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descrição da Receita</label>
                                        <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"></textarea>
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
                            <h4><b>Dados Clínicos</b></h4>
                        </div>
                        <table id="example1" class="table table-bordered table-striped">
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
                                foreach ($dados["receita"] as $valor) {
                                ?>
                                    <tr>
                                        <td><?= ++$cont ?></td>
                                        <td><?= $valor->idreceita ?></td>
                                        <td><?= date('d/m/Y', strtotime($valor->datareceita)); ?></td>

                                        <td>
                                            <a href="<?= base_url() ?>clinico/editarreceita/<?= $valor->idreceita ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Editar Receitas</a>
                                            <a onclick="imprimirreceita('<?= $valor->idreceita; ?>');" class="btn btn-primary"> <i class="glyphicon glyphicon-print"></i> Imprimir</a>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>

											<a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>clinico/eliminarreceita/<?= $valor->idreceita; ?>/<?= $dados['paciente'][0]->id ?> ':''"  class="btn btn-danger">Eliminar</a>                           

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
