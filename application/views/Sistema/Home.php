<!-- Corpo-->
<div class="content-wrapper">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa fa-television"></i> HOME</a></li>
            <li><a href="#"></i><?= strtoupper($this->uri->segment(1)) ?></a></li>
        </ol></br>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?= $dados['atendimento'] ?></h3>

                        <p>Atendimento (<?=date('m/Y');?>)</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text"></i>
                    </div>
                  
                </div>
            </div>

            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?= $dados['paciente'] ?></h3>

                        <p>Pacientes</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                  </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?= $dados['funcionario'] ?></h3>

                        <p>Funcionarios</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa fa-male"></i>
                    </div>
                   
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= number_format($dados['receita'], 2, ',', '.')   ?><sup style="font-size: 20px"></sup></h3>

                        <p>Receita Geral (<?=date('m/Y');?>)</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-balance-scale"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.row -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listagem Geral</h3>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Item</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Descrição</th>
                            </tr>
                            <tr>
                                <td style="color:blue;">Receitas (<?=date('m/Y');?>)</td>
                                <td><?= number_format($dados['receita'], 2, ',', '.')  ?></td>
                                <?= (($dados['receita'] >= $dados['despesa']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td style="color:red;">Despesa (<?=date('m/Y');?>)</td>
                                <td><?= number_format($dados['despesa'], 2, ',', '.')  ?></td>
                                <?= (($dados['receita'] >= $dados['despesa']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td style="color:blue;">Vendas (<?=date('m/Y');?>)</td>
                                <td><?=  number_format($dados['venda'], 2, ',', '.')   ?></td>
                                <?= (($dados['venda'] >= $dados['compra']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td style="color:red;">Compras (<?=date('m/Y');?>)</td>
                                <td><?=  number_format($dados['compra'], 2, ',', '.')   ?></td>
                                <?= (($dados['venda'] >= $dados['compra']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td><b>Saldo Geral (<?=date('m/Y');?>)</b></td>
                                <td><?=  number_format($dados['receita']-$dados['despesa'], 2, ',', '.')   ?></td>
                                <?= (($dados['receita'] >= $dados['despesa']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

