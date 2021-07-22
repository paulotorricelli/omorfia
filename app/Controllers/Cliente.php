<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\ClienteModel;

class Cliente extends BaseController
{
	private $cliente;
	private $menu; 

	public function __construct()
	{
		$this->cliente = new ClienteModel();  
		$this->menu = new MenuModel();   
	}

	public function index()
	{

		$menus = $this->menu->findAll();
		
		$header = array(
			"aba" => "Clientes",
			"menus" => $menus
		);
		
		$clientes =  $this->cliente->findAll();

		$dados = array(
			"clientes" => $clientes
		);

		echo view('fragments/header', $header);
      	echo view('cliente/index', $dados);
      	echo view('fragments/footer');
	}
	
	public function cadastrar()
	{
		if($this->request->getMethod() === 'post'){
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'sobrenome'  => $this->request->getVar('sobrenome'),
				'telefone'  => preg_replace("/[^0-9]/", "", $this->request->getVar('telefone')),
				'celular'  => preg_replace("/[^0-9]/", "", $this->request->getVar('celular')),
				'email'  => $this->request->getVar('email'),
				'data_nascimento'  => $this->request->getVar('data-nascimento'),
        	];
			$this->cliente->insert($data);
			return true;
		}
	}
}
