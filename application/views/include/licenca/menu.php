<!--*******BARRA-ESQUERDA*******-->

<!--Barra lateral-->
<aside class="main-sidebar">
    <!--sidebar: style can be found in sidebar.less--> 
    <section class="sidebar">
        <!--sidebar menu: : style can be found in sidebar.less--> 
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ DE NAVEGAÇÃO</li>
            <li class="active">
                <a href="<?= base_url() ?>licenca/nova">
                    <i class="fa fa-television"></i> <span>Licença de Software</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="glyphicon glyphicon-earphone"></i> <span>Contactar Suporte</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li><a href="<?= base_url() ?>licenca/email"><i class="fa fa-chevron-right"></i>Escrever</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!--/.sidebar--> 
</aside>