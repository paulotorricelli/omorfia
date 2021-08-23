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
                                        <div class="col-sm-12 col-md-3">
                                            <label for="input-rg">RG: </label>
                                            <input class="form-control" type="text" id="input-rg" name="rg" placeholder="Digite o RG" >
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <label for="input-cpf">CPF: </label>
                                            <input class="form-control" type="text" id="input-cpf" name="cpf" placeholder="Digite o CPF" >
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="input-como-conheceu">Como nos conheceu? </label>
                                            <input class="form-control" type="text" id="input-como-conheceu" name="como-conheceu" placeholder="Digite como nos conheceu">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-email">E-mail: *</label>
                                            <input class="form-control" type="text" id="input-email" name="email" placeholder="e-mail@dominio.com.br" required>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-data-nascimento">Data de Nascimento: *</label>
                                            <input class="form-control" type="date" id="input-data-nascimento" name="data-nascimento" required>
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-data-nascimento">Profissão</label>
                                            <input class="form-control" type="text" id="input-profissao" name="profissao">
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
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-instagram">Instagram: </label>
                                            <input class="form-control" type="text" id="input-instagram" name="instagram">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-facebook">Facebook: </label>
                                            <input class="form-control" type="text" id="input-facebook" name="facebook">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-hobby">Hobby: </label>
                                            <input class="form-control" type="text" id="input-hobby" name="hobby">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-3">
                                            <label for="input-cep">CEP: </label>
                                            <input class="form-control" type="text" id="input-cep" name="cep">
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <label for="input-endereco">Endereço: </label>
                                            <input class="form-control" type="text" id="input-endereco" name="endereco">
                                        </div>
                                        <div class="col-sm-12 col-md-3">
                                            <label for="input-numero">Número: </label>
                                            <input class="form-control" type="text" id="input-numero" name="numero">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-sm-12 col-md-3">
                                            <label for="input-complemento">Complemento: </label>
                                            <input class="form-control" type="text" id="input-complemento" name="complemento">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-bairro">Bairro: </label>
                                            <input class="form-control" type="text" id="input-bairro" name="bairro">
                                        </div>
                                        <div class="col-sm-12 col-md-4">
                                            <label for="input-cidade">Cidade: </label>
                                            <input class="form-control" type="text" id="input-cidade" name="cidade">
                                        </div>
                                        <div class="col-sm-12 col-md-1">
                                            <label for="input-uf">UF: </label>
                                            <input class="form-control" type="text" id="input-uf" name="uf">
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
                                                            <a href="#" title="Prontuário" class="btn btn-outline-secondary btn-sm" id="<?= $item->id_cliente ?>" data-id="cliente">
                                                                <i class="fas fa-user"></i>
                                                            </a>
                                                            <a href="https://api.whatsapp.com/send?phone=55<?=$item->celular?>" title="WhatsApp" target="_blank" class="btn btn-outline-success btn-sm">
                                                                <i class="fab fa-whatsapp"></i>
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
                        <form id="form-edit-cliente" data-id="cliente/atualizar">
                            <input type="hidden" value="" id="input-id-modal" name="id_cliente">
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
                                <div class="col-sm-12 col-md-3">
                                    <label for="input-rg-modal">RG:</label>
                                    <input class="form-control" type="text" id="input-rg-modal" name="rg" placeholder="Digite o RG">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="input-cpf-modal">CPF:</label>
                                    <input class="form-control" type="text" id="input-cpf-modal" name="cpf" placeholder="Digite o CPF">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="input-como-conheceu-modal">Como nos conheceu? </label>
                                    <input class="form-control" type="text" id="input-como-conheceu-modal" name="como-conheceu" placeholder="Digite como nos conheceu">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-email-modal">E-mail: *</label>
                                    <input class="form-control" type="email" id="input-email-modal" name="email" placeholder="e-mail@dominio.com.br" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-data-nascimento-modal">Data de Nascimento: *</label>
                                    <input class="form-control" type="date" id="input-data-nascimento-modal" name="data-nascimento" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-data-nascimento">Profissão</label>
                                    <input class="form-control" type="text" id="input-profissao-modal" name="profissao">
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
                            <hr>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-instagram-modal">Instagram: </label>
                                    <input class="form-control" type="text" id="input-instagram-modal" name="instagram">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-facebook-modal">Facebook: </label>
                                    <input class="form-control" type="text" id="input-facebook-modal" name="facebook">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-hobby-modal">Hobby: </label>
                                    <input class="form-control" type="text" id="input-hobby-modal" name="hobby">
                                </div>
                            </div>
                            <hr>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-3">
                                    <label for="input-cep-modal">CEP: </label>
                                    <input class="form-control" type="text" id="input-cep-modal" name="cep">
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="input-endereco-modal">Endereço: </label>
                                    <input class="form-control" type="text" id="input-endereco-modal" name="endereco">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="input-numero-modal">Número: </label>
                                    <input class="form-control" type="text" id="input-numero-modal" name="numero">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-sm-12 col-md-3">
                                    <label for="input-complemento-modal">Complemento: </label>
                                    <input class="form-control" type="text" id="input-complemento-modal" name="complemento">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-bairro-modal">Bairro: </label>
                                    <input class="form-control" type="text" id="input-bairro-modal" name="bairro">
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="input-cidade-modal">Cidade: </label>
                                    <input class="form-control" type="text" id="input-cidade-modal" name="cidade">
                                </div>
                                <div class="col-sm-12 col-md-1">
                                    <label for="input-uf-modal">UF: </label>
                                    <input class="form-control" type="text" id="input-uf-modal" name="uf">
                                </div>
                            </div>                    
                            <div class="modal-footer justify-content-between">
                                <div class="form-group">               
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-primary btn-submit-update"> Atualizar <i class="fas fa-save"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>