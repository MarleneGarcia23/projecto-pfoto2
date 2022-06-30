<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
        Versão 1.0.0
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#">Sistema Hospitalar</a>.</strong> Todos Direitos Reservados.
</footer>
</div>


<!--Carregando-->
<div class="modal fade" id="modal-carregando">
    <div class="modal-dialog">
        <div class="modal-content" style="height: 300px; width: 500px;">

            <div class="modal-body">
                <div class="form-group" style="text-align: center;">
                    <img style="width: 200px; height: 270px;" src="<?= base_url() ?>assets/dist/img/carregando.gif" class="img-circle" alt="User Image">
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<!--Carregando-->



<div class="modal fade" id="modal-proximaconsulta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>clinico/proximaconsulta" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervaloproximaconsulta" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-cpfiv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>clinico/imprimircpfiv" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalocpfiv" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="modal-relactorio-venda">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/venda" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalovenda" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-relactorio-compra">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/compra" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalocompra" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-relactorio-pagamento">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/pagamento" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalopagamento" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-relactorio-proforma">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/proforma" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervaloproforma" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="modal-relactorio-pagamento-periodo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/pagamentoperiodo" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tipo de Documento</label>
                        <select class="form-control" name="tipo" required>
                            <option value="1">PDF</option>
                            <option value="2">EXCEL</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalopagamentoperiodo" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Gerar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-relactorio-salario">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/salario" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalosalario" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-relactorio-geral">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione a Data</h4>
            </div>
            <form target="_blank" action="<?= base_url() ?>relactorio/geral" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Data:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="data" class="form-control pull-right" id="data-intervalogeral" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!--My Script-->
<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
<script src="<?= base_url() ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
<script src="<?= base_url() ?>assets/dist/js/script.js"></script>
<script src="<?= base_url() ?>assets/dist/js/script_fatura.js"></script>
<script src="<?= base_url() ?>assets/dist/js/script_salario.js"></script>
<script src="<?= base_url() ?>assets/dist/js/script_clinico.js"></script>

<!--SCRIPT LISTAGEM-->
<script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>


<!--SCRIPT DATA INTERVALO-->
<script src="<?= base_url() ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script>
    $(function() {
        $('#data-intervaloproximaconsulta').daterangepicker();
        $('#data-intervalocpfiv').daterangepicker();
        $('#data-intervalovenda').daterangepicker();
        $('#data-intervalocompra').daterangepicker();
        $('#data-intervaloproforma').daterangepicker();
        $('#data-intervalopagamento').daterangepicker();
        $('#data-intervalopagamentoperiodo').daterangepicker();
        $('#data-intervalosalario').daterangepicker();
        $('#data-intervalogeral').daterangepicker();
    });
</script>

<!--SCRIPT DA TABELAS-->
<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        });
        $('#example3').DataTable();
    })
</script>

<!--SCRIPT DO EDITOR-->
<script src="<?= base_url() ?>assets/bower_components/ckeditor/ckeditor.js"></script>
<?php if (trim(strtoupper($this->uri->segment(1))) == "CARDAPIO" || trim(strtoupper($this->uri->segment(1))) == "CLINICO") { ?>
    <script>
        $(function() {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor')
            //bootstrap WYSIHTML5 - text editor
            $('.textarea').wysihtml5()
        })
    </script>
<?php } ?>

<!--SCRIPT DOS EMAIL-->
<script src="<?= base_url() ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
    $(function() {
        //Add text editor
        $("#compose-textarea").wysihtml5();
    });
</script>


