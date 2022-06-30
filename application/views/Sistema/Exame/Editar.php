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
                    <form role="form" action="<?= base_url() ?>exame/actualizar" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $dados[0]->id ?>" />
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Designação</label>
                                         <textarea id="editor" class="form-control" name="designacao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" required><?= $dados[0]->designacao ?></textarea>
                                </div>
                            </div>

                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Valor de Referência</label>
                                    <textarea id="editor" class="form-control" name="valor" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->valor ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descrição</label>
                                    <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->descricao ?></textarea>
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

