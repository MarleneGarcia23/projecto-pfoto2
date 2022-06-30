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
            <div class="box box-primary">
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= base_url() ?>utilizador/actualizar" method="post">
                    <input type="hidden" name="id" value="<?= $dados["utilizador"][0]->idutilizador; ?>" />
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="">Utilizador</label>
                                    <input type="text" class="form-control" name="nome" value="<?= $dados["utilizador"][0]->nome; ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">User Name</label>
                                <input type="text" class="form-control"  name="username" value="<?= $dados["utilizador"][0]->username; ?>" placeholder="Ex: meu.genio" required>
                            </div>
                        </div>
                        <!--div class="col-md-4">
                            <div class="form-group">
                                <label for="">Senha</label>
                                <input type="text" class="form-control" name="senha" placeholder="Nova senha" required>
                            </div>
                        </div-->

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Perfil</label>
                                <select class="form-control"  name="perfil" required>
                                    <?php foreach ($dados['perfil'] as $valor) { ?>
                                        <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="salvar" class="btn btn-success">Salvar</button>
                        <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                    </div>
                </form>

            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

