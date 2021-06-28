<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\FuncionarioModel;

class Funcionario extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();
		
		$header = array(
			"aba" => "Funcionários",
			"menus" => $menus
		);
		
		$FuncionarioModel = new FuncionarioModel($db);
		$funcionarios =  $FuncionarioModel->listar();;

		$dados = array(
			"menus" => $menus,
			"funcionarios" => $funcionarios
		);

		echo view('fragments/header', $header);
      	echo view('funcionario/index', $dados);
      	echo view('fragments/footer');
	}
}
