<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Omorfiá | Estética Personalizada</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= base_url()?>/resources/dist/img/favicon.ico" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>/resources/plugins/fontawesome-free/css/all.min.css">
  <!-- Tema -->
  <link rel="stylesheet" href="<?=base_url()?>/resources/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/resources/dist/css/login.css">
  <link rel="stylesheet" href="<?=base_url()?>/resources/plugins/toastr/toastr.min.css">
  <script src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="hold-transition login-page bg-login">
  <div class="login-box">
    <div class="login-logo">
      <a href=" "><img src="" alt=""></a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <div class="text-center mb-2">
          <img src="<?=base_url()?>/resources/dist/img/logo.png" alt="Omorfiá Logo" class="img-fluid">
          <small class="login-box-msg mb-3">Autenticação</small>
        </div>
        <form id="formLogin" autocomplete="false">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Usuário" name="inputUsuario" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-alt"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Senha" name="inputSenha" autocomplete="off" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-unlock-alt">
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-3">
            <div class="col-md-12 g-recaptcha" data-sitekey="6LduiH0bAAAAAKUuOA7-04D3bJV_hkM-SfZMUsku" style="width: 304px !important; max-width: 304px !important; -ms-transform: scale(1.06); -webkit-transform: scale(1.06); transform: scale(1.06); margin: 0px; padding: 0px;"></div>
          </div>

          <div class="row">
            <div class="col-12">
              <button type="button" onclick="logar();" class="btn btn-primary btn-block">Logar</button>
            </div>
          </div>

        </form>
      </div>
      <div class="card-footer text-center">
        <small>
          <strong> &copy; <a href="https://omorfiaestetica.com.br/" target="_blank"> Omorfiá Estética Personalizada</a></strong>
        </small>
      </div>
    </div>
  </div>
  <script>var diretorio = '<?=base_url()?>';</script>
  <script src="<?=base_url()?>/resources/plugins/jquery/jquery.min.js"></script>
  <script src="<?=base_url()?>/resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url()?>/resources/dist/js/adminlte.min.js"></script>
  <script src="<?=base_url()?>/resources/plugins/toastr/toastr.min.js"></script>
  <script src="<?=base_url()?>/resources/dist/js/util/alerta.min.js"></script>
  <script src="<?=base_url()?>/resources/dist/js/login/login.js"></script>
</body>

</html>