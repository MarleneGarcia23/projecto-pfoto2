<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema Hospitalar</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!--My Style -->
    <link rel="icon" href="<?= base_url() ?>assets/dist/img/icone.gif">
    <script type="text/javascript">
        var base_url = '<?= base_url() ?>';
    </script>
    <script type="text/javascript">
        var modulo = '<?= trim(strtoupper($this->uri->segment(1))) ?>';
    </script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!--STYLE DO EDITOR-->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <?php if (trim(strtoupper($this->uri->segment(1))) == "PAINELCONTROLE") { ?>
        <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
    <?php } ?>
    <?php
    switch (trim(strtoupper($this->uri->segment(2)))) {
        case "GRAFICO":
    ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/morris.js/morris.css">
        <?php
            break;
        case "STOQUE":
        ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/morris.js/morris.css">
        <?php
            break;
        case "PERIODOMENSTRUAL":
        ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
        <?php
            break;
        case "CALENDARIO":
        ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.min.css">
            <link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
        <?php
            break;
        case "EMAIL":
        ?>
            <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/iCheck/flat/blue.css">
        <?php
            break;
        default:
        ?>
    <?php } ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!--*******CABECALHO-->
        <header class="main-header">
            <!--Logo-->
            <a href="<?= base_url() ?>home" class="logo">
                <!--mini logo for sidebar mini 50x50 pixels-->
                <span class="logo-mini"><b>M</b>G</span>
                <!--logo for regular state and mobile devices-->
                <span class="logo-lg"><b>Sublime</b></span>
            </a>
            <!--Header Navbar: style can be found in header.less-->
            <nav class="navbar navbar-static-top">
                <!--Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!--Corpo de Mensagens-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success" name="contchat"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Suas Mensagem</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php foreach ($this->basehome->getMensagem($this->session->userdata('id')) as $valor) { ?>
                                            <li>
                                                <!--inner menu: contains the actual data-->
                                                <ul class="menu">

                                                    <li>
                                                        <a href="<?= base_url() ?>mensagem/nova/<?= $valor->idpessoa ?>">
                                                            <div class="pull-left">
                                                                <img src="<?= base_url() ?>assets/media/imagem/<?= $valor->foto ?>" class="img-circle" alt="User Image">
                                                            </div>
                                                            <h4>
                                                                <?php if (($valor->idagente2 == $this->session->userdata('id')) && ($valor->modo == 0)) { ?>
                                                                    <b> <?= $valor->apelido ?></b>
                                                                <?php } else { ?>
                                                                    <?= $valor->apelido ?>
                                                                <?php } ?>
                                                                <small><i class="fa fa-clock-o"></i><?= $valor->datamensagem ?></small>
                                                            </h4>

                                                            <p><?= base64_decode($valor->descricao) ?></p>

                                                        </a>
                                                    </li>
                                                    <!--fim mensagem-->
                                                </ul>
                                            </li>
                                        <?php } ?>

                                    </ul>
                                </li>
                                <li class="footer"><a href="<?= base_url() ?>mensagem/agente">Ver Todas</a></li>
                            </ul>
                        </li>

                        <!--Corpo de tarefas-->
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger" name="conttarefa"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Suas Tarefas</li>
                                <li>
                                    <!--inner menu: contains the actual data-->
                                    <ul class="menu">
                                        <?php foreach ($this->basehome->getTarefa($this->session->userdata('id')) as $valor) { ?>
                                            <li>
                                                <a href="#">
                                                    <h3>
                                                        <?= $valor->designacao ?>
                                                        <small class="pull-right"> <?= $valor->estado ?> <?= $valor->nivel ?>%</small>
                                                    </h3>
                                                    <?php if ($valor->estado == "PROCESSO") { ?>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-aqua" style="width: <?= $valor->nivel ?>%" role="progressbar" aria-valuenow="<?= $valor->nivel ?>" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($valor->estado == "PENDENTE") { ?>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-yellow" style="width: <?= $valor->nivel ?>%" role="progressbar" aria-valuenow="<?= $valor->nivel ?>" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($valor->estado == "CONCLUIDA") { ?>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-success" style="width: <?= $valor->nivel ?>%" role="progressbar" aria-valuenow="<?= $valor->nivel ?>" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <?php if ($valor->estado == "CANCELADO") { ?>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-red" style="width: <?= $valor->nivel ?>%" role="progressbar" aria-valuenow="<?= $valor->nivel ?>" aria-valuemin="0" aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="<?= base_url() ?>tarefa/detalhe/<?= $this->session->userdata('id') ?>">Ver Todas</a>
                                </li>
                            </ul>
                        </li>
                        <!--Corpo de Eventos-->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-star-o"></i>
                                <span class="label label-warning" name="contevento"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Eventos</li>
                                <?php foreach ($this->basehome->getEvento() as $valor) { ?>
                                    <li>
                                        <!--inner menu: contains the actual data-->
                                        <ul class="menu">
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-calendar-check-o"></i><b><?= $valor->designacao ?></b> - <?= $valor->data1 ?>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>

                        <!--Corpo de Notificacões-->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <!--                                    <span class="label label-warning">1</span>-->
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Sem Notificações</li>

                            </ul>
                        </li>

                        <!--Conta do Utilizador-->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if ($this->session->userdata('imagem') != null) { ?>
                                    <img src="<?= base_url() ?>assets/media/imagem/<?= $this->session->userdata('imagem') ?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata('apelido') ?></span>
                                <?php } else { ?>
                                    <img src="<?= base_url() ?>assets/dist/img/default.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata('apelido') ?></span>
                                <?php } ?>

                            </a>
                            <ul class="dropdown-menu">

                                <!--Imagem do Utilizador-->
                                <li class="user-header">
                                    <?php if ($this->session->userdata('imagem') != null) { ?>
                                        <img src="<?= base_url() ?>assets/media/imagem/<?= $this->session->userdata('imagem') ?>" class="img-circle" alt="User Image">
                                    <?php } else { ?>
                                        <img src="<?= base_url() ?>assets/dist/img/default.png" class="img-circle" alt="User Image">
                                    <?php } ?>


                                    <p>
                                        <?= $this->session->userdata('apelido') ?>
                                        <small>Administrador</small>
                                    </p>
                                </li>
                                <!--                                    Rodapé utilzador-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= base_url() ?>sair" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>