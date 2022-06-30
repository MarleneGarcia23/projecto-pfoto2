<div class="login-box">
  <div class="login-logo">
      <a href="#"><b>Sublime-Administrativo</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
     <p class="login-box-msg"><?= ($this->session->userdata('mensagem') != null) ? "<b class='text-danger'>" . $this->session->userdata('mensagem') . "</b>" : "<b>Insira Suas Credênciais!</b>"; ?></p>
    <form action="<?php echo base_url('new') ?>" method="post">
      <div class="form-group has-feedback">
          <label>Senha Nova</label>
          <input type="password" name="senha" class="form-control" placeholder="Senha" required>
          <span class="glyphicon glyphicon-key form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
          <label>Repete a Senha</label>
          <input type="password" name="senha_" class="form-control" placeholder="Repete Senha" required>
          <span class="glyphicon glyphicon-key form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Alterar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
