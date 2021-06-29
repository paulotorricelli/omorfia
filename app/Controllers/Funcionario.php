<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\FuncionarioModel;

class Funcionario extends BaseController
{
	public function index()
	{
		$MenuModel = new MenuModel();
		$menus = $MenuModel->findAll();
		
		$header = array(
			"aba" => "Funcionários",
			"menus" => $menus
		);
		
		$FuncionarioModel = new FuncionarioModel();
		$funcionarios =  $FuncionarioModel->findAll();

		$dados = array(
			"menus" => $menus,
			"funcionarios" => $funcionarios
		);

		echo view('fragments/header', $header);
      	echo view('funcionario/index', $dados);
      	echo view('fragments/footer');
	}
}
