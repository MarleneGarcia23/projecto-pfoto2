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
                        <h3 class="box-title">Nova Servico</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>servico/actualizar" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $dados[0]->id ?>" />
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Servico</label>
                                    <input type="text" class="form-control"  name="designacao" value="<?= $dados[0]->designacao ?>" placeholder="Ex: 10ª" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                        <img src="<?= base_url() ?>assets/media/imagem/<?= $dados[0]->imagem ?>"  style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt=""/>
                                    </div>
                                    <div class="btn btn-default btn-file">
                                        <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                        <input type="file" id="arquivo" name="arquivo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <label >Valor</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="valor" value="<?= $dados[0]->valor ?>" placeholder="Ex: 1000.00 " required>
                                    <span class="input-group-addon">.00</span>
                                </div><br>
                                <label >Imposto</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" name="imposto" value="<?= $dados[0]->imposto ?>" placeholder="Ex: 1000.00 " required>
                                    <span class="input-group-addon">.00</span>
                                </div>           
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descrição</label>
                                    <textarea class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $dados[0]->descricao ?></textarea>
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

