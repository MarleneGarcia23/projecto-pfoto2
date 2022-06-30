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

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?= base_url() ?>correio/caixa" class="btn btn-primary btn-block margin-bottom">Caixa de Correio</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pastas</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?= base_url() ?>correio/caixa"><i class="fa fa-inbox"></i>Caixa
                                </a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <form role="form" action="<?= base_url() ?>correio/cadastraremailmassa" method="post" enctype="multipart/form-data">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nova Mensagem</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Departamento</label>
                                <select class="form-control"  name="departamento" required>
                                    <?php foreach ($dados['departamento'] as $valor) { ?>
                                        <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="assunto" placeholder="Assunto:" required>
                            </div>
                            <div class="form-group">
                                <textarea id="compose-textarea" name="conteudo" class="form-control" style="height: 300px" required>
                      
                                </textarea>
                            </div>
                            <div class="form-group">
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip"></i>Anexo
                                    <input type="file" name="arquivo">
                                </div>
                                <p class="help-block">Max. 5MB</p>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" name="salvar" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Enviar</button>
                            </div>
                            <button type="reset" class="btn btn-default"><i class="fa fa-times"></i>Cancelar</button>
                        </div>
                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<!--******* RODAPE *******-->
