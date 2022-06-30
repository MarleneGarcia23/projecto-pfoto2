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
                                    <th>Agente</th>
                                    <th>Identificação</th>
                                    <th>Cargo</th>
                                    <th>Estado</th>
                                    <th>Opcões</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados["agente"] as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= $valor->nome; ?></td>
                                        <td><?= $valor->ndi; ?></td>
                                        <td><?= $valor->cargo; ?></td>
                                        <td><?= ($valor->estado == 1) ? "Activo" : "Inactivo"; ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>mensagem/nova/<?= $valor->idfuncionario ?>" class="btn btn-instagram">Nova Mensagem</a>
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
