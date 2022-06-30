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
    <section class="invoice">
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <!--class="img-circle"-->
                    <img  style="height:30px; width:60px;" src="<?= base_url() ?>assets/media/imagem/<?= $dados["instituicao"][0]->logotipo; ?>"></td> <?= strtoupper($dados["instituicao"][0]->nome) ?>
                    <small class="pull-right"> <?= date('d-m-Y') ?></small>
                </h2>
            </div>
        </div>
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <strong> Funcionário</strong>
                <div class="form-group">
                    <select class="form-control"  name="funcionario" onclick="getsalario();" required>
                        <?php foreach ($dados['funcionario'] as $valor) { ?>
                            <option value="<?= $valor->idfuncionario ?>" ><?= $valor->nome ?></option>
                        <?php } ?>
                    </select>
                </div>
                <strong>Mês</strong>
                <div class="form-group">
                    <select class="form-control"  name="mes" required>
                        <?php foreach ($dados['mes'] as $valor) { ?>
                            <option value="<?= $valor->id ?>" ><?= $valor->designacao ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Factura Nº <?= $dados["nfactura"]; ?></b><br>
            </div>
            <div class="col-sm-4 invoice-col">
                <strong> De</strong>
                <address>
                    <?= $dados["instituicao"][0]->nome; ?></br>
                    <b>Nif:</b>  <?= $dados["instituicao"][0]->nif; ?><br>
                    <b>Telefone:</b>  (+244) <?= $dados["instituicao"][0]->telefone; ?><br>
                    <b>Email: </b> <?= $dados["instituicao"][0]->email; ?>
                </address>
            </div> 
        </div>
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-subcidio">
                    <form id="form-subcidio">
                        <thead>
                            <tr>
                                <th>Subsídios</th>
                                <th width="100px">Moeda</th>
                                <th width="100px">Preço</th>
                                <th width="100px">Quantidade</th>
                                <th width="100px">Subtotal</th>
                                <th width="80px">Opcões</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="hidden" name="subcidio-id" value="0">
                                    <select class="form-control" name="subcidio-designcacao" onclick="getsubcidio();"required>
                                        <?php foreach ($dados['subcidio'] as $valor) { ?>
                                            <option value="<?= $valor->designacao ?>" ><?= $valor->designacao ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-sm" placeholder="Unidade" name="subcidio-unidade" value="AOA" readonly>
                                </td>
                                <td>
                                    <input type="text" step="any" class="form-control input-sm" placeholder="preco" name="subcidio-preco" value="0.00" readonly>
                                </td>
                                <td>
                                    <input type="number" step="any" class="form-control input-sm" placeholder="qtd" name="subcidio-qtd" onkeyup="calcular_subcidiodetalhe();" value="1.00" required>
                                </td>
                                <td>
                                    <input type="number" step="any" min="100" class="form-control input-sm" name="subcidio-subtotal" value="0.00" readonly >
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                    </button>
                                </td>
                            </tr>
                        </thead>
                    </form>
                    <tbody></tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <!-- /.row -->

        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-desconto">
                    <form id="form-desconto">
                        <thead>
                            <tr>
                                <th>Descontos</th>
                                <th width="100px">Moeda</th>
                                <th width="100px">Preço</th>
                                <th width="100px">Quantidade</th>
                                <th width="100px">Subtotal</th>
                                <th width="80px">Opcões</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" class="hidden" name="desconto-id" value="0">
                                    <select class="form-control" name="desconto-designcacao" onclick="getdesconto();"required>
                                        <?php foreach ($dados['desconto'] as $valor) { ?>
                                            <option value="<?= $valor->designacao ?>" ><?= $valor->designacao ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-sm" placeholder="Unidade" name="desconto-unidade" value="AOA" readonly>
                                </td>
                                <td>
                                    <input type="text" step="any" class="form-control input-sm" placeholder="preco" name="desconto-preco" value="0.00" readonly>
                                </td>
                                <td>
                                    <input type="number" step="any" class="form-control input-sm" placeholder="qtd" name="desconto-qtd" onkeyup="calcular_descontodetalhe();" value="1.00" required>
                                </td>
                                <td>
                                    <input type="number" step="any" min="100" class="form-control input-sm" name="desconto-subtotal" value="0.00" readonly >
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-plus-sign"></i> Adicionar
                                    </button>
                                </td>
                            </tr>
                        </thead>
                    </form>
                    <tbody></tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Este recibo comprova seu pagamento! 
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
<!--                <p class="lead">Dados Conta</p>-->

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="subtotal" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th style="width:50%">Salario (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="salario" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th>IRT (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="irt" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th>S.Social (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="ssocial" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th>Subsídios (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="subcidio" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th>Descontos (AKZ)</th>
                            <td><input type="text" step="any" class="form-control input-sm" name="desconto" value="0.00" readonly></td>
                        </tr>
                        <tr>
                            <th>Total (AKZ)</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="total" value="0.00" readonly></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <form  action="<?= base_url() ?>home" method="post">
                    <button type="button" name="salvar"  onclick=" salvar_salario();" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>
                        Efectuar Pagamento
                    </button>
                    <button type="submit" class="btn btn-default pull-right" style="margin-right: 5px;">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>

