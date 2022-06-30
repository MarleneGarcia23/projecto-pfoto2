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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <a href="  <?= base_url() ?>paciente/nova" class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 15px;">
                            <i class="glyphicon glyphicon-plus"></i> Novo Registo
                        </a>
                    </div>
                    <div class="box-header">
                        <h3 class="box-title">LISTAR</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Foto</th>
                                    <th>Paciente</th>
                                    <th>Identificação</th>
                                    <th>Género</th>
                                    <th>Altura</th>
                                    <th>Telefone</th>
                                    <th>Parceiro</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["paciente"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><img style="height:30px; width:60px;" src="<?= base_url() ?>assets/media/imagem/<?= $valor->imagem; ?>" alt="message user image"></td>
                                        <td><?= $valor->nome; ?></td>
                                        <td><?= $valor->ndi; ?></td>
                                        <td><?= $valor->genero; ?></td>
                                        <td><?= $valor->altura; ?></td>
                                        <td><?= $valor->telefone; ?></td>
                                        <td><?= $valor->nomeparceiro; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>factura/facturaproforma/<?= $valor->id; ?>" class="btn btn-info">Proforma</a>
                                            <a href="<?= base_url(); ?>factura/facturapagamento/<?= $valor->id; ?>" class="btn btn-primary">Pagamento</a>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
                                                <a href="<?= base_url(); ?>paciente/editar/<?= $valor->id; ?>" class="btn btn-instagram">Editar</a>
                                                <!--                                                 <a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>paciente/eliminar/<?= $valor->id; ?>':''"  class="btn btn-danger">Eliminar</a> -->
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

    </section>
</div>