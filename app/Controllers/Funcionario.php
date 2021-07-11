<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\FuncionarioModel;

class Funcionario extends BaseController
{
	private $menu; 
	private $funcionario; 

	public function __construct()
	{
		$this->menu = new MenuModel();   
		$this->funcionario = new FuncionarioModel();
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
			"menus" => $menus,
			"funcionarios" => $funcionarios
		);

		echo view('fragments/header', $header);
      	echo view('funcionario/index', $dados);
      	echo view('fragments/footer');
	}
}
