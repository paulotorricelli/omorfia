<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\ProdutoModel;

class Produto extends BaseController
{
	private $menu;
	private $produto;

	public function __construct()
	{
		$this->menu = new UsuarioMenuModel();
		$this->produto = new ProdutoModel();
	}

	public function index()
	{
		$menus = $this->menu->listar();

		$header = array(
			"aba" => "Produtos",
			"menus" => $menus
		);

		$produtos =  $this->produto->findAll();

		$dados = array(
			"produtos" => $produtos
		);

		$script = array(
			"script" => 'produto'
		);

		echo view('fragments/header', $header);
		echo view('produto/index', $dados);
		echo view('fragments/footer', $script);
	}

	public function cadastrar()
	{
		if ($this->request->getPost()) {
			$data = [
				'nome' => $this->request->getVar('nome'),
				'descricao'  => $this->request->getVar('descricao'),
				'valor_venda'  => $this->request->getVar('valor-venda'),
				'status'  => 's',
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->produto->insert($data);
			echo true;
		}
	}

	public function atualizar()
	{
		if ($this->request->getPost()) {
			$id_produto = $this->request->getVar('id_produto');
			$data = [
				'nome' => $this->request->getVar('nome'),
				'descricao'  => $this->request->getVar('descricao'),
				'valor_venda'  => $this->request->getVar('valor-venda'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
			];
			$this->produto->update($id_produto, $data);
			echo true;
		}
	}

	public function lista()
	{
		if ($this->request->getGet()) {
			$id = $this->request->getVar('id');
			$produto = $this->produto->find($id);
			echo json_encode($produto);
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
			$this->produto->update($id, $data);
			echo true;
		}
	}
}
