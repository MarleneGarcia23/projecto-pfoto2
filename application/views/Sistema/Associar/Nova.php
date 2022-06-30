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
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>ASSOCIAR</b></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>associar/cadastrar" method="post">
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Perfil:</label>
                                    <select class="form-control" id="idassociar" name="idperfil" required>
                                        <?php foreach ($dados['perfil'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Modulo:</label>
                                    <select class="form-control" id="idassociar" name="idmodulo" required>
                                        <?php foreach ($dados['modulo'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                            <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

