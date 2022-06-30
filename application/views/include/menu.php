<!--*******BARRA-ESQUERDA*******-->

<!--Barra lateral-->
<aside class="main-sidebar">
    <!--sidebar: style can be found in sidebar.less-->
    <section class="sidebar">
        <!--Sidebar user panel-->
        <div class="user-panel">
            <?php if ($this->session->userdata('imagem') != null) { ?>
                <div class="pull-left image">
                    <img src="<?= base_url() ?>assets/media/imagem/<?= $this->session->userdata('imagem') ?>" class="img-circle" alt="User Image">
                </div>
            <?php } else { ?>
                <div class="pull-left image">
                    <img src="<?= base_url() ?>assets/dist/img/default.png" class="img-circle" alt="User Image">
                </div>
            <?php } ?>
            <div class="pull-left info">
                <p><?= $this->session->userdata('apelido') ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!--search form-->
        <form action="" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="procurar" id="procurar" class="form-control" placeholder="Procurar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!--/.search form-->
        <!--sidebar menu: : style can be found in sidebar.less-->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ DE NAVEGAÇÃO</li>
            <!--PAINEL DE CONTROLE-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'PAINEL') != null) { ?>
                <li class="active">
                    <a href="<?= base_url() ?>painelcontrole">
                        <i class="fa fa-television"></i> <span>PAINEL DE CONTROLO</span>
                    </a>
                </li>
            <?php } ?>
            <li><a href="<?= base_url() ?>calendario/calendario"><i class="glyphicon glyphicon-calendar"></i>CALENDÁRIO</a></li>
            <!--             <li><a href="<?= base_url() ?>agenda/calendario"><i class="glyphicon glyphicon-calendar"></i>Calendário Das Agendas</a></li> -->
            <!--MODULO ATENDIMENTO-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'ATENDIMENTO') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-certificate"></i> <span>RECEPÇÃO</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="fa fa-calendar"></i> Agenda
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>agenda/nova"><i class="fa fa-chevron-right"></i>Marcar</a></li>
                                <li><a href="<?= base_url() ?>agenda/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                <li><a href="<?= base_url() ?>agenda/calendario"><i class="fa fa-chevron-right"></i>Calendario</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-group"></i> <span>Meus Pacientes</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>paciente/listar"><i class="fa fa-chevron-right"></i>Pacientes</a></li>
                                <li><a href="<?= base_url() ?>factura/listarproforma"><i class="fa fa-chevron-right"></i>Proformas</a></li>
                                <li><a href="<?= base_url() ?>factura/listarpagamento"><i class="fa fa-chevron-right"></i>Pagamentos</a></li>
                                <li><a href="<?= base_url() ?>clinico/paciente"><i class="fa fa-file-text-o"></i>Pedido Exame</a></li>
                                <li><a href="<?= base_url() ?>clinico/listarresultadoexame"><i class="fa fa-chevron-right"></i>Resultado de Exames</a></li>
                            </ul>
                        </li>
                        <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-pagamento-periodo"><i class="fa fa-chevron-right"></i>Pagamento Por Periodo</a></li>
                        <!--                        <li class="treeview">
                                                    <a href="#"><i class="fa fa-street-view"></i> Atendimento
                                                        <span class="pull-right-container">
                                                            <i class="fa fa-angle-left pull-right"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="treeview-menu">
                                                        <li><a href="<?= base_url() ?>atendimento/nova"><i class="fa fa-chevron-right"></i>Atender</a></li>
                                                        <li><a href="<?= base_url() ?>atendimento/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                                        <li><a href="<?= base_url() ?>atendimento/grafico"><i class="fa fa-chevron-right"></i>Grafico</a></li>
                                                    </ul>
                                                </li>-->
                    </ul>
                </li>
            <?php } ?>




            <!--MODULO TRIAGEM-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'TRIAGEM') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-stethoscope"></i> <span>Triagem</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url() ?>clinico/paciente"><i class="fa fa-file-text-o"></i>Pacientes</a></li>
                    </ul>
                </li>
            <?php } ?>


            <!--MODULO CLINICO-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLINICO') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-stethoscope"></i> <span>CLÍNICO</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_url() ?>clinico/paciente"><i class="fa fa-file-text-o"></i>Pacientes</a></li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-chevron-right"></i> Laboratório
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-chevron-right"></i> Exames
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>exame/listar"><i class="fa fa-chevron-right"></i>Exames</a></li>
                                        <li><a href="<?= base_url() ?>grupoexame/listar"><i class="fa fa-chevron-right"></i>Grupos Exames</a></li>
                                        <li><a href="<?= base_url() ?>clinico/listarpedidoexame"><i class="fa fa-chevron-right"></i>Pedidos de Exames</a></li>
                                        <li><a href="<?= base_url() ?>clinico/listarresultadoexame"><i class="fa fa-chevron-right"></i>Resultado de Exames</a></li>

                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>




            <!--MODULO LABORATORIO-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'LABORATORIO') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-stethoscope"></i> <span>LABORATÓRIO</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="fa fa-street-view"></i> Exames
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>exame/listar"><i class="fa fa-chevron-right"></i> Exames</a></li>
                                <li><a href="<?= base_url() ?>grupoexame/listar"><i class="fa fa-chevron-right"></i> Grupos Exames</a></li>
                                <li><a href="<?= base_url() ?>clinico/listarpedidoexame"><i class="fa fa-chevron-right"></i>Pedidos de Exames</a></li>
                                <li><a href="<?= base_url() ?>clinico/listarresultadoexame"><i class="fa fa-chevron-right"></i>Resultado de Exames</a></li>

                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>



            <!--MODULO FINANCAS-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'FINANCA') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-balance-scale"></i> <span>COMERCIAL</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!--MODULO FINANCAS-->
                        <li><a href="<?= base_url() ?>factura/listarproforma"><i class="fa fa-chevron-right"></i>Proformas</a></li>
                        <li><a href="<?= base_url() ?>factura/listarpagamento"><i class="fa fa-chevron-right"></i>Pagamentos</a></li>
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'SERVICO') != null) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-cube"></i> <span>Serviços/Produtos</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-cubes"></i> Produtos
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="<?= base_url() ?>produto/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                            <li><a href="<?= base_url() ?>produto/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                            <li><a href="<?= base_url() ?>produto/stoque"><i class="fa fa-chevron-right"></i>Stoque</a></li>
                                        </ul>
                                    </li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-navicon"></i> Servi&ccedil;os
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="<?= base_url() ?>servico/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                            <li><a href="<?= base_url() ?>servico/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>


                        <!--MODULO CLIENTE-->
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CLIENTE') != null) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-group"></i> <span>Cliente/Forncedor</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li class="treeview">
                                        <a href="#">
                                            <i class="fa fa-group"></i> <span>Cliente</span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="<?= base_url() ?>cliente/nova/3"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                            <li><a href="<?= base_url() ?>cliente/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                        </ul>

                                    </li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-industry"></i>Fornecedor
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="<?= base_url() ?>fornecedor/nova"><i class="fa fa-chevron-right"></i>Novo</a></li>
                                            <li><a href="<?= base_url() ?>fornecedor/listar"><i class="fa fa-chevron-right"></i>Listar</a></li>
                                        </ul>
                                    </li>
                                </ul>

                            </li>
                        <?php } ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-money"></i> Vendas/Compras
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">

                                <li class="treeview">
                                    <a href="#"><i class="fa fa-money"></i>Vendas
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>factura/facturavenda"><i class="fa fa-chevron-right"></i>Facturação</a></li>
                                        <li><a href="<?= base_url() ?>factura/listarvenda"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="glyphicon glyphicon-shopping-cart"></i>Compras
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>factura/facturacompra"><i class="fa fa-chevron-right"></i>Facturação</a></li>
                                        <li><a href="<?= base_url() ?>factura/listarcompra"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!--MODULO ATENDIMENTO-->
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'ESTATISTICA') != null) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-line-chart"></i> <span>Relatórios</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <!--                                     <li><a href="<?= base_url() ?>estatistica/grafico"><i class="fa fa-chevron-right"></i>Gráfico</a></li> -->
                                    <!--<li><a href="<?= base_url() ?>estatistica/listagem"><i class="fa fa-chevron-right"></i>Listagem</a></li>-->
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-pagamento-periodo"><i class="fa fa-chevron-right"></i>Pagamento Por Periodo</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-proforma"><i class="fa fa-chevron-right"></i>Proformas</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-pagamento"><i class="fa fa-chevron-right"></i>Pagamento</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-venda"><i class="fa fa-chevron-right"></i>Venda</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-compra"><i class="fa fa-chevron-right"></i>Compra</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#modal-relactorio-salario"><i class="fa fa-chevron-right"></i>Salário</a></li>
                                    <li><a href="<?= base_url() ?>produto/stoque"> <i class="fa fa-chevron-right"></i>Stoque</a></li>
                                    <!--<li><a href="#" data-toggle="modal" data-target="#modal-relactorio-geral"><i class="fa fa-chevron-right"></i>Geral</a></li>-->

                                    <!--              <li class="treeview">
                                        <a href="#"><i class="fa fa-chevron-right"></i>Relatórios
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                        </ul>
                                    </li> -->
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>



            <!--MODULO PESSOAL-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'PESSOAL') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-male"></i> <span>PESSOAL</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="fa fa-user"></i> Funcionários
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>funcionario/nova/3"><i class="fa fa-chevron-right"></i>Registo</a></li>
                                <li><a href="<?= base_url() ?>funcionario/listar"><i class="fa fa-chevron-right"></i>Listagem</a></li>
                                <li><a target="_blank" href="<?= base_url() ?>funcionario/passe"><i class="fa fa-chevron-right"></i>Emitir Passe</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Sub/Descontos
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>sub_desc/nova"><i class="fa fa-chevron-right"></i>Novo</a></li>
                                <li><a href="<?= base_url() ?>sub_desc/listar"><i class="fa fa-chevron-right"></i>Listar</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#"><i class="fa fa fa-usd"></i> Salário
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>salario/nova"><i class="fa fa-chevron-right"></i>Elaborar</a></li>
                                <li><a href="<?= base_url() ?>salario/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-plane"></i> Gestão de Férias
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>feria/nova"><i class="fa fa-chevron-right"></i>Pedido</a></li>
                                <li><a href="<?= base_url() ?>feria/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                <li><a href="<?= base_url() ?>feria/calendario"><i class="fa fa-chevron-right"></i>Calendário</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-street-view"></i> Presenças
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>presenca/nova"><i class="fa fa-chevron-right"></i>Marcar</a></li>
                                <li><a href="<?= base_url() ?>presenca/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>

            <!--MODULO GESTOR DE TAREFAS-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'TAREFA') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="glyphicon glyphicon-tasks"></i> <span>Gestor de Tarefas</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="fa fa-street-view"></i> Atribuir Tarefas
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>tarefa/nova/3"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                <li><a href="<?= base_url() ?>tarefa/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url() ?>tarefa/detalhe/<?= $this->session->userdata('id') ?>"><i class="glyphicon glyphicon-th-list"></i>Detalhes</a></li>
                    </ul>
                </li>
            <?php } ?>

            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'EVENTO') != null) { ?>
                <!--MODULO GESTOR DE EVENTOS-->
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-calendar-check-o"></i> <span>Eventos</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="glyphicon glyphicon-pushpin"></i> Tipo de Evento
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>tipoevento/nova/3"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                <li><a href="<?= base_url() ?>tipoevento/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#"><i class="glyphicon glyphicon-plus"></i> Adicionar Evento
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>evento/nova/3"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                <li><a href="<?= base_url() ?>evento/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            <?php } ?>
            <!--MODULO COMUNICAÇÃO E INFORMAÇÃO-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'COMUNICACAO') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bullhorn"></i> <span>COMUNICAÇÃO
                        </span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <!--              <li class="treeview">
                            <a href="#"><i class="fa fa-newspaper-o"></i> News
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url() ?>noticia/nova"><i class="fa fa-chevron-right"></i>Nova</a></li>
                                <li><a href="<?= base_url() ?>noticia/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                            </ul>
                        </li> -->

                        <li><a href="<?= base_url() ?>mensagem/agente"><i class="glyphicon glyphicon-comment"></i>Chat</a></li>
                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'MENSAGEM1') != null) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-envelope"></i> <span>Mensagens/SMS</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="<?= base_url() ?>mensagem/agente"><i class="glyphicon glyphicon-comment"></i>Chat</a></li>
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-inbox"></i> Caixa de Correio
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">
                                            <li><a href="<?= base_url() ?>correio/caixa"><i class="fa fa-chevron-right"></i>Mailbox</a></li>
                                            <li><a href="<?= base_url() ?>correio/email"><i class="fa fa-chevron-right"></i>Escrever</a></li>
                                        </ul>
                                    </li>

                                    <li><a href="<?= base_url() ?>correio/emailmassa"><i class="fa fa-envelope"></i>Email em Massa</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                        <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'MENSAGEM2') != null) { ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-earphone"></i> <span>Contactar Suporte</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>

                                <ul class="treeview-menu">
                                    <li><a href="<?= base_url() ?>correio/emailsuporte"><i class="fa fa-chevron-right"></i>Escrever</a></li>
                                    <li><a href="<?= base_url() ?>correio/caixa"><i class="fa fa-chevron-right"></i>Mailbox</a></li>
                                </ul>

                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>


            <!--MODULO CONFIGURAÇÕES-->
            <?php if ($this->basehome->getModulo($this->session->userdata('id'), 'CONFIGURACOES') != null) { ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-cog"></i>
                        <span>CONFIGURAÇÕES</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#"><i class="fa fa-bank"></i> Instituição
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-building"></i> Instituição
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <!--<li><a href="<?= base_url() ?>instituicao/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>-->
                                        <li><a href="<?= base_url() ?>instituicao/listar"><i class="fa fa-chevron-right"></i>Visualizar</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-briefcase"></i> Cargo
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>cargo/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                        <li><a href="<?= base_url() ?>cargo/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-asterisk"></i> Departamento
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>departamento/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                        <li><a href="<?= base_url() ?>departamento/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="fa fa-calendar"></i> Calendário
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>calendario/nova"><i class="fa fa-chevron-right"></i>Cadastrar</a></li>
                                        <li><a href="<?= base_url() ?>calendario/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url() ?>utilizador/nova"><i class="fa fa-user"></i>Utilizador</a></li>
                        <li class="treeview">
                            <a href="#"><i class="glyphicon glyphicon-th"></i> Módulos
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview">
                                    <a href="#"><i class="glyphicon glyphicon-list-alt"></i>Perfil
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>perfil/nova"><i class="fa fa-chevron-right"></i>Novo</a></li>
                                        <li><a href="<?= base_url() ?>perfil/listar"><i class="fa fa-chevron-right"></i>Listar</a></li>
                                    </ul>
                                </li>
                                <li class="treeview">
                                    <a href="#"><i class="glyphicon glyphicon-th-large"></i>Modulo
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>modulo/listar"><i class="fa fa-chevron-right"></i>Listar</a></li>
                                    </ul>
                                </li>

                                <li class="treeview">
                                    <a href="#"><i class="glyphicon glyphicon-random"></i>Associar
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <li><a href="<?= base_url() ?>associar/nova"><i class="fa fa-chevron-right"></i>Associar</a></li>
                                        <li><a href="<?= base_url() ?>associar/listar"><i class="fa fa-chevron-right"></i>Consultar</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url() ?>site/painel"><i class="fa fa-globe"></i>Painel WebSite</a></li>


                    </ul>
                </li>
            <?php } ?>
        </ul>
    </section>
    <!--/.sidebar-->
</aside>