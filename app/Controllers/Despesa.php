<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\DespesaModel;
use App\Models\CategoriaDespesaModel;

class Despesa extends BaseController
{
	private $menu;
	private $despesa;
	private $categoria;

	public function __construct()
	{
		$this->despesa = new DespesaModel();
		$this->categoria = new CategoriaDespesaModel();
		$this->menu = new UsuarioMenuModel();
	}

	public function index()
	{

		$menus = $this->menu->listar();

		$header = array(
			"aba" => "Despesas",
			"menus" => $menus
		);

		$despesas =  $this->despesa->findAll();
		$categorias =  $this->categoria->findAll();

		$dados = array(
			"despesas" => $despesas,
			"categorias" => $categorias
		);

		$script = array(
			"script" => 'despesa'
		);

		echo view('fragments/header', $header);
		echo view('despesa/index', $dados);
		echo view('fragments/footer', $script);
	}

	public function cadastrar()
	{
		if ($this->request->getPost()) {
			$data = [
				'valor' => $this->request->getVar('nome'),
				'descricao'  => $this->request->getVar('sobrenome'),
				'id_categoria'  => $this->request->getVar('categoria'),
				'repetir'  => $this->request->getVar('repetir'),
				'status'  => $this->request->getVar('status'),
				'data_despesa'  => $this->request->getVar('data-despesa'),
				'despesa_fixa'  => $this->request->getVar('despesa-fixa'),
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->despesa->insert($data);
			return true;
		}
	}

	public function atualizar()
	{
		if ($this->request->getPost()) {
			$id_despesa = $this->request->getVar('id_despesa');
			$data = [
				'valor' => $this->request->getVar('nome'),
				'descricao'  => $this->request->getVar('sobrenome'),
				'id_categoria'  => $this->request->getVar('categoria'),
				'repetir'  => $this->request->getVar('repetir'),
				'status'  => $this->request->getVar('status'),
				'data_despesa'  => $this->request->getVar('data-despesa'),
				'despesa_fixa'  => $this->request->getVar('despesa-fixa'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->despesa->update($id_despesa, $data);
			return true;
		}
	}

	public function lista()
	{
		if ($this->request->getGet()) {
			$id = $this->request->getVar('id');
			$despesa = $this->despesa->find($id);
			echo json_encode($despesa);
		}
	}
}
