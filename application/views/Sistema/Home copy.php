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

                        <p>Atendimento</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text"></i>
                    </div>
                    <a href="#" class="small-box-footer">Mais Informação <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?= base_url() ?>paciente/listar" class="small-box-footer">Mais Informação <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?= base_url() ?>funcionario/listar" class="small-box-footer">Mais Informação <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?= $dados['receita'] ?><sup style="font-size: 20px">.00</sup></h3>

                        <p>Receita Geral</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-balance-scale"></i>
                    </div>
                    <a href="<?= base_url() ?>estatistica/listagem" class="small-box-footer">Mais Informação <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Estatísticas Financeira</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <!--                            <div class="btn-group">
                                                            <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                                                                <i class="fa fa-wrench"></i></button>
                                                            <ul class="dropdown-menu" role="menu">
                                                                <li><a href="#">Procurar por Data</a></li>
                                                                <li class="divider"></li>
                                                                <li><a href="#">Procurar por Periodo</a></li>
                                                            </ul>
                                                        </div>-->
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Receitas e Despesa de <?= $this->basemes->getID(date('m'))[0]->designacao . date(" Y") ?></strong>
                                </p>

                                <div class="chart">
                                    <!-- GRAFICO1 -->
                                    <canvas id="salesChart" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">

                                <p class="text-center">
                                    <strong>Progresso</strong>
                                </p>

                                <div class="progress-group">
                                    <span class="progress-text">Receita</span>
                                    <span class="progress-number"><b><?= $dados['receita'] ?>.00(KZ) / <?= ceil((($dados['receita'] * 100) / $dados['referencia'])) ?>%</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: <?= ceil((($dados['receita'] * 100) / $dados['referencia'])) ?>%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Despesa</span>
                                    <span class="progress-number"><b><?= $dados['despesa'] ?>.00(KZ) / <?= ceil((($dados['despesa'] * 100) / $dados['referencia'])) ?>%</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: <?= ceil((($dados['despesa'] * 100) / $dados['referencia'])) ?>%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Venda</span>
                                    <span class="progress-number"><b><?= $dados['venda'] ?>.00(KZ) / <?= ceil((($dados['venda'] * 100) / $dados['referencia'])) ?>%</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: <?= ceil((($dados['venda'] * 100) / $dados['referencia'])) ?>%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Compra</span>
                                    <span class="progress-number"><b><?= $dados['compra'] ?>.00(KZ) / <?= ceil((($dados['compra'] * 100) / $dados['referencia'])) ?>%</b></span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow" style="width: <?= ceil((($dados['compra'] * 100) / $dados['referencia'])) ?>%"></div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <?= (($dados['venda'] >= $dados['compra']) ? '<span class="description-percentage text-green"><i class="fa fa-caret-up"></i>' . ceil((($dados['venda'] * 100) / $dados['referencia'])) : '<span class="description-percentage text-red"><i class="fa fa-caret-down"></i>' . ceil((($dados['venda'] * 100) / $dados['referencia']))) ?>%</span>
                                    <h5 class="description-header"><?= $dados['venda'] ?>.00(KZ)</h5>
                                    <span class="description-text">TOTAL DE VENDA</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <?= (($dados['venda'] >= $dados['compra']) ? '<span class="description-percentage text-red"><i class="fa fa-caret-down"></i>' . ceil((($dados['compra'] * 100) / $dados['referencia'])) : '<span class="description-percentage text-green"><i class="fa fa-caret-up"></i>' . ceil((($dados['compra'] * 100) / $dados['referencia']))) ?>%</span>
                                    <h5 class="description-header"><?= $dados['compra'] ?>.00(KZ)</h5>
                                    <span class="description-text">TOTAL COMPRA</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <?= (($dados['receita'] >= $dados['despesa']) ? '<span class="description-percentage text-green"><i class="fa fa-caret-up"></i>' . ceil((($dados['receita'] * 100) / $dados['referencia'])) : '<span class="description-percentage text-red"><i class="fa fa-caret-down"></i>' . ceil((($dados['receita'] * 100) / $dados['referencia']))) ?>%</span>
                                    <h5 class="description-header"><?= $dados['receita'] ?>.00(KZ)</h5>
                                    <span class="description-text">TOTAL RECEITA</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <?= (($dados['receita'] >= $dados['despesa']) ? '<span class="description-percentage text-red"><i class="fa fa-caret-down"></i>' . ceil((($dados['despesa'] * 100) / $dados['referencia'])) : '<span class="description-percentage text-green"><i class="fa fa-caret-up"></i>' . ceil((($dados['despesa'] * 100) / $dados['referencia']))) ?>%</span>
                                    <h5 class="description-header"><?= $dados['despesa'] ?>.00(KZ)</h5>
                                    <span class="description-text">TOTAL DESPESA</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- MAP & BOX PANE -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Localização da Empresa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="row">
                            <div class="col-md-9 col-sm-8">
                                <div class="pad">
                                    <!-- Map will be created here -->
                                    <!--div id="world-map-markers" style="height: 325px;"></div-->
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.9261335906685!2d13.396789314784973!3d-8.978944694867968!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1a5202fbd036615f%3A0x31b7381c68eb4c3f!2sCondom%C3%ADnio+Vida+Pacifica%2C+Zona+II+%2C+Bloco+3!5e0!3m2!1spt-PT!2sao!4v1557836558234!5m2!1spt-PT!2sao" width="730" height="325" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-4">
                                <div class="pad box-pane-right bg-green" style="min-height: 280px">
                                    <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                                        <h5 class="description-header"><?= $dados['paciente'] ?></h5>
                                        <span class="description-text">Pacientes</span>
                                    </div>
                                    <div class="description-block">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header"><?= $dados['funcionario'] ?></h5>
                                        <span class="description-text">Funcionários</span>
                                    </div>
                                    <!-- /.description-block -->
                                    <div class="description-block margin-bottom">
                                        <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                                        <h5 class="description-header"><?= $dados['receita'] ?>.00(KZ)</h5>
                                        <span class="description-text">Receitas</span>
                                    </div>
                                    <!-- /.description-block -->

                                    <!-- /.description-block -->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>


            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Receita Da Empresa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="chart-responsive">
                                    <canvas id="pieChart" height="150"></canvas>
                                </div>
                                <!-- ./chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <ul class="chart-legend clearfix">
                                    <li><i class="fa fa-circle text-aqua"></i> Receita</li>
                                    <li><i class="fa fa-circle text-red"></i> Despesa</li>
                                    <li><i class="fa fa-circle text-green"></i> Venda</li>
                                    <li><i class="fa fa-circle text-yellow"></i> Compra</li>

                                </ul>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#">Receita
                                    <span class="pull-right text-aqua"> <?= ceil((($dados['receita'] * 100) / $dados['referencia'])) ?>%</span></a></li>
                            <li><a href="#">Despesa <span class="pull-right text-red"> <?= ceil((($dados['despesa'] * 100) / $dados['referencia'])) ?>%</span></a>
                            </li>
                            <li><a href="#">Venda <span class="pull-right text-green"> <?= ceil((($dados['venda'] * 100) / $dados['referencia'])) ?>%</span></a>
                            </li>
                            <li><a href="#">Compra
                                    <span class="pull-right text-yellow"> <?= ceil((($dados['compra'] * 100) / $dados['referencia'])) ?>%</span></a></li>
                        </ul>
                    </div>
                    <!-- /.footer -->
                </div>
            </div>
            <!-- /.col -->
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
                                <th>#</th>
                                <th>Item</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Descrição</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Receitas</td>
                                <td><?= $dados['receita'] ?>.00(KZ)</td>
                                <?= (($dados['receita'] >= $dados['despesa']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Despesa</td>
                                <td><?= $dados['despesa'] ?>.00(KZ)</td>
                                <?= (($dados['receita'] >= $dados['despesa']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Vendas</td>
                                <td><?= $dados['venda'] ?>.00(KZ)</td>
                                <?= (($dados['venda'] >= $dados['compra']) ? '<td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente</td>' : '<td><span class="label label-danger">Rejeitado</span></td>
                                <td>Péssimo</td>') ?>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Compras</td>
                                <td><?= $dados['compra'] ?>.00(KZ)</td>
                                <?= (($dados['venda'] >= $dados['compra']) ? '<td><span class="label label-primary">Aprovado</span></td>
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

