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
                        <h3 class="box-title">Actualizar Instituicão</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>instituicao/actualizar" method="post" enctype="multipart/form-data">
                        <div class="box-body">                                   
                            <input type="hidden" name="id" value="<?= $dados["instituicao"][0]->codigo; ?>" />
                            <input type="hidden" name="idendereco" value="<?= $dados["instituicao"][0]->codend ?>" />
                            <input type="hidden" name="idcontacto" value="<?= $dados["instituicao"][0]->codcont ?>" />
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nome da Instituição:</label>
                                    <input type="text" class="form-control" name="nome" value="<?= $dados["instituicao"][0]->nome ?>" placeholder="Ex: Meu Génio"  required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>NIF:</label>
                                    <input type="text" class="form-control" name="nif" value="<?= $dados["instituicao"][0]->nif ?>" placeholder="Ex: 111122223333"  required>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label >Criado aos:</label>
                                    <input type="date" min="1950-01-01" max="<?= date('Y-m-d') ?>" value="<?= $dados["instituicao"][0]->data ?>" class="form-control" name="data"required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                        <img src="<?= base_url() ?>assets/media/imagem/<?= $dados["instituicao"][0]->logotipo ?>"  style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt=""/>
                                    </div>
                                    <div class="btn btn-default btn-file">
                                        <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                        <input type="file" id="arquivo" name="arquivo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" value="<?= $dados["instituicao"][0]->telefone ?>" placeholder="Ex: (+244) 923 222 333"  required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="email" class="form-control" name="email" value="<?= $dados["instituicao"][0]->email ?>" placeholder="Ex: sistemahospitalar@gmail.com"  required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="codigopostal">Codigo Postal:</label>
                                    <input type="txt" class="form-control" id="codigopostal" name="codigopostal" value="<?= $dados["instituicao"][0]->cpostal ?>" placeholder="Ex: 33331114444" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="municipio">Cidade:</label>
                                    <select class="form-control"  name="municipio" required>
                                        <option value="<?= $dados["instituicao"][0]->idmunicipio ?>" ><?= strtoupper($dados["instituicao"][0]->nomemunicipio) ?></option>
                                        <?php foreach ($dados['municipios'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>" ><?= strtoupper($valor->nome); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <input type="txt" class="form-control" id="bairro" name="bairro" value="<?= $dados["instituicao"][0]->bairro ?>" placeholder="Ex: Vila-Boss" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rua">Rua:</label>
                                    <input type="txt" class="form-control" id="rua" name="rua" value="<?= $dados["instituicao"][0]->rua ?>" placeholder="Ex: 3-H" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="casa">Casa Nº:</label>
                                    <input type="txt" class="form-control" id="casa" name="casa" value="<?= $dados["instituicao"][0]->casa ?>" placeholder="Ex: 33" required>
                                </div>
                            </div>
                        </div>                       
                        <div class="box-footer">
                            <button type="submit" name="actualizar" class="btn btn-primary">Actualizar</button>
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

