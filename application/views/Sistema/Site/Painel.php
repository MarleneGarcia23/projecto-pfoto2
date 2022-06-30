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
        <div class="col-md-12">
            <?php if ($this->uri->segment(3) == 1) { ?>
                <!-- general form elements -->
                <div name="mensagem" class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="fa fa-check"></i>Sucesso!</h4>
                </div>
            <?php } ?>
            <?php if ($this->uri->segment(3) == 2) { ?>
                <div name="mensagem" class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="fa fa-close"></i>Dados Inválidos!</h4>
                </div>
            <?php } ?>
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Painel</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="<?= base_url() ?>site/actualizar"  method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $dados[0]->id ?>" />
                        <input type="hidden" name="arquivo" value="<?= $dados[0]->logotipo ?>" />
                        <input type="hidden" name="arquivo1" value="<?= $dados[0]->slide_img1 ?>" />
                        <input type="hidden" name="arquivo2" value="<?= $dados[0]->slide_img2 ?>" />
                        <input type="hidden" name="arquivo3" value="<?= $dados[0]->slide_img3 ?>" />
                        
                        <input type="hidden" name="arquivo4" value="<?= $dados[0]->servico_img1 ?>" />
                        <input type="hidden" name="arquivo5" value="<?= $dados[0]->servico_img2 ?>" />
                        <input type="hidden" name="arquivo6" value="<?= $dados[0]->servico_img3 ?>" />
                        <input type="hidden" name="arquivo7" value="<?= $dados[0]->servico_img4 ?>" />
                        <input type="hidden" name="arquivo8" value="<?= $dados[0]->servico_img5 ?>" />
                        <input type="hidden" name="arquivo9" value="<?= $dados[0]->nota_img ?>" />

                        <div class="box-body">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Telefone 1</label>
                                    <input type="text" class="form-control"  name="telefone1" value="<?= $dados[0]->telefone1 ?>" placeholder="Digite..." >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Telefone 2</label>
                                    <input type="text" class="form-control"  name="telefone2" value="<?= $dados[0]->telefone2 ?>" placeholder="Digite..." >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control"  name="email" value="<?= $dados[0]->email ?>" placeholder="Digite..." >
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Dias</label>
                                    <input type="text" class="form-control"  name="dias" value="<?= $dados[0]->dias ?>" placeholder="Digite..." >
                                </div>
                            </div>                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Horas</label>
                                    <input type="text" class="form-control"  name="horas" value="<?= $dados[0]->horas ?>" placeholder="Digite..." >
                                </div>
                            </div>   
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Facebook</label>
                                    <input type="text" class="form-control"  name="facebook" value="<?= $dados[0]->facebook ?>" placeholder="Digite..." >
                                </div>
                            </div>   
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Instagram</label>
                                    <input type="text" class="form-control"  name="instagram" value="<?= $dados[0]->instagram ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Botão 1</label>
                                    <input type="text" class="form-control"  name="btn1" value="<?= $dados[0]->btn1 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">Botão 2</label>
                                    <input type="text" class="form-control"  name="btn2" value="<?= $dados[0]->btn2 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Slide Texto 1</label>
                                    <textarea class="form-control" name="slide_txt1"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->slide_txt1 ?></textarea>
                                </div>
                            </div>
              
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Slide Texto 2</label>
                                    <textarea class="form-control" name="slide_txt2"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->slide_txt2 ?></textarea>
                                </div>
                            </div>
                            
 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Slide Texto 3</label>
                                    <textarea class="form-control" name="slide_txt3"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->slide_txt3 ?></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nota Titulo</label>
                                    <input type="text" class="form-control"  name="nota_titulo" value="<?= $dados[0]->nota_titulo ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nota Descricão</label>
                                    <textarea class="form-control" name="nota_descricao"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->nota_descricao ?></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nota Autor</label>
                                    <input type="text" class="form-control"  name="nota_autor" value="<?= $dados[0]->nota_autor ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nota Cargo</label>
                                    <input type="text" class="form-control"  name="nota_cargo" value="<?= $dados[0]->nota_cargo ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço</label>
                                    <input type="text" class="form-control"  name="servico" value="<?= $dados[0]->servico ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo</label>
                                    <input type="text" class="form-control"  name="servico_titulo" value="<?= $dados[0]->servico_titulo ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo 1</label>
                                    <input type="text" class="form-control"  name="servico_titulo1" value="<?= $dados[0]->servico_titulo1 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Descrição 1</label>
                                    <textarea class="form-control" name="servico_descricao1"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->servico_descricao1 ?></textarea>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo 2</label>
                                    <input type="text" class="form-control"  name="servico_titulo2" value="<?= $dados[0]->servico_titulo2 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Descrição 2</label>
                                    <textarea class="form-control" name="servico_descricao2"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->servico_descricao2 ?></textarea>
                                </div>
                            </div>
                            
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo 3</label>
                                    <input type="text" class="form-control"  name="servico_titulo3" value="<?= $dados[0]->servico_titulo3 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Descrição 3</label>
                                    <textarea class="form-control" name="servico_descricao3"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->servico_descricao3 ?></textarea>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo 4</label>
                                    <input type="text" class="form-control"  name="servico_titulo4" value="<?= $dados[0]->servico_titulo4 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Descrição 4</label>
                                    <textarea class="form-control" name="servico_descricao4"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->servico_descricao4 ?></textarea>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Titulo 5</label>
                                    <input type="text" class="form-control"  name="servico_titulo5" value="<?= $dados[0]->servico_titulo5 ?>" placeholder="Digite..." >
                                </div>
                            </div> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Serviço Descrição 5</label>
                                    <textarea class="form-control" name="servico_descricao5"  style="margin: 0px -17.6563px 0px 0px;  height: 143px;" ><?= $dados[0]->servico_descricao5 ?></textarea>
                                </div>
                            </div>
                            
                            
                            <!--div class="col-md-3">
                                   <label for="">Logotipo</label>
                                <div class="form-group">
                                    <div id="imagem" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered">
                                        <img src="<?= base_url() ?>assets/media/imagem/<?= $dados[0]->logotipo ?>" style="border:2px solid #EAEAEA; height: 105px; width:153px;" class="img-responsive pic-bordered" alt=""/>
                                    </div>
                                    <div class="btn btn-default btn-file">
                                        <i class="glyphicon glyphicon-picture"></i> Carregar Imagem
                                        <input type="file" id="arquivo" name="arquivo" class="form-control">
                                    </div>
                                </div>
                            </div-->
                            
                            
                            <div class="col-md-3">
                                   <label for="">Logotipo</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Nota</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo9" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Slide 1</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo1" class="form-control">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Slide 2</label>
                                            <div class="form-group">
                                    <input type="file" name="arquivo2" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Slide 3</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo3" class="form-control">
                                </div>
                            </div>
                            
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Serviço 1</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo4" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Serviço 2</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo5" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Serviço 3</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo6" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Serviço 4</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo7" class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                   <label for="">Imagem Serviço 5</label>
                                <div class="form-group">
                                    <input type="file" name="arquivo8" class="form-control">
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

