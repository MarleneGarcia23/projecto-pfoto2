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
                                    <th>INSTITUIÇÃO</th>
                                    <th>IMAGEM</th>
                                    <th>NIF</th>
                                    <th>ENDEREÇO</th>
                                    <th>EMAIL</th>
                                    <th>FUNDADO</th>
                                    <th>ESTADO</th>
                                    <th>OPÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cont = 1; ?>
                                <?php foreach ($dados as $valor) { ?>
                                    <tr>
                                        <td><?= $cont++ ?></td>
                                        <td><?= strtoupper($valor->nome); ?></td>
                                        <td><img style="height:30px; width:60px;" src="<?= base_url() ?>assets/media/imagem/<?= $valor->logotipo; ?>" alt="message user image"></td>
                                        <td><?= strtoupper($valor->nif); ?></td>
                                        <td><?= 'BAIRRO ' . strtoupper($valor->bairro) . ', RUA ' . strtoupper($valor->rua) . ', CASA Nº ' . strtoupper($valor->casa); ?></td>
                                        <td><?= $valor->email ?></td>
                                        <td><?= explode('-', $valor->data)[2] . '-' . explode('-', $valor->data)[1] . '-' . explode('-', $valor->data)[0]; ?></td>
                                        <td><?= strtoupper($valor->estado); ?></td>
                                        <td>
                                            <a href="<?= base_url(); ?>instituicao/editar/<?= $valor->codigo; ?>" class="btn btn-block  btn-instagram">Editar</a>
                                            <?php if ($valor->estado == 'Activo') { ?>
                                                                <!--<a href="<?= base_url(); ?>instituicao/estado/<?= $valor->id; ?>" class="btn btn-block  btn-danger" onclick="return confirm('Deseja realmente desactivar a Instituicão')">Desactivar</a>-->
                                            <?php } else { ?>
                                                                <!--<a href="<?= base_url(); ?>instituicao/estado/<?= $valor->id; ?>" class="btn btn-block btn-block btn-success">Activar</a>-->
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
