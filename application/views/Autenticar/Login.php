<div class="login-box">
  <div class="login-logo">
      <a href="#"><b>SISTEMA HOSPITALAR</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <p class="login-box-msg"><?= ($this->session->userdata('mensagem') != null) ? "<b class='text-danger'>" . $this->session->userdata('mensagem') . "</b>" : "<b>Insira Suas Credênciais!</b>"; ?></p>
    <form action="<?php echo base_url('autenticar') ?>" method="post">
      <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" placeholder="Nome do Utilizador">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <input type="password" name="senha" class="form-control" placeholder="Senha">
      </div>
      <div class="row">
<!--         <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Relembrar
            </label>
          </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

<!--     <div class="social-auth-links text-center">
      <p>- OU -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Entrar com
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Entrar com
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->
<!-- 
    <a href="#">Esqueci minhas credênciais</a><br> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->