<?php

namespace App\Controllers;

use App\Models\FuncionarioModel;
use App\Models\UsuarioMenuModel;
use App\Controllers\Hash;

class Funcionario extends BaseController
{
	private $funcionario;
	private $hash;
	private $menu;

	public function __construct()
	{
		$this->funcionario = new FuncionarioModel();
		$this->hash = new Hash();
		$this->menu = new UsuarioMenuModel();
	}

	public function index()
	{
		$menus = $this->menu->listar();

		$header = array(
			"aba" => "Funcionários",
			"menus" => $menus
		);


		$funcionarios =  $this->funcionario->findAll();

		$dados = array(
			"funcionarios" => $funcionarios
		);


		$script = array(
			"script" => 'funcionario'
		);

		echo view('fragments/header', $header);
		echo view('funcionario/index', $dados);
		echo view('fragments/footer', $script);
	}

	public function cadastrar()
	{
		if ($this->request->getPost()) {
			$menus = $this->request->getVar('menus');
			var_dump($menus);
			$senha = $this->hash->set($this->request->getVar('senha'));
			$data = [
				'nome' => $this->request->getVar('nome'),
				'sobrenome'  => $this->request->getVar('sobrenome'),
				'celular'  => preg_replace("/[^0-9]/", "", $this->request->getVar('celular')),
				'email'  => $this->request->getVar('email'),
				'senha'  => $senha,
				'status'  => 's',
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->funcionario->insert($data);
			$id = $this->funcionario->getInsertID();

			//menu de acesso
			foreach ($menus as $menu) {
				$menuAcesso = array(
					'id_usuario' => $id,
					'id_menu' => $menu,
				);
				$this->menu->inserir($menuAcesso);
			}

			echo true;
		}
	}

	public function atualizar()
	{
		if ($this->request->getPost()) {
			$id = $this->request->getVar('id_usuario');
			$menus = $this->request->getVar('menus');
			$data = [
				'nome' => $this->request->getVar('nome'),
				'sobrenome'  => $this->request->getVar('sobrenome'),
				'email'  => $this->request->getVar('email'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->funcionario->update($id, $data);
			$this->menu->remover($id);
			//menu de acesso
			foreach ($menus as $menu) {
				$menuAcesso = array(
					'id_usuario' => $id,
					'id_menu' => $menu,
				);

				$this->menu->inserir($menuAcesso);
			}

			echo true;
		}
	}

	public function lista()
	{
		if ($this->request->getGet()) {
			$id = $this->request->getVar('id');
			$funcionario = $this->funcionario->find($id);
			echo json_encode($funcionario);
		}
	}

	public function status()
	{
		if ($this->request->getPost()) {
			$id = $this->request->getVar('id');
			$status = $this->request->getVar('status');
			$data = [
				'status' => $status,
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->funcionario->update($id, $data);
			echo true;
		}
	}
}
