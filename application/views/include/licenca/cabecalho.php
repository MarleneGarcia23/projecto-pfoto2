<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema Hospitar</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <!--My Style -->
        <link rel="icon" href="<?= base_url() ?>assets/dist/img/icone.gif">
        <script type="text/javascript">var base_url = '<?= base_url() ?>';</script>
        <script type="text/javascript">var modulo = '<?= trim(strtoupper($this->uri->segment(1))) ?>';</script>
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
            default :
                ?>
        <?php } ?>
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <!--*******CABECALHO-->
            <header class="main-header">
                <!--Logo--> 
                <a href="<?= base_url() ?>licenca/nova" class="logo">
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
                            
                        </ul>
                    </div>
                </nav>
            </header>
