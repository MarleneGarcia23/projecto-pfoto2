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
                <?php foreach ($dados["servico"] as $valor) { ?>
                    <div class="col-md-4">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <img class="img-responsive" style="width: 400px; height: 200px;" src="<?= base_url() ?>assets/media/imagem/<?= $valor->imagem; ?>" alt="User profile picture">

                                <h3 class="profile-username text-center"><?= $valor->designacao; ?></h3>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Preço</b> <a class="pull-right"><?= $valor->valor; ?>(AKZ)</a>
                                    </li>
                                </ul>

                                <a href="<?= base_url() ?>atendimento/atender/<?= $valor->id; ?>" class="btn btn-primary btn-block"><b>Atender</b></a>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

