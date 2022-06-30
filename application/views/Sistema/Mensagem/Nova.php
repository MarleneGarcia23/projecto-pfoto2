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
                <!-- DIRECT CHAT -->
                <div class="box box-primary direct-chat direct-chat-primary">
                    <div class="box-header with-border">
                        <img class="direct-chat-img" src="<?= base_url() ?>assets/media/imagem/<?= $dados['agente2'][0]->foto ?>" alt="message user image">
                        <h3 class="box-title" style="margin-top: 10px; margin-left:5px;"><?= $dados['agente2'][0]->apelido ?></h3>
                        <div class="box-tools pull-right">
<!--                            <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">3</span>-->
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts"
                                    data-widget="chat-pane-toggle">
                                <i class="fa fa-comments"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- Conversations are loaded here -->
                        <div id="divchat" class="direct-chat-messages">
                            <?php foreach ($dados['mensagem'] as $valor) { ?>
                                <?php if ($valor->idagente1 == $dados['agente1'][0]->idfuncionario) { ?>
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left"><?= $dados['agente1'][0]->apelido ?></span>
                                            <span class="direct-chat-timestamp pull-right"><?= $valor->data ?></span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="<?= base_url() ?>assets/media/imagem/<?= $dados['agente1'][0]->foto ?>" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?= base64_decode($valor->descricao) ?>
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                <?php } ?>
                                <?php if ($valor->idagente1 == $dados['agente2'][0]->idfuncionario) { ?>
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right"><?= $dados['agente2'][0]->apelido ?></span>
                                            <span class="direct-chat-timestamp pull-left"><?= $valor->data ?></span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="<?= base_url() ?>assets/media/imagem/<?= $dados['agente2'][0]->foto ?>" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?= base64_decode($valor->descricao) ?>
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <script>
                            document.getElementById('divchat').scrollTop = document.getElementById('divchat').scrollHeight;
                        </script>
                        <!--/.direct-chat-messages-->

                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">
                                <?php foreach ($dados['mensagens'] as $valor) { ?>
                                    <li>
                                        <a href="<?= base_url() ?>mensagem/nova/<?= $valor->idpessoa ?>">
                                            <img class="contacts-list-img" src="<?= base_url() ?>assets/media/imagem/<?= $valor->foto ?>" alt="User Image">

                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    <?= $valor->apelido ?>
                                                    <small class="contacts-list-date pull-right"><?= $valor->datamensagem ?></small>
                                                </span>
                                                <span class="contacts-list-msg"><?= base64_decode($valor->descricao) ?></span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                <?php } ?>
                                <!-- End Contact Item -->
                            </ul>
                            <!-- /.contatcts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <form ole="form" action="<?= base_url() ?>mensagem/cadastrar" method="post">
                            <div class="input-group">
                                <input type="hidden" name="idagente1" value="<?= $dados['agente1'][0]->idfuncionario ?>" />
                                <input type="hidden" name="idagente2" value="<?= $dados['agente2'][0]->idfuncionario ?>" />
                                <input type="text" name="descricao" placeholder="Mensagem..." class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" name="salvar" class="btn btn-primary btn-flat">Enviar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

