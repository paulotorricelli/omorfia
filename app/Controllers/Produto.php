<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\ProdutoModel;

class Produto extends BaseController
{
	private $menu; 
	private $produto; 

	public function __construct()
	{
		$this->menu = new MenuModel();  
		$this->produto = new ProdutoModel();  
	}

	public function index()
	{
		$menus = $this->menu->findAll();

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
		if($this->request->getMethod() === 'post'){
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'descricao'  => $this->request->getVar('descricao'),
				'valor_venda'  => $this->request->getVar('valor-venda'),
				'status'  => 's',
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->produto->insert($data);
			return true;
		}
	}

	public function atualizar()
	{
		if($this->request->getMethod() === 'post'){
			$id_produto = $this->request->getVar('id_produto');
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'descricao'  => $this->request->getVar('descricao'),
				'valor_venda'  => $this->request->getVar('valor-venda'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->produto->update($id_cliente, $data);
			return true;
		}
	}
	
	public function lista()
	{
		if($this->request->getMethod() === 'get'){
			$id = $this->request->getVar('id');
			$produto = $this->produto->find($id);
			echo json_encode($produto);
		}
	}
}
