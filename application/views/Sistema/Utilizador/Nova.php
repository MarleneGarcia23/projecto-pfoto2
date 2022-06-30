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
                <?php if ($this->uri->segment(3) == 1) { ?>
                    <!-- general form elements -->
                    <div name="mensagem" class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="fa fa-check"></i>Sucesso!</h4>
                    </div>
                <?php } ?>
                <?php if ($this->uri->segment(3) == 2) { ?>
                    <div name="mensagem" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="fa fa-close"></i>Dados Inválidos!</h4>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <button type="button" class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 15px;" data-toggle="modal" data-target="#usermodal">
                            <i class="glyphicon glyphicon-plus"></i> Novo Utilizador
                        </button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th>#</th>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Apelido</th>
                                    <th>Username</th>
                                    <th>Perfil</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados['utilizador'] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->id ?></td>
                                        <td><?= $valor->nome ?></td>
                                        <td><?= $valor->apelido ?></td>
                                        <td><?= $valor->username ?></td>
                                        <td><?= $valor->nomeperfil ?></td>
                                        <td>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
                                                <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>utilizador/eliminar/<?= $valor->idutilizador; ?>':''"  class="btn btn-danger">Eliminar</a>
                                                <a href="<?= base_url(); ?>utilizador/editar/<?= $valor->idutilizador; ?>" class="btn btn-instagram">Editar</a>
                                                <a href="<?= base_url(); ?>utilizador/redifinirsenha/<?= $valor->idutilizador; ?>" class="btn btn-success">Redifinir Senha</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="usermodal">
            <div class="modal-dialog">
                <form  action="<?= base_url() ?>utilizador/cadastrar" method="post">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Novo Utilizador</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Utilizador:</label>
                                <select class="form-control" id="idpessoa" name="idpessoa" required>
                                    <?php foreach ($dados['pessoas'] as $valor) { ?>
                                        <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->nome); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Perfil:</label>
                                <select class="form-control" id="idperfil" name="idperfil" required>
                                    <?php foreach ($dados['perfil'] as $valor) { ?>
                                        <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Utilizador" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

