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
                    <form role="form" action="<?= base_url() ?>evento/actualizar" method="post">
                        <input type="hidden" name="id" value="<?= $dados['evento'][0]->id ?>" />
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tipo de Evento</label>
                                    <select class="form-control" id="tipoevento" name="tipoevento" required>
                                        <?php foreach ($dados['tipoevento'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Data de Começo</label>
                                    <input type="date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control" name="data1"required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Data de Término</label>
                                    <input type="date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control" name="data2"required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descrição</label>
                                    <textarea class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $dados['evento'][0]->descricao ?></textarea>
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

