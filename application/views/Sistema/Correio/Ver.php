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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b><?= $dados["caixa"][0]->assunto ?></b></h3>

                        <div class="box-tools pull-right">
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                            <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-read-info">
                            <h5>De: <?= $dados["caixa"][0]->email ?>
                                <span class="mailbox-read-time pull-right"><?= date('d/m/Y H:i', strtotime($dados["caixa"][0]->data)); ?></span></h5>
                        </div>
                        <div class="mailbox-read-message">
                            <p><?= $dados["caixa"][0]->conteudo ?></p>

                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <ul class="mailbox-attachments clearfix">

                            <?php if ($dados["caixa"][0]->anexo != null) { ?>
                                <li>
                                    <span class="mailbox-attachment-icon has-img"><img src="<?= base_url() ?>assets/media/anexo/<?= $dados["caixa"][0]->anexo; ?>" alt="Anexo"></span>

                                    <div class="mailbox-attachment-info">
                                        <!--<a href="#" class="mailbox-attachment-name"><i class="fa fa-camera"></i> foto.png</a>-->
                                        <span class="mailbox-attachment-size">
                                            2.67 MB
                                            <a target="_blank" href="<?= base_url() ?>assets/media/anexo/<?= $dados["caixa"][0]->anexo; ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                        </span>
                                    </div>
                                </li>
                            <?php } else { ?>
                            <?php } ?>

                        </ul>
                    </div>
                    <!-- /.box-footer -->
                    <div class="box-footer">
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
							<a onclick="(confirm('Pretende efetuar esta operacão')==true)?location.href='<?= base_url(); ?>correio/eliminar/<?= $dados['caixa'][0]->id ?>':''"  class="btn btn-danger">Eliminar</a>                           

                        <?php } ?>
                        <!--<button type="button" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>-->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
    </section>

</div>
<!--******* RODAPE *******-->

