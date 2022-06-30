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
            <div class="col-md-3">
                <a href="<?= base_url() ?>correio/email" class="btn btn-primary btn-block margin-bottom">Escrever</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pastas</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="<?= base_url() ?>correio/caixa"><i class="fa fa-inbox"></i>Caixa
                                    </a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- /.col -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Caixa</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr> 
                                            <th>#</th>
                                            <th>Email</th>
                                            <th>Assunto</th>
                                            <th>Anexo</th>
                                            <th>Data</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 1; ?>
                                        <?php foreach ($dados["caixa"] as $valor) { ?>
                                            <tr>
                                                <td><?= $cont++ ?></td>
                                                <td class="mailbox-name"><a href="<?= base_url() ?>correio/ver/<?= $valor->id; ?>"><?= $valor->email; ?></a></td>
                                                <td class="mailbox-subject"><?= $valor->assunto; ?></td>
                                                <?php if ($valor->anexo != null) { ?>
                                                    <td class="mailbox-attachment"><i class="fa fa-paperclip"></i> Anexo</td>
                                                <?php } else { ?>
                                                    <td class="mailbox-attachment"><i class="fa fa-paperclip"></i> Sem Anexo</td>
                                                <?php } ?>
                                                    <td class="mailbox-date"><?= date('d/m/Y H:i:s', strtotime($valor->data)); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

</div>
<!--******* RODAPE *******-->

