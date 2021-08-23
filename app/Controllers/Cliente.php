<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\ClienteModel;

class Cliente extends BaseController
{
	private $cliente;
	private $menu; 

	public function __construct()
	{
		$this->cliente = new ClienteModel();  
		$this->menu = new UsuarioMenuModel();   
	}

	public function index()
	{

		$menus = $this->menu->listar();
		
		$header = array(
			"aba" => "Clientes",
			"menus" => $menus
		);
		
		$clientes =  $this->cliente->findAll();

		$dados = array(
			"clientes" => $clientes
		);

		$script = array(
			"script" => 'cliente'
		);

		echo view('fragments/header', $header);
      	echo view('cliente/index', $dados);
      	echo view('fragments/footer', $script);
	}
	
	public function cadastrar()
	{
		if($this->request->getMethod() === 'post'){
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'sobrenome'  => $this->request->getVar('sobrenome'),
				'telefone'  => preg_replace("/[^0-9]/", "", $this->request->getVar('telefone')),
				'celular'  => preg_replace("/[^0-9]/", "", $this->request->getVar('celular')),
				'rg'  => preg_replace("/[^0-9]/", "", $this->request->getVar('rg')),
				'cpf'  => preg_replace("/[^0-9]/", "", $this->request->getVar('cpf')),
				'como_conheceu'  => $this->request->getVar('como-conheceu'),
				'email'  => $this->request->getVar('email'),
				'profissao'  => $this->request->getVar('profissao'),
				'data_nascimento'  => $this->request->getVar('data-nascimento'),
				'instagram'  => $this->request->getVar('instagram'),
				'facebook'  => $this->request->getVar('facebook'),
				'hobby'  => $this->request->getVar('hobby'),
				'endereco'  => $this->request->getVar('endereco'),
				'numero'  => $this->request->getVar('numero'),
				'complemento'  => $this->request->getVar('complemento'),
				'bairro'  => $this->request->getVar('bairro'),
				'cidade'  => $this->request->getVar('cidade'),
				'uf'  => $this->request->getVar('uf'),
				'cep'  => preg_replace("/[^0-9]/", "", $this->request->getVar('cep')),
        	];
			$this->cliente->insert($data);
			return true;
		}
	}

	public function atualizar()
	{
		if($this->request->getMethod() === 'post'){
			$id_cliente = $this->request->getVar('id_cliente');
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'sobrenome'  => $this->request->getVar('sobrenome'),
				'telefone'  => preg_replace("/[^0-9]/", "", $this->request->getVar('telefone')),
				'celular'  => preg_replace("/[^0-9]/", "", $this->request->getVar('celular')),
				'rg'  => preg_replace("/[^0-9]/", "", $this->request->getVar('rg')),
				'cpf'  => preg_replace("/[^0-9]/", "", $this->request->getVar('cpf')),
				'como_conheceu'  => $this->request->getVar('como-conheceu'),
				'email'  => $this->request->getVar('email'),
				'profissao'  => $this->request->getVar('profissao'),
				'data_nascimento'  => $this->request->getVar('data-nascimento'),
				'instagram'  => $this->request->getVar('instagram'),
				'facebook'  => $this->request->getVar('facebook'),
				'hobby'  => $this->request->getVar('hobby'),
				'endereco'  => $this->request->getVar('endereco'),
				'numero'  => $this->request->getVar('numero'),
				'complemento'  => $this->request->getVar('complemento'),
				'bairro'  => $this->request->getVar('bairro'),
				'cidade'  => $this->request->getVar('cidade'),
				'uf'  => $this->request->getVar('uf'),
				'cep'  => preg_replace("/[^0-9]/", "", $this->request->getVar('cep')),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->cliente->update($id_cliente, $data);
			return true;
		}
	}
	
	public function lista()
	{
		if($this->request->getMethod() === 'get'){
			$id = $this->request->getVar('id');
			$cliente = $this->cliente->find($id);
			echo json_encode($cliente);
		}
	}

	public function busca(){
		$busca = $this->request->getVar('busca');
		$clientes =  $this->cliente->buscaCliente($busca);
		echo json_encode($clientes);
	}
}
