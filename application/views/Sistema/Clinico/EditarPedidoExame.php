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
                /* $peso_aux = 0;
                foreach ($dados["fichaclinica"] as $valor) {
                    $peso_aux = $valor->peso;
                } */
                ?>
                <b>NOME: </b><?= $paciente->nome ?><br>
                <!--         <b>IDADE: </b><?= date('Y') - date('Y', strtotime($dados["paciente"][0]->data)); ?> ANOS<br> -->
                <b>PESO: </b><?= 0 ?> Kg<br>
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



                        <form role="form" action="<?= base_url() ?>clinico/editarpedidoexame" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="pedido_id" value="<?= $pedido_id ?>" />
                            <div class="box-body">
                                <?php $contadorExame = 0;
                                foreach ($exames as $exame) {
                                    foreach ($itens as $item) {
                                        if ($item->idexame == $exame->id) {
                                            $contadorExame++;
                                        }
                                    }
                                } ?>
                                <h4><b>Preencha os campos:</b> <b style="color: red;" name="contadorExame"> <?= $contadorExame ?></b></h4>


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
                                        <?php foreach ($exames as $exame) { ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td> <?= strtoupper($exame->designacao) ?></td>
                                                <td> <input name="exames[]" value="<?= $exame->id ?>" type="checkbox" onclick="contadorExame(checked,<?= $contadorExame ?>);" <?php foreach ($itens as $item) {
                                                                                                                                                                                    if ($item->idexame == $exame->id) {
                                                                                                                                                                                        echo 'checked';

                                                                                                                                                                                        break;
                                                                                                                                                                                    }
                                                                                                                                                                                } ?>></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>


                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="<?= base_url() ?>clinico/listarpedidoexame" class="btn btn-default">Cancelar</a>
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