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
                    <form role="form" action="<?= base_url() ?>paciente/cadastrar" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nome</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Paciente" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Identificação</label>
                                    <input type="text" class="form-control" name="ndi" placeholder="Ex: 111111111LA111" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tipo de Paciente</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="NORMAL">NORMAL</option>
                                        <option value="VIP">VIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                        <img src="<?= base_url() ?>assets/media/imagem/avatar.png" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt="" />
                                    </div>
                                    <div class="btn btn-default btn-file">
                                        <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                        <input type="file" id="arquivo" name="arquivo" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Data de Nascimento</label>
                                    <input type="date" class="form-control" name="data" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="genero">Género:</label>
                                    <select class="form-control" name="genero" required>
                                        <option value="MASCULINO">MASCULINO</option>
                                        <option value="FEMININO">FEMININO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Altura</label>
                                    <input type="text" class="form-control" name="altura" value="0" placeholder="Escreva..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="">Raça</label>
                                    <input type="text" class="form-control" name="raca" placeholder="Escreva..." required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="municipio">Cidade:</label>
                                    <select class="form-control" name="cidade" required>
                                        <?php foreach ($dados['municipios'] as $valor) { ?>
                                            <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="bairro">Bairro:</label>
                                    <input type="txt" class="form-control" id="bairro" name="bairro" placeholder="Ex: Vila-Boss" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="rua">Rua:</label>
                                    <input type="txt" class="form-control" id="rua" name="rua" placeholder="Ex: 3-H" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="casa">Casa Nº:</label>
                                    <input type="txt" class="form-control" id="ncasa" name="ncasa" placeholder="Ex: 33" required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="text" class="form-control" name="telefone" placeholder="Ex: (+244) 923 222 333" required>
                                    </div>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail:</label>
                                    <input type="email" class="form-control" name="email" placeholder="Ex: sistemahospitalar@gmail.com" required>
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
                                                                <option value="0">Não</option>
                                                                <option value="1">Sim</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10" name="showhidenomepacienteparceiro">
                                                        <div class="form-group">
                                                            <label for="municipio">Nome Paciente:</label>
                                                            <select class="form-control" name="nomepacienteparceiro">
                                                                <?php foreach ($dados['pacientes'] as $valor) { ?>
                                                                    <option value="<?= $valor->nome; ?>"><?= $valor->nome; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-10" name="showhidenomeparceiro">
                                                        <div class="form-group">
                                                            <label for="">Nome</label>
                                                            <input type="text" class="form-control" name="nomeparceiro" placeholder="Paciente">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="">Identificação</label>
                                                            <input type="text" class="form-control" name="ndiparceiro" placeholder="Ex: 111111111LA111">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                                                <img src="<?= base_url() ?>assets/media/imagem/avatar.png" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt="" />
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
                                                            <input type="date" class="form-control" name="dataparceiro">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="genero">Género:</label>
                                                            <select class="form-control" name="generoparceiro">
                                                                <option value="MASCULINO">MASCULINO</option>
                                                                <option value="FEMININO">FEMININO</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Altura</label>
                                                            <input type="text" class="form-control" value="0" name="alturaparceiro" placeholder="Escreva...">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Raça</label>
                                                            <input type="text" class="form-control" name="racaparceiro" placeholder="Escreva...">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="municipio">Cidade:</label>
                                                            <select class="form-control" name="cidadeparceiro">
                                                                <?php foreach ($dados['municipios'] as $valor) { ?>
                                                                    <option value="<?= $valor->id; ?>"><?= strtoupper($valor->nome); ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="bairro">Bairro:</label>
                                                            <input type="txt" class="form-control" id="bairroparceiro" name="bairroparceiro" placeholder="Ex: Vila-Boss">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="rua">Rua:</label>
                                                            <input type="txt" class="form-control" id="ruaparceiro" name="ruaparceiro" placeholder="Ex: 3-H">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="casa">Casa Nº:</label>
                                                            <input type="txt" class="form-control" id="ncasaparceiro" name="ncasaparceiro" placeholder="Ex: 33">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Telefone</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">
                                                                    <i class="fa fa-phone"></i>
                                                                </div>
                                                                <input type="text" class="form-control" name="telefoneparceiro" placeholder="Ex: (+244) 923 222 333">
                                                            </div>
                                                        </div>
                                                        <!-- /.input group -->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>E-mail:</label>
                                                            <input type="email" class="form-control" name="emailparceiro" placeholder="Ex: sistemahospitalar@gmail.com">
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