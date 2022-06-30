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
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listagem Diaria</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Item</th>
                                <th>Progresso</th>
                                <th style="width: 40px">Percentagem</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Receitas</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-success" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-green">55%</span></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Despesa</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-red">70%</span></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Compra</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light-blue">30%</span></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Vendas</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-yellow" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-yellow">90%</span></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Listagem Mensal</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Item</th>
                                <th>Progresso</th>
                                <th style="width: 40px">Percentagem</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Receitas</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-success" style="width: 55%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-green">55%</span></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Despesa</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-red">70%</span></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Compra</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light-blue">30%</span></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Vendas</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-yellow" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-yellow">90%</span></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li><a href="#">&laquo;</a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Listagem Geral</h3>

                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Date</th>
                                <th>Estado</th>
                                <th>Descrição</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Receitas</td>
                                <td>11-7-2019</td>
                                <td><span class="label label-success">Aprovado</span></td>
                                <td>Bom Proveito</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Despesa</td>
                                <td>11-7-2019</td>
                                <td><span class="label label-warning">Pendente</span></td>
                                <td>Proveito Moderado</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Compras</td>
                                <td>11-7-2019</td>
                                <td><span class="label label-danger">Rejeitado</span></td>
                                <td>Mal Proveito</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Vendas</td>
                                <td>11-7-2019</td>
                                <td><span class="label label-primary">Aprovado</span></td>
                                <td>Excelente Proveito</td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</div>
<!--******* RODAPE *******-->

