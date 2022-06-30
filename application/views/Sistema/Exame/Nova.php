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
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>CADASTRAR <?= strtoupper($this->uri->segment(1)) ?></b></h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <div class="box-body">
                        <div class="col-md-12">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Exame Simples</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Exame Com Itens</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                        <form role="form" action="<?= base_url() ?>exame/cadastrar" method="post" enctype="multipart/form-data">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Designação</label>
                                                    <textarea id="editor" class="form-control" name="designacao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Valor de Referência</label>
                                                    <textarea id="editor" class="form-control" name="valor" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Descrição</label>
                                                    <textarea id="editor" class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"></textarea>
                                                </div>
                                            </div>

                                            <div class="box-footer">
                                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                                <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Designação</label>
                                                <input type="text" class="form-control" name="designacao-item" placeholder="Designação">
                                            </div>
                                        </div>
                                        <form id="form-itemexame">
                                            <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-itemexame">
                                                <thead>
                                                    <tr>
                                                        <th>Grupo</th>
                                                        <th>Item</th>
                                                        <th>Valor de Referência</th>
                                                        <th>Opcões</th>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <select class="form-control" name="itemexame-grupo" required>
                                                                <?php foreach ($dados['grupoexame'] as $valor) { ?>
                                                                    <option value="<?= $valor->id ?>-<?= $valor->designacao ?>"><?= $valor->id ?>-<?= $valor->designacao ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" placeholder="Designação" name="itemexame-designacao" required>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control input-sm" placeholder="Valor" name="itemexame-valor" >
                                                        </td>

                                                        <td>
                                                            <button type="submit" class="btn btn-default btn-sm">
                                                                <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </form>

                                        <button type="submit" name="salvar" onclick="salvar_itemexame();" class="btn btn-primary">Salvar</button>
                                        <button type="submit" name="cancelar" onclick="cancelar_itemexame();" class="btn btn-default">Cancelar</button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->