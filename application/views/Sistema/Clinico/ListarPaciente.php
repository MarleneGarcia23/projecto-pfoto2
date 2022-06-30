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

                        <button type="button" class="btn btn-primary pull-left" style="margin-right: 5px; margin-top: 15px;" data-toggle="modal" data-target="#modal-proximaconsulta">
                            <i class="fa fa-eye"></i> Ver Proximas Consultas
                        </button>

                    <!--     <button type="button" class="btn btn-danger pull-left" style="margin-right: 5px; margin-top: 15px;" data-toggle="modal" data-target="#modal-cpfiv">
                            <i class="fa fa-eye"></i> Controlo de Procedimento FIV
                        </button> -->


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
                                    <th>Telefone</th>
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
                                        <td><?= $valor->telefone; ?></td>
                                        <td>
                                            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'TRIAGEM') != null) { ?>
                                                <a href="<?= base_url(); ?>clinico/fichaclinica/<?= $valor->id; ?>" class="btn btn-primary">Triagem</a>
                                            <?php  } else if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) { ?>
                                                <a href="<?= base_url(); ?>clinico/dadosclinico/<?= $valor->id; ?>" class="btn btn-success">Dados Clínico</a>

                                            <?php  } ?>
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