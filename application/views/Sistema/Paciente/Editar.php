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
                    <form role="form" action="<?= base_url() ?>paciente/actualizar" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $dados["paciente"][0]->id ?>" />
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input type="text" class="form-control" name="nome" value="<?= $dados["paciente"][0]->nome ?>" placeholder="Paciente" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Identificação</label>
                                    <input type="text" class="form-control" name="ndi" value="<?= $dados["paciente"][0]->ndi ?>" placeholder="Ex: 111111111LA111" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipo de Paciente</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="<?= $dados["paciente"][0]->tipo ?>"><?= $dados["paciente"][0]->tipo ?></option>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                        <img src="<?= base_url() ?>assets/media/imagem/<?= $dados["paciente"][0]->imagem ?>" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt="" />
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
                                    <input type="text" class="form-control" name="ndi" value="<?= $dados["paciente"][0]->ndi; ?>" placeholder="Ex: 111111111MO111" required>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="data" value="<?= $dados["paciente"][0]->data; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Altura</label>
                                    <input type="text" class="form-control" name="altura" value="<?= $dados["paciente"][0]->altura; ?>" placeholder="Escreva..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Raça</label>
                                    <input type="text" class="form-control" name="raca" value="<?= $dados["paciente"][0]->raca; ?>" placeholder="Escreva..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select class="form-control" name="genero" required>
                                        <option value="<?= $dados["paciente"][0]->genero ?>"><?= $dados["paciente"][0]->genero ?></option>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMININO">FEMININO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="municipio">Cidade:</label>
                                    <select class="form-control" name="cidade" required>

                                        <?php foreach ($dados['municipios'] as $valor) {
                                            if ($dados["paciente"][0]->cidade == $valor->id) { ?>
                                                <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                        <?php }
                                        } ?>
                                        <?php foreach ($dados['municipios'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <input type="txt" class="form-control" id="bairro" name="bairro" value="<?= $dados["paciente"][0]->bairro; ?>" placeholder="Ex: Vila-Boss" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rua">Rua:</label>
                                    <input type="txt" class="form-control" id="rua" name="rua" value="<?= $dados["paciente"][0]->rua; ?>" placeholder="Ex: 3-H" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="casa">Casa Nº:</label>
                                    <input type="txt" class="form-control" id="ncasa" name="ncasa" value="<?= $dados["paciente"][0]->ncasa; ?>" placeholder="Ex: 33" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Telefone:</label>
                                    <input type="text" class="form-control" name="telefone" value="<?= $dados["paciente"][0]->telefone; ?>" placeholder="Ex: (+244) 923 222 333" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="email" class="form-control" name="email" value="<?= $dados["paciente"][0]->email; ?>" placeholder="Ex: sistemahospitalar@gmail.com" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="box-group" id="accordion">
                                    <div class="panel box box-primary">
                                        <div class="box-header with-border">
                                            <h4 class="box-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="true" class="collapsed">
                                                    Dados do Parceiro
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse1" class="panel-collapse collapse" aria-expanded="true" style="height: 0px;">
                                            <div class="box-body">
                                                <div class="col-md-12">

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="municipio">É Paciente?</label>
                                                            <select class="form-control" name="ispaciente" onclick="showhidenomepaciente();">
                                                                <option value="0" <?= ($dados["paciente"][0]->ispaciente == '0') ? 'selected' : '' ?>>Não</option>
                                                                <option value="1" <?= ($dados["paciente"][0]->ispaciente == '1') ? 'selected' : '' ?>>Sim</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10" name="showhidenomepacienteparceiro">
                                                        <div class="form-group">
                                                            <label for="municipio">Nome Paciente:</label>
                                                            <select class="form-control" name="nomepacienteparceiro">
                                                                <option value="<?= $dados["paciente"][0]->nomeparceiro; ?>"><?= $dados["paciente"][0]->nomeparceiro; ?></option>
                                                                <?php foreach ($dados['pacientes'] as $valor) { ?>
                                                                    <option value="<?= $valor->nome; ?>"><?= $valor->nome; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10" name="showhidenomeparceiro">
                                                        <div class="form-group">
                                                            <label for="">Nome</label>
                                                            <input type="text" class="form-control" name="nomeparceiro" value="<?= $dados["paciente"][0]->nomeparceiro; ?>" placeholder="Paciente">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Identificação</label>
                                                            <input type="text" class="form-control" name="ndiparceiro" value="<?= $dados["paciente"][0]->ndiparceiro; ?>" placeholder="Ex: 111111111LA111">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                                                <img src="<?= base_url() ?>assets/media/imagem/<?= $dados["paciente"][0]->imagemparceiro ?>" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt="" />
                                                            </div>
                                                            <div class="btn btn-default btn-file">
                                                                <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                                                <input type="file" id="arquivoparceiro" name="arquivoparceiro" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Data de Nascimento</label>
                                                            <input type="date" class="form-control" value="<?= $dados["paciente"][0]->dataparceiro; ?>" name="dataparceiro">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="genero">Género:</label>
                                                            <select class="form-control" name="generoparceiro">
                                                                <option value="<?= $dados["paciente"][0]->generoparceiro ?>"><?= $dados["paciente"][0]->generoparceiro ?></option>
                                                                <option value="MASCULINO">MASCULINO</option>
                                                                <option value="FEMININO">FEMININO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Altura</label>
                                                            <input type="text" class="form-control" name="alturaparceiro" value="<?= $dados["paciente"][0]->alturaparceiro; ?>" placeholder="Escreva...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Raça</label>
                                                            <input type="text" class="form-control" name="racaparceiro" value="<?= $dados["paciente"][0]->racaparceiro; ?>" placeholder="Escreva...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="municipio">Cidade:</label>
                                                            <select class="form-control" name="cidadeparceiro">
                                                                <?php foreach ($dados['municipios'] as $valor) {
                                                                    if ($dados["paciente"][0]->cidadeparceiro == $valor->id) { ?>
                                                                        <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                                                <?php }
                                                                } ?>
                                                                <?php foreach ($dados['municipios'] as $valor) { ?>
                                                                    <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="bairro">Bairro:</label>
                                                            <input type="txt" class="form-control" id="bairroparceiro" name="bairroparceiro" value="<?= $dados["paciente"][0]->bairroparceiro; ?>" placeholder="Ex: Vila-Boss">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="rua">Rua:</label>
                                                            <input type="txt" class="form-control" id="ruaparceiro" name="ruaparceiro" value="<?= $dados["paciente"][0]->ruaparceiro; ?>" placeholder="Ex: 3-H">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="casa">Casa Nº:</label>
                                                            <input type="txt" class="form-control" id="ncasaparceiro" name="ncasaparceiro" value="<?= $dados["paciente"][0]->ncasaparceiro; ?>" placeholder="Ex: 33">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Telefone</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                                <input type="text" class="form-control" name="telefoneparceiro" value="<?= $dados["paciente"][0]->telefoneparceiro; ?>" placeholder="Ex: (+244) 923 222 333">
                                                            </div>
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>E-mail:</label>
                                                            <input type="email" class="form-control" name="emailparceiro" value="<?= $dados["paciente"][0]->emailparceiro; ?>" placeholder="Ex: sistemahospitalar@gmail.com">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

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