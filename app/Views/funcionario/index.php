<div class="content">
  <div class="container-fluid">
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-end">
          <div class="col-sm-12 col-md-10 col-lg-8">
            <div class="card collapsed-card card-success card-outline animate__animated animate__fadeInRight">
              <div class="card-header">
                <div class="row">
                  <div class="col-sm-10">
                    <h3 class="card-title"><i class="fas fa-plus-circle"></i> Registrar novo funcionário </h3>
                  </div>
                  <div class="col-sm-2 text-right">
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm btn-success" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form id="form-new-funcionario" data-id="funcionario/cadastrar">
                  <div class="row">
                    <div class="col-sm-12">
                      <p>(*) Campos obrigatórios.</p>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 col-md-6">
                      <label for="input-nome">Nome: *</label>
                      <input class="form-control" type="text" id="input-nome" name="nome" placeholder="Digite o nome" required>
                    </div>
                    <div class="col-sm-12 col-md-6">
                      <label for="input-sobrenome">Sobrenome: *</label>
                      <input class="form-control" type="text" id="input-sobrenome" name="sobrenome" placeholder="Digite o sobrenome" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12 col-md-7">
                      <label for="input-email">E-mail: *</label>
                      <input class="form-control" type="email" id="input-email" name="email" placeholder="e-mail@dominio.com.br" required>
                    </div>
                    <div class="col-sm-12 col-md-5">
                      <label for="input-telefone">Telefone: </label>
                      <input class="form-control" type="telefone" id="input-telefone" name="telefone" placeholder="(DDD) 90000-0000">
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
                  <div class="row">
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
                  </div>
                  <div class="form-group row justify-content-end">
                    <div class="col-sm-12 col-md-4">
                      <button type="submit" class="btn btn-block btn-success btn-submit"> Registrar <i class="fas fa-save"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card animate__animated animate__fadeInUp">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list-ul"></i> Lista de funcionários</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm text-center table-management">
                    <thead>
                      <tr>
                        <th>Ações</th>
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Sobrenome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                      </tr>
                    </thead>
                    <tbody class="text-uppercase">
                      <?php if (isset($funcionarios) && count($funcionarios) > 0) { ?>
                        <?php foreach ($funcionarios as $item) { ?>
                          <tr>
                            <td class="align-middle">
                              <a href="#" title="Editar" class="btn btn-outline-primary btn-sm btn-modal" id="<?= $item->id_usuario ?>" data-id="usuario">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            <td class="align-middle">
                              <div class="input-group justify-content-center mt-1">
                                <div class="form-group">
                                  <div class="custom-control custom-radio d-inline align-middle">
                                    <input class="custom-control-input custom-control-input-success radio-status" type="radio" id="ativar-<?= $item->id_usuario ?>" name="<?= $item->id_usuario ?>" data-id="usuario/s/<?= $item->id_usuario ?>" <?= $item->status == 's' ? 'checked' : '' ?>>
                                    <label for="ativar-<?= $item->id_usuario ?>" class="custom-control-label">
                                      <!--filtro-->
                                      <?= $item->status == 's' ? '<span class="d-none">s</span>' : '' ?>
                                    </label>
                                  </div>
                                  <div class="custom-control custom-radio d-inline align-middle">
                                    <input class="custom-control-input custom-control-input-danger radio-status" type="radio" id="inativar-<?= $item->id_usuario ?>" name="<?= $item->id_usuario ?>" data-id="usuario/n/<?= $item->id_usuario ?>" <?= $item->status == 'n' ? 'checked' : '' ?>>
                                    <label for="inativar-<?= $item->id_usuario ?>" class="custom-control-label"></label>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="align-middle"><?= $item->nome ?></td>
                            <td class="align-middle"><?= $item->sobrenome ?></td>
                            <td class="align-middle"><?= $item->email ?></td>
                            <td class="align-middle"><?= $item->telefone ?></td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr class="text-center">
                          <td colspan="6">Nenhum funcionário registrado</td>
                        </tr>
                      <?php } ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal-funcionario">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="nav-icon fas fa-id-badge"></i> Editar Funcionário </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-edit-funcionario" data-id="funcionario/cadastrar">
              <input type="hidden" value="" id="input-id" name="id">
              <div class="row">
                <div class="col-sm-12">
                  <p>(*) Campos obrigatórios.</p>
                </div>
              </div>
              <div class="row form-group">
                <div class="col-sm-6">
                  <label class="mr-2">Criação:</label><span id="input-data-criacao"> </span>
                </div>
                <div class="col-sm-6">
                  <label class="mr-2">Última modificação:</label><span id="input-data-modificacao"> </span>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12 col-md-3">
                  <label for="input-nome-modal">Nome: *</label>
                  <input class="form-control" type="text" id="input-nome-modal" name="nome" placeholder="Digite o nome" required>
                </div>
                <div class="col-sm-12 col-md-3">
                  <label for="input-sobrenome-modal">Sobrenome: *</label>
                  <input class="form-control" type="text" id="input-sobrenome-modal" name="sobrenome" placeholder="Digite o sobrenome" required>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="input-nome-modal">E-mail: *</label>
                  <input class="form-control" type="email" id="input-email-modal" name="email" placeholder="e-mail@dominio.com.br" required>
                </div>
              </div>
              <div class="row">
                <div class="col-12 text-center">
                  <hr>
                  <p class="h5">Acessos</p>
                  <hr>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <span class="text-bold mb-3">Principal</span>
                  <div class="form-group clearfix" id="div-principal">

                  </div>
                </div>
                <div class="col-sm-12 col-md-6">
                  <span class="text-bold mb-3">Gerenciamento</span>
                  <div class="form-group clearfix" id="div-gerenciar">

                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Salvar alterações <i class="fas fa-save"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>