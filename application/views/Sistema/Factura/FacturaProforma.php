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
                <strong>  Para</strong>
                <address>
                    <input type="text" class="hidden" name="paciente" value="<?= $dados["paciente"][0]->id; ?>">
                    <b><?= $dados["paciente"][0]->nome; ?></b>
                </address>
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
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr> 
                            <th>Data Inicial</th>
                            <th>Dias</th>
                            <th>Data Final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" value="<?= date('d-m-Y'); ?>" style="background:transparent; border:0px; outline: none; text-align:center; width:100%" maxlength="5" id="data1" name="data1" readonly=""></td>
                            <td><input type="text" value="1" style="background:transparent; border:0px; outline: none; text-align:center; width:100%" maxlength="5" id="dia" name="dia" required></td>
                            <td><input type="text" value="<?= date('d-m-Y', strtotime("+1 days")); ?>" style="background:transparent; border:0px; outline: none; text-align:center; width:100%" maxlength="5" id="data2" name="data2" readonly=""></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-condensed table-bordered table-striped table-hover table-form" id="table-itemproforma">
                    <form id="form-itemproforma">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th width="100px">Unidade</th>
                                <th width="100px">Preço</th>
                                <th width="100px">Quantidade</th>
                                <th width="100px">Imposto</th>
                                <th width="100px">Subtotal</th>
                                <th width="80px">Opcões</th>
                            </tr>
                            <tr>
                                <td>
                                    
                                    <input type="text" class="hidden" name="itemproforma-id" value="0">
                                    <select class="form-control" name="itemproforma-designcacao" onclick="getitemproforma();"required>
                                        <option value="0" ></option>
                                        <?php foreach ($dados['servico'] as $valor) { ?>
                                            <option value="<?= $valor->designacao ?>" ><?= $valor->designacao ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control input-sm" placeholder="Unidade" name="itemproforma-unidade" value="AOA" readonly>
                                </td>
                                <td>
                                    <input type="text" step="any" class="form-control input-sm" placeholder="preco" name="itemproforma-preco" value="0" readonly>
                                </td>
                                <td>
                                    <input type="text" step="any" class="form-control input-sm" placeholder="qtd" name="itemproforma-qtd" onkeyup="calcular_itemproformadetalhe();" value="0" required>
                                </td>
                                <td>
                                    <input type="number" step="any" class="form-control input-sm" placeholder="imposto" name="itemproforma-imposto"  value="0" readonly >
                                </td>
                                <td>
                                    <input type="number" step="any" min="100" class="form-control input-sm" name="itemproforma-subtotal" value="0" readonly >
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
                        <tr>
                            <th colspan="5" style="text-align:right;">Total</th>
                            <td>
                                <input type="number" step="any" class="form-control input-sm" name="itemproforma-total" value="0" readonly>
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Método de Pagamento:</p>
                <div class="form-group">
                    <select class="form-control" id="metpag" name="metpag" required>
                        <option value="Dinheiro">Dinheiro</option>
                        <option value="Multicaixa">Multicaixa</option>
                        <option value="Tranferência">Tranferência</option>
                    </select>
                </div>
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    <textarea id="nota" name="nota" style="margin: 0px -17.6563px 0px 0px; width: 100%;  height: 143px;" placeholder="Escrever Nota"></textarea>
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Conta de Diverso</p>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Subtotal:</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="subtotal" value="0" readonly></td>
                        </tr>
               <!--          <tr>
                            <th>Valor a Pagar</th>
                            <td><input type="text" step="any" class="form-control input-sm" name="valorpago" onkeyup="itemproforma_total();" value="0" ></td>
                        </tr> -->
                        <tr>
                            <th>Imposto</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="imposto" value="0" readonly></td>
                        </tr>
                        <tr>
                            <th>Desconto (AKZ)</th>
                            <td><input type="text" step="any" class="form-control input-sm" name="desconto" onkeyup="itemproforma_total();" value="0" ></td>
                        </tr>
                        <tr>
                            <th>Valor em Divida:</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="valordivida" value="0" readonly></td>
                        </tr>
                        <tr>
                            <th>Total:</th>
                            <td> <input type="number" step="any" class="form-control input-sm" name="total" value="0" readonly></td>
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
                    <button type="button" name="salvar"  onclick="salvar_itemproforma();" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i>
                       Salvar
                    </button>
                    <button type="submit" class="btn btn-default pull-right" style="margin-right: 5px;">
                        <i class="fa fa-times"></i> Cancelar
                    </button>
                </form>
            </div>
        </div>
    </section>
</div>

