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
                        <h3 class="box-title">LISTAR</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr> 
                                    <th>#</th>
                                    <th>Nº Factura</th>
                                    <th>Fornecedor</th>
                                    <th>Operador</th>
                                    <th>Total</th>
                                    <th>Data</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["facturacompra"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->idfactura; ?></td>
                                        <td><?= $valor->fornecedor; ?></td>
                                        <td><?= $valor->funcionario; ?></td>
                                        <td><?= $valor->total; ?>.00(AKZ)</td>
                                        <td><?= $valor->datafactura; ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm" onClick="imprimir_compra(<?= $valor->idfactura; ?>);">
                                                <i class="glyphicon glyphicon-print"></i> Imprimir
                                            </button>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
												<a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>factura/eliminarcompra/<?= $valor->idfactura; ?>':''"  class="btn btn-danger">Eliminar</a>                           
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
