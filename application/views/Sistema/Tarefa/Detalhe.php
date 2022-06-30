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
                                    <th>Tarefa</th>
                                    <th>Descricão</th>
                                    <th>Funcionario</th>
                                    <th>Estado</th>
                                    <th>Data de Começo</th>
                                    <th>Data de Conclusão</th>
                                    <th>Percentagem</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["tarefa"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->designacao; ?></td>
                                        <td><?= $valor->descricao; ?></td>
                                        <td><?= $valor->nome; ?></td>
                                        <td><?= $valor->estado; ?></td>
                                        <td><?= explode("-", $valor->data1)[2] . '-' . explode("-", $valor->data1)[1] . '-' . explode("-", $valor->data1)[0]; ?></td>
                                        <td><?= explode("-", $valor->data2)[2] . '-' . explode("-", $valor->data2)[1] . '-' . explode("-", $valor->data2)[0]; ?></td>
                                        <td><?= $valor->nivel; ?>%</td>
                                        <td>
                                            <a href="<?= base_url(); ?>tarefa/percentagem/<?= $valor->idtarefa; ?>" class="btn btn-instagram">Percentagem</a>
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
