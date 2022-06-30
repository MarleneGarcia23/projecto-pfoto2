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
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" action="<?= base_url() ?>correio/emaillicenca" method="post" enctype="multipart/form-data">
                        <div class="box-header with-border">
                            <h3 class="box-title">Nova Mensagem</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form-group">
                                <input type="hidden" name="email" value="suporte@sublime.com" class="form-control" placeholder="Para:" required>
                                <input type="email" value="suporte@sublime.com" class="form-control" placeholder="Para:" disabled>
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

