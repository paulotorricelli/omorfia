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
                                        <h3 class="card-title"><i class="fas fa-plus-circle"></i> Registrar novo cliente </h3>
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-sm btn-success" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="form-new-cliente" data-id="cliente/cadastrar">
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
                                        <div class="col-sm-12 col-md-8">
                                            <label for="input-email">E-mail: *</label>
                                            <input class="form-control" type="text" id="input-email" name="email" placeholder="e-mail@dominio.com.br" required>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-data-nascimento">Data de Nascimento: *</label>
                                            <input class="form-control" type="date" id="input-data-nascimento" name="data-nascimento" required>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-6">
                                            <label for="input-telefone">Telefone Fixo: </label>
                                            <input class="form-control" type="text" id="input-telefone" name="telefone" placeholder="1100000000">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="input-celular">Celular: *</label>
                                            <input class="form-control" type="text" id="input-celular" name="celular" placeholder="11900000000" required>
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
                                <h3 class="card-title"><i class="fas fa-list-ul"></i> Lista de clientes</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-sm text-center table-management">
                                        <thead>
                                            <tr>
                                                <th>Ações</th>
                                                <th>Nome</th>
                                                <th>Sobrenome</th>
                                                <th>Celular</th>
                                                <th>Telefone Fixo</th>
                                                <th>E-mail</th>
                                                <th>Nascimento</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-uppercase">
                                            <?php if (isset($clientes) && count($clientes) > 0) { ?>
                                                <?php foreach ($clientes as $item) { ?>
                                                    <tr>
                                                        <td class="align-middle">
                                                            <a href="#" title="Editar" class="btn btn-outline-primary btn-sm btn-modal" id="<?= $item->id_cliente ?>" data-id="cliente">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td class="align-middle"><?= $item->nome ?></td>
                                                        <td class="align-middle"><?= $item->sobrenome ?></td>
                                                        <td class="align-middle"><?= $item->celular ?></td>
                                                        <td class="align-middle"><?= $item->telefone ?></td>
                                                        <td class="align-middle"><?= $item->email ?></td>
                                                        <td class="align-middle"><?= $item->data_nascimento ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <tr class="text-center">
                                                    <td colspan="7">Nenhum cliente registrado</td>
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
        <div class="modal fade" id="modal-cliente">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><i class="nav-icon fas fa-user-friends"></i> Editar Cliente </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edit-cliente" data-id="cliente/cadastrar">
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
                                    <label for="input-sobrenome-modal">Sobrenome: *</label>
                                    <input class="form-control" type="text" id="input-sobrenome-modal" name="sobrenome" placeholder="Digite o sobrenome" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-8">
                                    <label for="input-email-modal">E-mail: *</label>
                                    <input class="form-control" type="email" id="input-email-modal" name="email" placeholder="e-mail@dominio.com.br" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-data-nascimento-modal">Data de Nascimento: *</label>
                                    <input class="form-control" type="date" id="input-data-nascimento-modal" name="data-nascimento" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-6">
                                    <label for="input-telefone-modal">Telefone Fixo: </label>
                                    <input class="form-control" type="text" id="input-telefone-modal" name="telefone" placeholder="(DDD) 0000-0000">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="input-celular-modal">Celular: *</label>
                                    <input class="form-control" type="text" id="input-celular-modal" name="celular" placeholder="(DDD) 90000-0000">
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-12 col-md-4">
                                    <button type="submit" class="btn btn-block btn-success btn-submit"> Registrar <i class="fas fa-save"></i>
                                    </button>
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