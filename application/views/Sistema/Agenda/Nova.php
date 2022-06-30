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
                        <h3 class="box-title"><b>CADASTRAR <?= strtoupper($this->uri->segment(1)) ?></b></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>agenda/cadastrar" method="post">
                        <div class="box-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input type="text" class="form-control"  name="nome" placeholder="Cliente" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Identificação</label>
                                    <input type="text" class="form-control"  name="ndi" placeholder="Ex: 111111111LA111" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Serviço</label>
                                    <select class="form-control" name="servico" required>
                                        <?php foreach ($dados['servico'] as $valor) { ?>
                                            <option value="<?= $valor->id ?>" ><?= $valor->designacao ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control" name="telefone" placeholder="Ex: (+244) 923 222 333" required>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Ex: sistemahospitalar@gmail.com"  required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label >Data </label>
                                    <input type="date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control" name="data"required>
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

