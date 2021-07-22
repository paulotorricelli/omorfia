<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\ProcedimentoModel;

class Procedimento extends BaseController
{
	private $menu; 
	private $procedimento; 

	public function __construct()
	{
		$this->menu = new UsuarioMenuModel();
		$this->procedimento = new ProcedimentoModel();   
	}

	public function index()
	{
		$menus = $this->menu->listar();

		$header = array(
			"aba" => "Procedimentos",
			"menus" => $menus
		);

		$procedimentos =  $this->procedimento->findAll();

		$dados = array(
			"procedimentos" => $procedimentos
		);

		$script = array(
			"script" => 'procedimento'
		);

		echo view('fragments/header', $header);
      	echo view('procedimento/index', $dados);
      	echo view('fragments/footer', $script);
	}
	
	public function cadastrar()
	{
		if($this->request->getMethod() === 'post'){
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'descricao'  => $this->request->getVar('descricao'),
				'valor'  => $this->request->getVar('valor-venda'),
				'status'  => 's',
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->procedimento->insert($data);
			return true;
		}
	}

	public function atualizar()
	{
		if($this->request->getMethod() === 'post'){
			$id_procedimento = $this->request->getVar('id_procedimento');
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'descricao'  => $this->request->getVar('descricao'),
				'valor_venda'  => $this->request->getVar('valor-venda'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->procedimento->update($id_cliente, $data);
			return true;
		}
	}
	
	public function lista()
	{
		if($this->request->getMethod() === 'get'){
			$id = $this->request->getVar('id');
			$procedimento = $this->procedimento->find($id);
			echo json_encode($procedimento);
		}
	}

	public function status()
	{
		if($this->request->getMethod() === 'post'){
			$id = $this->request->getVar('id');
			$status = $this->request->getVar('status');
			$data = [
            	'status' => $status,
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->procedimento->update($id, $data);
			echo true;
		}
	}
}
