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
                foreach ($fichaclinica as $valor) {
                    $peso_aux = $valor->peso;
                }
                ?>
                <b>NOME: </b><?= $paciente->nome ?><br>
                <!--                 <b>IDADE: </b><?= date('Y') - date('Y', strtotime($paciente->data)); ?> ANOS<br> -->
                <b>PESO: </b><?= $peso_aux ?> Kg<br>
                <b>MORADA: </b><?= $paciente->bairro ?><br>
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


                        <form role="form" action="<?= base_url() ?>clinico/actualizarreceita" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="idreceita" value="<?= $receita->idreceita ?>" />
                            <input type="hidden" name="idpaciente" value="<?= $paciente->id ?>" />
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Descrição da Receita</label>
                                        <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $receita->descricao ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="salvar" class="btn btn-primary">Actualizar</button>
                                <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
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