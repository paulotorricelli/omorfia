<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\FuncionarioModel;
use App\Controllers\Hash;

class Funcionario extends BaseController
{
	private $menu; 
	private $funcionario; 
	private $hash; 

	public function __construct()
	{
		$this->menu = new MenuModel();   
		$this->funcionario = new FuncionarioModel();
		$this->hash = new Hash();
	}

	public function index()
	{
		$menus = $this->menu->findAll();
		
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
		if($this->request->getMethod() === 'post'){
			$senha = $this->hash->set($this->request->getVar('senha'));
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'sobrenome'  => $this->request->getVar('sobrenome'),
				'celular'  => preg_replace("/[^0-9]/", "", $this->request->getVar('celular')),
				'email'  => $this->request->getVar('email'),
				'senha'  => $senha,
				'data_criacao'  => date('Y-m-d H:i:s'),
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->funcionario->insert($data);
			return true;
		}
	}
}