<?php if (trim(strtoupper($this->uri->segment(1))) == "PAINELCONTROLE" || trim(strtoupper($this->uri->segment(1))) == "HOME") { ?>
    <script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
    <script>
        var salesChartData = {
            labels: ["<?= $dados['grafico1'][0]['mes'] ?>", "<?= $dados['grafico1'][1]['mes'] ?>", "<?= $dados['grafico1'][2]['mes'] ?>"],
            datasets: [{
                    label: 'Venda',
                    fillColor: 'rgba(60,141,188,0.9)',
                    strokeColor: 'rgba(60,141,188,0.8)',
                    pointColor: '#00c0ef',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: [<?= $dados['grafico1'][0]['totalvenda'] ?>, <?= $dados['grafico1'][1]['totalvenda'] ?>, <?= $dados['grafico1'][2]['totalvenda'] ?>]
                },
                {
                    label: 'Compra',
                    fillColor: 'rgb(210, 214, 222)',
                    strokeColor: 'rgb(210, 214, 222)',
                    pointColor: 'rgb(210, 214, 222)',
                    pointStrokeColor: '#c1c7d1',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgb(220,220,220)',
                    data: [<?= $dados['grafico1'][0]['totalcompra'] ?>, <?= $dados['grafico1'][1]['totalcompra'] ?>, <?= $dados['grafico1'][2]['totalcompra'] ?>]
                }
            ]
        };
        var PieData = [{
                value: <?= $dados['despesa'] ?>,
                color: '#f56954',
                highlight: '#f56954',
                label: 'Despesas'
            },
            {
                value: <?= $dados['venda'] ?>,
                color: '#00a65a',
                highlight: '#00a65a',
                label: 'Vendas'
            },
            {
                value: <?= $dados['compra'] ?>,
                color: '#f39c12',
                highlight: '#f39c12',
                label: 'Compras'
            },
            {
                value: <?= $dados['receita'] ?>,
                color: '#00c0ef',
                highlight: '#00c0ef',
                label: 'Receitas'
            },
        ];
    </script>
<?php } ?>
<?php
switch (trim(strtoupper($this->uri->segment(2)))) {
    case "GRAFICO":
?>
        <script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.resize.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>

        <script>
            $(function() {
                /* ChartJS
                 * -------
                 * Here we will create a few charts using ChartJS
                 */

                //--------------
                //- AREA CHART -
                //--------------

                // Get context with jQuery - using jQuery's .get() method.
                var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
                // This will get the first returned node in the jQuery collection.
                var areaChart = new Chart(areaChartCanvas)

                var areaChartData = {
                    <?php
                    $labels = 'labels: [';
                    foreach ($dados['grafico'] as $valor) {
                        $labels .= '"' . $valor['mes'] . '",';
                    }
                    echo $labels . '],';
                    ?>

                    datasets: [{
                            label: 'Venda',
                            label: 'Compra',
                            fillColor: 'rgb(210, 214, 222)',
                            strokeColor: 'rgb(210, 214, 222)',
                            pointColor: 'rgb(210, 214, 222)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgb(220,220,220)',
                            fillColor: 'rgba(60,141,188,0.9)',
                            strokeColor: 'rgba(60,141,188,0.8)',
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            <?php
                            $data = 'data: [';
                            foreach ($dados['grafico'] as $valor) {
                                $data .= $valor['totalvenda'] . ',';
                            }
                            echo $data . '],';
                            ?>
                        },
                        {
                            label: 'Compra',
                            fillColor: 'rgb(210, 214, 222)',
                            strokeColor: 'rgb(210, 214, 222)',
                            pointColor: 'rgb(210, 214, 222)',
                            pointStrokeColor: '#c1c7d1',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgb(220,220,220)',
                            <?php
                            $data = 'data: [';
                            foreach ($dados['grafico'] as $valor) {
                                $data .= $valor['totalcompra'] . ',';
                            }
                            echo $data . '],';
                            ?>
                        }
                    ]
                }

                var areaChartOptions = {
                    //Boolean - If we should show the scale at all
                    showScale: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: false,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - Whether the line is curved between points
                    bezierCurve: true,
                    //Number - Tension of the bezier curve between points
                    bezierCurveTension: 0.3,
                    //Boolean - Whether to show a dot for each point
                    pointDot: false,
                    //Number - Radius of each point dot in pixels
                    pointDotRadius: 4,
                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth: 1,
                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius: 20,
                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke: true,
                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth: 2,
                    //Boolean - Whether to fill the dataset with a color
                    datasetFill: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true
                }

                //Create the line chart
                areaChart.Line(areaChartData, areaChartOptions)

                //-------------
                //- PIE CHART -
                //-------------
                // Get context with jQuery - using jQuery's .get() method.
                var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
                var pieChart = new Chart(pieChartCanvas)
                var PieData = [{
                        value: <?= $dados['despesa'] ?>,
                        color: '#f56954',
                        highlight: '#f56954',
                        label: 'Despesas'
                    },
                    {
                        value: <?= $dados['venda'] ?>,
                        color: '#00a65a',
                        highlight: '#00a65a',
                        label: 'Vendas'
                    },
                    {
                        value: <?= $dados['compra'] ?>,
                        color: '#f39c12',
                        highlight: '#f39c12',
                        label: 'Compras'
                    },
                    {
                        value: <?= $dados['receita'] ?>,
                        color: '#00c0ef',
                        highlight: '#00c0ef',
                        label: 'Receitas'
                    }
                ]
                var pieOptions = {
                    //Boolean - Whether we should show a stroke on each segment
                    segmentShowStroke: true,
                    //String - The colour of each segment stroke
                    segmentStrokeColor: '#fff',
                    //Number - The width of each segment stroke
                    segmentStrokeWidth: 2,
                    //Number - The percentage of the chart that we cut out of the middle
                    percentageInnerCutout: 50, // This is 0 for Pie charts
                    //Number - Amount of animation steps
                    animationSteps: 100,
                    //String - Animation easing effect
                    animationEasing: 'easeOutBounce',
                    //Boolean - Whether we animate the rotation of the Doughnut
                    animateRotate: true,
                    //Boolean - Whether we animate scaling the Doughnut from the centre
                    animateScale: false,
                    //Boolean - whether to make the chart responsive to window resizing
                    responsive: true,
                    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                    maintainAspectRatio: true,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
                }
                //Create pie or douhnut chart
                // You can switch between pie and douhnut using the method below.
                pieChart.Doughnut(PieData, pieOptions)

                //-------------
                //- BAR CHART -
                //-------------
                var barChartCanvas = $('#barChart').get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = areaChartData
                barChartData.datasets[1].fillColor = '#00a65a'
                barChartData.datasets[1].strokeColor = '#00a65a'
                barChartData.datasets[1].pointColor = '#00a65a'
                var barChartOptions = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero: true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines: true,
                    //String - Colour of the grid lines
                    scaleGridLineColor: 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth: 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines: true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke: true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth: 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing: 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing: 1,
                    //String - A legend template
                    legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive: true,
                    maintainAspectRatio: true
                }

                barChartOptions.datasetFill = false
                barChart.Bar(barChartData, barChartOptions)
            })
            $(function() {
                // LINE CHART
                var line = new Morris.Line({
                    element: 'line-chart',
                    resize: true,
                    <?php
                    $cont = 0;
                    $data = "data: [";
                    foreach ($dados['grafico'] as $valor) {
                        $data .= "{y: '" . $valor['ano'] . " Q" . $valor['mesid'] . "', item1:" . $valor['totalreceita'] . "},";
                    }
                    echo $data . '],';
                    ?>
                    xkey: 'y',
                    ykeys: ['item1'],
                    labels: ['Saldo'],
                    lineColors: ['#3c8dbc'],
                    hideHover: 'auto'
                });
                /*
                 * Flot Interactive Chart
                 * -----------------------
                 */
                // We use an inline data source in the example, usually data would
                // be fetched from a server
                var data = [],
                    totalPoints = 100

                function getRandomData() {

                    if (data.length > 0)
                        data = data.slice(1)

                    // Do a random walk
                    while (data.length < totalPoints) {

                        var prev = data.length > 0 ? data[data.length - 1] : 50,
                            y = prev + Math.random() * 10 - 5

                        if (y < 0) {
                            y = 0
                        } else if (y > 100) {
                            y = 100
                        }

                        data.push(y)
                    }

                    // Zip the generated y values with the x values
                    var res = []
                    for (var i = 0; i < data.length; ++i) {
                        res.push([i, data[i]])
                    }

                    return res
                }
                var interactive_plot = $.plot('#interactive', [getRandomData()], {
                    grid: {
                        borderColor: '#f3f3f3',
                        borderWidth: 1,
                        tickColor: '#f3f3f3'
                    },
                    series: {
                        shadowSize: 0, // Drawing is faster without shadows
                        color: '#3c8dbc'
                    },
                    lines: {
                        fill: true, //Converts the line chart to area chart
                        color: '#3c8dbc'
                    },
                    yaxis: {
                        min: 0,
                        max: 100,
                        show: true
                    },
                    xaxis: {
                        show: true
                    }
                })

                var updateInterval = 500 //Fetch data ever x milliseconds
                var realtime = 'on' //If == to on then fetch data every x seconds. else stop fetching
                function update() {

                    interactive_plot.setData([getRandomData()])

                    // Since the axes don't change, we don't need to call plot.setupGrid()
                    interactive_plot.draw()
                    if (realtime === 'on')
                        setTimeout(update, updateInterval)
                }

                //INITIALIZE REALTIME DATA FETCHING
                if (realtime === 'on') {
                    update()
                }
                //REALTIME TOGGLE
                $('#realtime .btn').click(function() {
                    if ($(this).data('toggle') === 'on') {
                        realtime = 'on'
                    } else {
                        realtime = 'off'
                    }
                    update()
                })
                /*
                 * END INTERACTIVE CHART
                 */
            });
        </script>
    <?php
        break;
    case "PERIODOMENSTRUAL":
    ?>
        <script src="<?= base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/moment/moment.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function init_events(ele) {
                    ele.each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        }

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject)

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0 //  original position after the drag
                        })

                    })
                }

                init_events($('#external-events div.external-event'))

                //Calendario de Geral
                function getcalendario() {
                    $.post(base_url + 'calendario/getcalendario', {}, function(data) {
                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['designacao'],
                                start: JSON.parse(data)[i]['data1'],
                                end: JSON.parse(data)[i]['data2'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'processo' || JSON.parse(data)[i]['estado'] == 'concluido') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'cancelado') ? cor[1] : cor[0])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'processo' || JSON.parse(data)[i]['estado'] == 'concluido') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'cancelado') ? cor[1] : cor[0]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendario').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }


                getcalendario();
                //Calendario de Feria


                //Calendario de Feria
                function getferia() {
                    $.post(base_url + 'feria/getferia', {}, function(data) {
                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['nome'],
                                start: JSON.parse(data)[i]['data1'],
                                end: JSON.parse(data)[i]['data2'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendarioferia').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }

                //Exibir Clientes Agendados        
                getferia();
                //Calendario de Agenda
                function getagenda() {
                    $.post(base_url + 'agenda/getagenda', {}, function(data) {

                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['nome'],
                                start: JSON.parse(data)[i]['data'],
                                end: JSON.parse(data)[i]['data'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }

                //Exibir Clientes Agendados        
                getagenda();
                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)

                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                //Color chooser button
                var colorChooser = $('#color-chooser-btn')
                $('#color-chooser > li > a').click(function(e) {
                    e.preventDefault()
                    //Save color
                    currColor = $(this).css('color')
                    //Add color effect to button
                    $('#add-new-event').css({
                        'background-color': currColor,
                        'border-color': currColor
                    })
                })
                $('#add-new-event').click(function(e) {
                    e.preventDefault()
                    //Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                        return
                    }

                    //Create events
                    var event = $('<div />')
                    event.css({
                        'background-color': currColor,
                        'border-color': currColor,
                        'color': '#fff'
                    }).addClass('external-event')
                    event.html(val)
                    $('#external-events').prepend(event)

                    //Add draggable funtionality
                    init_events(event)

                    //Remove event from text input
                    $('#new-event').val('')
                })
            })
        </script>
    <?php
        break;
    case "CALENDARIO":
    ?>
        <script src="<?= base_url() ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/moment/moment.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <!-- Page specific script -->
        <script>
            $(function() {

                /* initialize the external events
                 -----------------------------------------------------------------*/
                function init_events(ele) {
                    ele.each(function() {

                        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                        // it doesn't need to have a start or end
                        var eventObject = {
                            title: $.trim($(this).text()) // use the element's text as the event title
                        }

                        // store the Event Object in the DOM element so we can get to it later
                        $(this).data('eventObject', eventObject)

                        // make the event draggable using jQuery UI
                        $(this).draggable({
                            zIndex: 1070,
                            revert: true, // will cause the event to go back to its
                            revertDuration: 0 //  original position after the drag
                        })

                    })
                }

                init_events($('#external-events div.external-event'))

                //Calendario de Geral
                function getcalendario() {
                    $.post(base_url + 'calendario/getcalendario', {}, function(data) {
                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['designacao'],
                                start: JSON.parse(data)[i]['data1'],
                                end: JSON.parse(data)[i]['data2'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'processo' || JSON.parse(data)[i]['estado'] == 'concluido') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'cancelado') ? cor[1] : cor[0])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'processo' || JSON.parse(data)[i]['estado'] == 'concluido') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'cancelado') ? cor[1] : cor[0]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendario').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }


                getcalendario();
                //Calendario de Feria


                //Calendario de Feria
                function getferia() {
                    $.post(base_url + 'feria/getferia', {}, function(data) {
                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['nome'],
                                start: JSON.parse(data)[i]['data1'],
                                end: JSON.parse(data)[i]['data2'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendarioferia').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }

                //Exibir Clientes Agendados        
                getferia();
                //Calendario de Agenda
                function getagenda() {
                    $.post(base_url + 'agenda/getagenda', {}, function(data) {

                        var date = new Date();
                        var d = date.getDate();
                        m = date.getMonth();
                        y = date.getFullYear();
                        var agenda = new Array();
                        var valor = new Array();
                        var cor = ['#0073b7', '#f56954', '#9a9a9a'];
                        for (var i = 0, max = JSON.parse(data).length; i < max; i++) {
                            valor = {
                                title: JSON.parse(data)[i]['nome'],
                                start: JSON.parse(data)[i]['data'],
                                end: JSON.parse(data)[i]['data'],
                                backgroundColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2])),
                                borderColor: ((JSON.parse(data)[i]['estado'] == 'aprovado') ? cor[0] : ((JSON.parse(data)[i]['estado'] == 'rejeitado') ? cor[1] : cor[2]))
                            };
                            agenda[i] = valor;
                        }
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            buttonText: {
                                today: 'Hoje',
                                month: 'mes',
                                week: 'semana',
                                day: 'dia'
                            },
                            //Random default events
                            events: agenda,
                            editable: true,
                            droppable: true, // this allows things to be dropped onto the calendar !!!
                            drop: function(date, allDay) { // this function is called when something is dropped

                                // retrieve the dropped element's stored Event Object
                                var originalEventObject = $(this).data('eventObject')

                                // we need to copy it, so that multiple events don't have a reference to the same object
                                var copiedEventObject = $.extend({}, originalEventObject)

                                // assign it the date that was reported
                                copiedEventObject.start = date
                                copiedEventObject.allDay = allDay
                                copiedEventObject.backgroundColor = $(this).css('background-color')
                                copiedEventObject.borderColor = $(this).css('border-color')

                                // render the event on the calendar
                                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

                                // is the "remove after drop" checkbox checked?
                                if ($('#drop-remove').is(':checked')) {
                                    // if so, remove the element from the "Draggable Events" list
                                    $(this).remove()
                                }

                            }
                        });
                    });
                }

                //Exibir Clientes Agendados        
                getagenda();
                /* initialize the calendar
                 -----------------------------------------------------------------*/
                //Date for the calendar events (dummy data)

                /* ADDING EVENTS */
                var currColor = '#3c8dbc' //Red by default
                //Color chooser button
                var colorChooser = $('#color-chooser-btn')
                $('#color-chooser > li > a').click(function(e) {
                    e.preventDefault()
                    //Save color
                    currColor = $(this).css('color')
                    //Add color effect to button
                    $('#add-new-event').css({
                        'background-color': currColor,
                        'border-color': currColor
                    })
                })
                $('#add-new-event').click(function(e) {
                    e.preventDefault()
                    //Get value and make sure it is not null
                    var val = $('#new-event').val()
                    if (val.length == 0) {
                        return
                    }

                    //Create events
                    var event = $('<div />')
                    event.css({
                        'background-color': currColor,
                        'border-color': currColor,
                        'color': '#fff'
                    }).addClass('external-event')
                    event.html(val)
                    $('#external-events').prepend(event)

                    //Add draggable funtionality
                    init_events(event)

                    //Remove event from text input
                    $('#new-event').val('')
                })
            })
        </script>
    <?php
        break;
    case "STOQUE":
    ?>
        <script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/morris.js/morris.min.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.resize.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.pie.js"></script>
        <script src="<?= base_url() ?>assets/bower_components/Flot/jquery.flot.categories.js"></script>

        <script>
            //        $(function () {
            //        /* ChartJS
            //        * -------
            //        * Here we will create a few charts using ChartJS
            //        */
            //        //-------------
            //        //- BAR CHART -
            //        //-------------
            //        var barChartCanvas = $('#barChart').get(0).getContext('2d')
            //            var barChart = new Chart(barChartCanvas)
            //            var barChartData = areaChartData
            //            barChartData.datasets[1].fillColor = '#00a65a'
            //            barChartData.datasets[1].strokeColor = '#00a65a'
            //            barChartData.datasets[1].pointColor = '#00a65a'
            //            var barChartOptions = {
            //            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            //            scaleBeginAtZero        : true,
            //                    //Boolean - Whether grid lines are shown across the chart
            //                    scaleShowGridLines      : true,
            //                    //String - Colour of the grid lines
            //                    scaleGridLineColor      : 'rgba(0,0,0,.05)',
            //                    //Number - Width of the grid lines
            //                    scaleGridLineWidth      : 1,
            //                    //Boolean - Whether to show horizontal lines (except X axis)
            //                    scaleShowHorizontalLines: true,
            //                    //Boolean - Whether to show vertical lines (except Y axis)
            //                    scaleShowVerticalLines  : true,
            //                    //Boolean - If there is a stroke on each bar
            //                    barShowStroke           : true,
            //                    //Number - Pixel width of the bar stroke
            //                    barStrokeWidth          : 2,
            //                    //Number - Spacing between each of the X value sets
            //                    barValueSpacing         : 5,
            //                    //Number - Spacing between data sets within X values
            //                    barDatasetSpacing       : 1,
            //                    //String - A legend template
            //                    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
            //                    //Boolean - whether to make the chart responsive
            //                    responsive              : true,
            //                    maintainAspectRatio     : true
            //            }
            //
            //        barChartOptions.datasetFill = false
            //            barChart.Bar(barChartData, barChartOptions)
            //        })
            //        
        </script>
    <?php
        break;
    default:
    ?>
<?php } ?>
</body>

</html>