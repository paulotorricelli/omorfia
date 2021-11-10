<div class="content">
  <div class="container-fluid">
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-sm-12 col-md-12 col-lg-12">

            <div class="card card-primary">

              <div class="card-body">
                <form id="form-edit-perfil" data-id="perfil/atualizar">
                  <div class="row">
                    <div class="col-sm-12">
                      <p>(*) Campos obrigatórios.</p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 col-md-6">
                      <label for="input-nome">Nome: *</label>
                      <input class="form-control text-uppercase" type="text" id="input-nome" name="nome" value="<?=$perfil->nome?>" placeholder="Digite o nome" required>
                      <input type="hidden" name="id_usuario" value="<?=$perfil->id_usuario?>" />
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <label for="input-sobrenome">Sobrenome: *</label>
                      <input class="form-control text-uppercase" type="text" id="input-sobrenome" name="sobrenome" value="<?=$perfil->sobrenome?>" placeholder="Digite o sobrenome" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 col-md-7">
                      <label for="input-email">E-mail: *</label>
                      <input class="form-control" type="email" id="input-email" name="email" value="<?=$perfil->email?>" placeholder="e-mail@dominio.com.br" required>
                    </div>
                    <div class="col-sm-12 col-md-5">
                      <label for="input-celular">Celular: </label>
                      <input class="form-control" type="text" id="input-celular" name="celular" value="<?=$perfil->celular?>" placeholder="(DDD) 90000-0000">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <label for="input-senha">Nova senha: *</label>
                      <input class="form-control" type="password" id="input-senha" name="senha" placeholder="Senha" required>
                      <small>
                        Mín 8 caracteres. Utilize caracteres:
                        <ul>
                          <li>Maiúsculos</li>
                          <li>Minúsculos</li>
                          <li>Numéricos (0-9)</li>
                          <li>Especiais (!, $, #, %)</li>
                        </ul>
                      </small>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <label for="input-senha-confirmar">Confirmar senha: *</label>
                      <input class="form-control" type="password" id="input-senha-confirmar" name="confirmar-senha" placeholder="Confirmar senha" required>
                    </div>
                  </div>
                  <!--<div class="row">
                    <div class="col-12 text-center">
                      <hr />
                      <p class="h5">Acessos</p>
                      <hr />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="text-bold mb-3">Principal</span>
                        <?php foreach ($menus as $item) { ?>
                          <?php if ($item->tipo == 'lateral-principal') { ?>
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input custom-control-input-info" type="checkbox" value="<?= $item->id_menu ?>" id="register-menu-<?= $item->id_menu ?>" name="menus[]">
                              <label for="register-menu-<?= $item->id_menu ?>" class="custom-control-label"><?= $item->aba ?></label>
                            </div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <span class="text-bold mb-3">Gerenciar</span>
                        <?php foreach ($menus as $item) { ?>
                          <?php if ($item->tipo == 'lateral-gerenciamento') { ?>
                            <div class="custom-control custom-checkbox">
                              <input class="custom-control-input custom-control-input-success" type="checkbox" value="<?= $item->id_menu ?>" id="register-menu-<?= $item->id_menu ?>" name="menus[]">
                              <label for="register-menu-<?= $item->id_menu ?>" class="custom-control-label"><?= $item->aba ?></label>
                            </div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </div>
                  </div>-->
                  <div class="form-group row justify-content-end">
                    <div class="col-sm-12 col-md-4">
                      <button type="submit" class="btn btn-block btn-success btn-submit-update"> Atualizar <i class="fas fa-save"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>