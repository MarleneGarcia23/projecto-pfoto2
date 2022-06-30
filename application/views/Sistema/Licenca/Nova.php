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
            <!-- left column -->
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
                        <h4><i class="fa fa-close"></i>Licença Inválida!</h4>
                    </div>
                <?php } ?>
                <?php if ($this->uri->segment(3) == 3) { ?>
                    <div name="mensagem" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="fa fa-close"></i>Licença Inspirada!</h4>
                    </div>
                <?php } ?>
                <?php if ($this->uri->segment(3) == 4) { ?>
                    <div name="mensagem" class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="fa fa-close"></i>Falha Na Conexão, Contactar Suporte!</h4>
                    </div>
                <?php } ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Minha Licença</b></h3>
                    </div>
                    <form role="form" action="<?= base_url() ?>licenca/validar" method="post" enctype="multipart/form-data">
                        <div class="panel-body">
                            <p class="col-sm-6 col-lg-offset-3 kl-fancy-form">
                                <input type="text" class="form-control text-center" tabindex="1" maxlength="50"  name="codigo" placeholder="Insira o Código de Licença, Enviado No Seu Email" required>
                            </p>
                        </div>
                        <div class="box-footer" style="text-align:center">
                            <button type="submit" name="continuar" class="btn btn-primary">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

