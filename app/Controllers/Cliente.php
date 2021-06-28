<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\ClienteModel;

class Cliente extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();
		
		$header = array(
			"aba" => "Clientes",
			"menus" => $menus
		);
		
		$ClienteModel = new ClienteModel($db);
		$clientes =  $ClienteModel->listar();;

		$dados = array(
			"clientes" => $clientes
		);

		echo view('fragments/header', $header);
      	echo view('cliente/index', $dados);
      	echo view('fragments/footer');
	}
}
