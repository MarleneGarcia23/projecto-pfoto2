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
                                    <th>Cliente</th>
                                    <th>Operador</th>
                                    <th>Subtotal</th>
                                    <th>Valor Pago</th>
                                    <th>Valor em Dívida</th>
                                    <th>Total</th>
                                    <th>Data</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["facturapagamento"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->idfactura; ?></td>
                                        <td><?= $valor->paciente; ?></td>
                                        <td><?= $valor->funcionario; ?></td>
                                        <td><?= $valor->subtotal; ?>.00(AKZ)</td>
                                        <td><?= $valor->valorpago; ?>.00(AKZ)</td>
                                        <td><?= $valor->valordivida; ?>.00(AKZ)</td>
                                        <td><?= $valor->total; ?>.00(AKZ)</td>
                                        <td><?= date('d-m-Y H:m:s', strtotime($valor->datafactura)); ?></td>
                                        <td>

                                            <button class="btn btn-success btn-sm" onClick="imprimir_pagamento(<?= $valor->idfactura; ?>);">
                                                <i class="glyphicon glyphicon-print"></i> Visualizar
                                            </button>
                                            <?php if ($valor->divida > 0) { ?>
                                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-divida<?= $valor->idfactura; ?>"><i class="glyphicon glyphicon-refresh"></i> Actualizar Divida</a>
                                            <?php } ?>
											     
                                           
                                            <?php if (!$this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
												<a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>factura/eliminarpagamento/<?= $valor->idfactura; ?>':''"  class="btn btn-danger"><i class="glyphicon glyphicon-remove-sign"></i>Eliminar</a>
												<?php } ?>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-divida<?= $valor->idfactura; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Preencha os Campos</h4>
                                                </div>
                                                <form action="<?= base_url() ?>factura/pagardivida/<?= $valor->idfactura; ?>" method="post">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Paciente</label>
                                                            <input type="text" class="form-control input-sm" value="<?= $valor->paciente; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Divida</label>
                                                            <input type="text" class="form-control input-sm" value="<?= $valor->valordivida; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Data</label>
                                                            <input type="date" name="data" class="form-control input-sm" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Valor</label>
                                                            <input type="text" name="valor" class="form-control input-sm" min="1" value="" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Método de Pagamento:</label>
                                                            <div class="form-group">
                                                                <select class="form-control" id="metpag" name="metpag" required>
                                                                    <option value="Dinheiro">Dinheiro</option>
                                                                    <option value="Multicaixa">Multicaixa</option>
                                                                    <option value="Tranferência">Tranferência</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                                                        <button type="submit" class="btn btn-primary">Pagar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
