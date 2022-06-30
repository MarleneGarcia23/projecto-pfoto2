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
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>CADASTRAR <?= strtoupper($this->uri->segment(1)) ?></b></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?= base_url() ?>atendimento/cadastrar" method="post">
                <input type="hidden" class="form-control"  name="idservico" value="<?= $dados['servico'][0]->id ?>">
                <input type="hidden" class="form-control"  name="valor" value="<?= $dados['servico'][0]->valor ?>">
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
                            <label>Cliente</label>
                            <select class="form-control" name="cliente" required>
                                <?php foreach ($dados['cliente'] as $valor) { ?>
                                    <option value="<?= $valor->id ?>" ><?= $valor->nome ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Quantidade</label>
                            <input type="number" min="1" value="1" class="form-control"  name="qtd" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Data</label>
                            <input type="date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control" name="data" required>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                    <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

