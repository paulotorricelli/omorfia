<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Inicio extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();

		$header = array(
			"aba" => "Início",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	//view('cliente/index', $dados);
      	echo view('fragments/footer');
	}
}
