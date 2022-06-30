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

                <?php if (!isset($_POST['continuar'])) { ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Funcionário - Dados Pessoais</b></h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="<?= base_url() ?>funcionario/editar/<?= $dados["funcionario"][0]->idfuncionario; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $dados["funcionario"][0]->idfuncionario; ?>" />
                            <input type="hidden" name="idcontacto" value="<?= $dados["funcionario"][0]->idcontacto; ?>" />
                            <input type="hidden" name="idendereco" value="<?= $dados["funcionario"][0]->idendereco; ?>" />
                            <div class="box-body">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="">Nome Completo</label>
                                        <input type="text" class="form-control"  name="nome" value="<?= $dados["funcionario"][0]->nomefuncionario; ?>" placeholder="Ex: Meu Génio" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Apelido</label>
                                        <input type="text" class="form-control"  name="apelido"  value="<?= $dados["funcionario"][0]->apelido; ?>" placeholder="Ex: Génio" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                            <img src="<?= base_url() ?>assets/media/imagem/<?= $dados["funcionario"][0]->foto ?>"  style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt=""/>
                                        </div>
                                        <div class="btn btn-default btn-file">
                                            <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                            <input type="file" id="arquivo" name="arquivo" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Identificação</label>
                                        <input type="text" class="form-control" name="ndi" value="<?= $dados["funcionario"][0]->ndi; ?>" placeholder="Ex: 111111111MO111"  required>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">Data de Nascimento</label>
                                        <input type="date" class="form-control" name="data" value="<?= $dados["funcionario"][0]->data; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="genero">Género:</label>
                                        <select class="form-control"  name="genero" required>
                                            <option value="MASCULINO" >MASCULINO</option>
                                            <option value="FEMININO" >FEMININO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="municipio">Cidade:</label>
                                        <select class="form-control"  name="municipio" required>
                                            <?php foreach ($dados['municipios'] as $valor) { ?>
                                                <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->nome); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="bairro">Bairro:</label>
                                        <input type="txt" class="form-control" id="bairro" name="bairro" value="<?= $dados["funcionario"][0]->bairro; ?>" placeholder="Ex: Vila-Boss" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="rua">Rua:</label>
                                        <input type="txt" class="form-control" id="rua" name="rua" value="<?= $dados["funcionario"][0]->rua; ?>" placeholder="Ex: 3-H" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="casa">Casa Nº:</label>
                                        <input type="txt" class="form-control" id="casa" name="casa" value="<?= $dados["funcionario"][0]->casa; ?>" placeholder="Ex: 33" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Telefone:</label>
                                        <input type="text" class="form-control" name="telefone" value="<?= $dados["funcionario"][0]->telefone; ?>" placeholder="Ex: (+244) 923 222 333" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" class="form-control" name="email" value="<?= $dados["funcionario"][0]->email; ?>" placeholder="Ex: sistemahospitalar@gmail.com"  required>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="continuar" class="btn btn-primary">Continuar</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if (isset($_POST['continuar'])) { ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Funcionário - Outros Dados</b></h3>
                        </div>
                        <!-- form start -->
                        <form role="form" action="<?= base_url() ?>funcionario/actualizar" method="post">
                            <div class="box-body">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Cargo</label>
                                        <select class="form-control"  name="cargo" required>
                                            <?php foreach ($dados['cargo'] as $valor) { ?>
                                                <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->designacao); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Data de Cadastro</label>
                                        <input type="date" class="form-control" name="data" value="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label >Salário</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        <input type="text" class="form-control" name="salario" value="<?= $dados["funcionario"][0]->salario; ?>" placeholder="Ex: 1000.00 " required>
                                        <span class="input-group-addon">.00</span>
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
                                <button type="submit" name="cancelar" class="btn btn-default">Cancelar</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!--******* RODAPE *******-->

