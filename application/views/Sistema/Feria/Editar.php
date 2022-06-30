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
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>feria/actualizar" method="post">
                        <input type="hidden" name="id" value="<?= $dados['feria'][0]->idferia ?>" />
                        <div class="box-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Funcionario</label>
                                    <select class="form-control" id="funcionario" name="idfuncionario" required>
                                        <?php foreach ($dados['funcionario'] as $valor) { ?>
                                            <option value="<?= $valor->idfuncionario; ?>" ><?= strtoupper($valor->nome); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control" name="estado" required>
                                        <option value="PENDENTE" >PENDENTE</option>
                                        <option value="APROVADO" >APROVADO</option>
                                        <option value="REJEITADO" >REJEITADO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Data de Começo</label>
                                    <input type="date" class="form-control" name="data1" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Data de Conclusão</label>
                                    <input type="date" class="form-control" name="data2" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Descrição</label>
                                    <textarea class="form-control" name="descricao" style="margin: 0px -17.6563px 0px 0px;  height: 143px;"><?= $dados['feria'][0]->descricao ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                            <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->