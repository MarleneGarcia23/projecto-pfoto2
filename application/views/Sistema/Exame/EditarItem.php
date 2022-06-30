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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>ACTUALIZAR <?= strtoupper($this->uri->segment(1)) ?></b></h3>
                    </div>
                    <input type="hidden" name="id" value="<?= $dados["exame"][0]->id ?>" />
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Designação</label>
                                <input type="text" class="form-control" name="designacao-item" value="<?= $dados["exame"][0]->designacao ?>" placeholder="Designação">
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
                                            <input type="text" class="form-control input-sm" placeholder="Valor" name="itemexame-valor" required>
                                        </td>

                                        <td>
                                            <button type="submit" class="btn btn-default btn-sm">
                                                <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                            </button>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($dados['exameitem'] as $item) { ?>
                                        <tr>
                                            <td><input type="text" class="form-control input-sm itemexame-grupo" value="<?= $item->idgrupoexame ?>-<?= $item->designacaogrupoexame ?>" readonly></td>
                                            <td><input type="text" class="form-control input-sm itemexame-designacao" value="<?= $item->designacao ?>"></td>
                                            <td><input type="text" class="form-control input-sm itemexame-valor" value="<?= $item->valor ?>"></td>
                                            <td><button class="btn btn-default btn-sm" onClick="remove_itemexame(this);">
                                                    <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="box-footer">
                        <button type="submit" name="salvar" onclick="salvar_itemexame();" class="btn btn-primary">Salvar</button>
                        <button type="submit" name="cancelar" onclick="cancelar_itemexame();" class="btn btn-default">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->