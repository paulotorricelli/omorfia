<div class="content">
	<div class="container-fluid">
		<div class="content">
			<div class="container-fluid">
				<div class="row justify-content-end">
					<div class="col-sm-12 col-md-10 col-lg-8">
						<div class="card collapsed-card card-danger card-outline animate__animated animate__fadeInRight">
							<div class="card-header">
								<div class="row">
									<div class="col-sm-10">
										<h3 class="card-title"><i class="fas fa-plus-circle"></i> Registrar nova despesa </h3>
									</div>
									<div class="col-sm-2 text-right">
										<div class="card-tools">
											<button type="button" class="btn btn-sm btn-danger" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<form id="form-new-despesa" data-id="despesa/cadastrar">
									<div class="row">
										<div class="col-sm-12">
											<p>(*) Campos obrigatórios.</p>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-6">
											<label for="input-data-despesa">Data da Despesa: </label>
											<input class="form-control" type="date" id="input-data-despesa" name="data-despesa" required>
										</div>
									</div>
									<hr>
									<div class="form-group row">
										<div class="col-sm-12">
											<label for="input-descricao">Descrição: *</label>
											<textarea class="form-control" type="text" id="input-descricao" name="descricao" required></textarea>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-6">
											<label for="input-categoria">Categoria: </label>
											<select name="categoria" id="input-categoria" class="form-control" required>
												<option selected disabled> -- Selecionar -- </option>
												<?php foreach ($categorias as $item) { ?>
													<option value="<?= $item->id_categoria_despesa ?>"> <?= $item->nome ?> </option>
												<?php } ?>
											</select>
										</div>
										<div class="col-sm-12 col-md-6">
											<label for="input-valor">Valor: </label>
											<input class="form-control" type="number" id="input-valor" name="valor" placeholder="R$ 0,00" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-sm-12 col-md-3">
											<label for="input-repetir">Repetir: </label>
											<select name="repetir" id="input-repetir" class="form-control" required>
												<?php for ($i = 1; $i <= 12; $i++) { ?>
													<option value="<?= $i ?>"> <?= $i ?>x </option>
												<?php } ?>
											</select>
										</div>
										<div class="col-sm-12 col-md-4 mt-4 text-center">
											<div class="icheck-success d-inline">
												<input type="checkbox" name="despesa-fixa" id="input-despesa-fixa">
												<label for="input-despesa-fixa">Despesa Fixa</label>
											</div>
										</div>
										<div class="col-sm-12 col-md-5">
											<label for="input-status">Status: </label>
											<select name="status" id="input-status" class="form-control" required>
												<option value="pago"> Pago </option>
												<option value="pendente"> Pendente </option>
											</select>
										</div>
									</div>
									<div class="form-group row justify-content-end">
										<div class="col-sm-12 col-md-4">
											<button type="submit" class="btn btn-block btn-danger btn-submit"> Registrar <i class="fas fa-money-check-alt"></i>
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
								<h3 class="card-title"><i class="fas fa-list-ul"></i> Lista de despesas</h3>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-striped table-hover table-sm text-center table-management">
										<thead>
											<tr>
												<th>Ações</th>
												<th>Descrição</th>
												<th>Valor</th>
												<th>Categoria</th>
												<th>Despesa fixa</th>
												<th>Repetir</th>
												<th>Status</th>
												<th>Data de despesa</th>
											</tr>
										</thead>
										<tbody class="text-uppercase">
											<?php if (isset($despesas) && count($despesas) > 0) { ?>
												<?php foreach ($despesas as $item) { ?>
													<tr>
														<td class="align-middle">
															<a href="#" title="Editar" class="btn btn-outline-primary btn-sm btn-modal" id="<?= $item->id_despesa ?>" data-id="despesa">
																<i class="fas fa-edit"></i>
															</a>
														</td>
														<td class="align-middle"><?= $item->descricao ?></td>
														<td class="align-middle"><?= $item->valor ?></td>
														<td class="align-middle"><?= $item->id_categoria ?></td>
														<td class="align-middle"><?= $item->despesa_fixa ?></td>
														<td class="align-middle"><?= $item->repetir ?>x</td>
														<td class="align-middle"><?= $item->status ?></td>
														<td class="align-middle"><?= $item->data_despesa ?></td>
													</tr>
												<?php } ?>
											<?php } else { ?>
												<tr class="text-center">
													<td colspan="8">Nenhuma despesa registrada</td>
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
		<div class="modal fade" id="modal-despesa">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title"><i class="nav-icon fas fa-user-friends"></i> Editar Despesa </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="form-edit-despesa" data-id="despesa/atualizar">
							<input type="hidden" value="" id="input-id-modal" name="id_despesa">
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
									<label for="input-data-despesa-modal">Data da Despesa: </label>
									<input class="form-control" type="date" id="input-data-despesa-modal" name="data-despesa" required>
								</div>
							</div>
							<hr>
							<div class="form-group row">
								<div class="col-sm-12">
									<label for="input-descricao-modal">Descrição: *</label>
									<textarea class="form-control" type="text" id="input-descricao-modal" name="descricao" required></textarea>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 col-md-6">
									<label for="input-categoria-modal">Categoria: </label>
									<select name="categoria" id="input-categoria-modal" class="form-control" required>
										<?php foreach ($categorias as $item) { ?>
											<option value="<?= $item->id_categoria_despesa ?>"> <?= $item->nome ?> </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="input-valor-modal">Valor: </label>
									<input class="form-control" type="number" id="input-valor-modal" name="valor" placeholder="R$ 0,00" required>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 col-md-6">
									<label for="input-repetir-modal">Repetir: </label>
									<select name="repetir" id="input-repetir-modal" class="form-control" required>
										<?php for ($i = 1; $i <= 12; $i++) { ?>
											<option value="<?= $i ?>"> <?= $i ?>x </option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-12 col-md-6">
									<label for="input-status-modal">Status: </label>
									<select name="status" id="input-status-modal" class="form-control" required>
										<option value="pago"> Pago </option>
										<option value="pendente"> Pendente </option>
									</select>
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