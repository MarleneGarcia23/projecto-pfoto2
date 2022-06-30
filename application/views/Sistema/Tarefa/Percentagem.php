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
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>ACTUALIZAR <?= strtoupper($this->uri->segment(1)) ?></b></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>tarefa/actualizarnivel" method="post">
                        <input type="hidden" name="id" value="<?= $dados['tarefa'][0]->idtarefa ?>" />
                        <div class="box-body">
                            <div class="panel-body">
                                <p class="col-sm-6 col-lg-offset-3 kl-fancy-form">
                                    <input type="number" class="form-control text-center" name="nivel" value="<?= $dados['tarefa'][0]->nivel ?>" placeholder="Insira à percentagem da Tarefa" required>
                                </p>
                            </div>
                            <div class="box-footer" style="text-align:center">
                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->