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
                    <form role="form" action="<?= base_url() ?>atendimento/actualizar" method="post">
                        <input type="hidden" name="id" value="<?= $dados["atendimento"][0]->id ?>" />
                        <div class="box-body">                          
                            <div class="col-md-4">
                                <div class="box ">
                                    <div class="box-body box-profile">
                                        <img class="img-responsive" style="height:200px;"src="<?= base_url() ?>assets/media/imagem/<?= $dados['servico'][0]->imagem ?>">
                                        <h3 class="profile-username text-center"><?= $dados['servico'][0]->designacao ?></h3>

                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b>Preço</b> <a class="pull-right"><?= $dados['servico'][0]->valor ?>(AKZ)</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>    
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Cliente:</label>
                                    <input type="text" class="form-control" name=cliente" value="<?= $dados["atendimento"][0]->nome ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Quantidade</label>
                                    <input type="number" min="1" value="<?= $dados["atendimento"][0]->qtd ?>" class="form-control"  name="qtd" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Data</label>
                                    <input type="date" min="<?= date('Y-m-d') ?>" value="<?= $dados["atendimento"][0]->data?>" class="form-control" name="data" required>
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

