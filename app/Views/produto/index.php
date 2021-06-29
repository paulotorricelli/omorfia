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
                    <h3 class="card-title"><i class="fas fa-plus-circle"></i> Registrar novo produto </h3>
                  </div>
                  <div class="col-sm-2 text-right">
                    <div class="card-tools">
                      <button type="button" class="btn btn-sm btn-success" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form id="form-new-produto" data-id="produto/cadastrar">
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
                      <label for="input-valor-venda">Valor de venda: (R$) </label>
                      <input class="form-control" type="number" id="input-valor-venda" name="valor-venda">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-12">
                      <label for="input-descricao">Descrição: </label>
                      <textarea class="form-control" id="input-descricao" name="descricao"></textarea>
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
                <h3 class="card-title"><i class="fas fa-list-ul"></i> Lista de produtos</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover table-sm text-center table-management">
                    <thead>
                      <tr>
                        <th>Ações</th>
                        <th>Status</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor de venda - R$</th>
                      </tr>
                    </thead>
                    <tbody class="text-uppercase">
                      <?php if (isset($produtos) && count($produtos) > 0) { ?>
                        <?php foreach ($produtos as $item) { ?>
                          <tr>
                            <td class="align-middle">
                              <a href="#" title="Editar" class="btn btn-outline-primary btn-sm btn-modal" id="<?= $item->id_produto ?>" data-id="produto">
                                <i class="fas fa-edit"></i>
                              </a>
                            </td>
                            <td class="align-middle">
                              <div class="input-group justify-content-center mt-1">
                                <div class="form-group">
                                  <div class="custom-control custom-radio d-inline align-middle">
                                    <input class="custom-control-input custom-control-input-success radio-status" type="radio" id="ativar-<?= $item->id_produto ?>" name="<?= $item->id_produto ?>" data-id="produto/s/<?= $item->id_produto ?>" <?= $item->status == 's' ? 'checked' : '' ?>>
                                    <label for="ativar-<?= $item->id_produto ?>" class="custom-control-label">
                                      <!--filtro-->
                                      <?= $item->status == 's' ? '<span class="d-none">s</span>' : '' ?>
                                    </label>
                                  </div>
                                  <div class="custom-control custom-radio d-inline align-middle">
                                    <input class="custom-control-input custom-control-input-danger radio-status" type="radio" id="inativar-<?= $item->id_produto ?>" name="<?= $item->id_produto ?>" data-id="produto/n/<?= $item->id_produto ?>" <?= $item->status == 'n' ? 'checked' : '' ?>>
                                    <label for="inativar-<?= $item->id_produto ?>" class="custom-control-label"></label>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td class="align-middle"><?= $item->nome ?></td>
                            <td class="align-middle"><?= $item->descricao ?></td>
                            <td class="align-middle"><?= $item->valor_venda ?></td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr class="text-center">
                          <td colspan="5">Nenhum produto registrado</td>
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
    <div class="modal fade" id="modal-produto">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="nav-icon fas fa-cube"></i> Editar produto </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="form-edit-produto" data-id="produto/cadastrar">
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
                <div class="col-sm-12 col-md-6">
                  <label for="input-nome-modal">Nome: *</label>
                  <input class="form-control" type="text" id="input-nome-modal" name="nome" placeholder="Digite o nome" required>
                </div>
                <div class="col-sm-12 col-md-6">
                  <label for="input-valor-venda-modal">Valor de venda: (R$) </label>
                  <input class="form-control" type="number" id="input-valor-venda-modal" name="valor-venda">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-12">
                  <label for="input-descricao-modal">Descrição: </label>
                  <textarea class="form-control" id="input-descricao-modal" name="descricao"></textarea>
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