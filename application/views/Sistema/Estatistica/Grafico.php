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

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Seleccione o Periodo</h3>

                        <div class="box-tools">
                            <form action="<?= base_url() ?>estatistica/grafico" method="post">
                                <div class="input-group input-group-sm" style="width: 300px;">

                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" name="data" class="form-control pull-right" id="data-intervalogeral" required>
                                    </div>

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" style="height: 34px;"><i class="fa fa-search"></i></button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>

            <div class="col-xs-12">
                <!-- interactive chart -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">Desempenho do Sistema</h3>

                        <div class="box-tools pull-right">
                            Tempo Real
                            <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                <button type="button" class="btn btn-default btn-xs active" data-toggle="on">On</button>
                                <button type="button" class="btn btn-default btn-xs" data-toggle="off">Off</button>
                            </div>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="interactive" style="height: 300px;"></div>
                    </div>
                </div>
            </div>            
        </div>

        <div class="row">
            <div class="col-md-6">
                <!-- BAR CHART -->
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Venda (<i class="fa fa-circle text-aqua"></i>) e Compra (<i class="fa fa-circle text-green"></i>)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Receita da Empresa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body chart-responsive">
                        <div class="chart" id="line-chart" style="height: 300px;"></div>
                    </div>
                </div>


            </div>
            <div class="col-md-6">
                <!-- AREA CHART -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Venda (<i class="fa fa-circle text-aqua"></i>) e Compra (<i class="fa fa-circle text-justify"></i>)</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="areaChart" style="height:300px;"></canvas>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- DONUT CHART -->
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Receita e Despesa Da Empresa</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <canvas id="pieChart" style="height:300px;"></canvas>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
        </div>


    </section>

</div>


