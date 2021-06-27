<?php

namespace App\Controllers;

use App\Models\MenuModel;

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

		echo view('fragments/header', $header);
      	echo view('funcionario/index');
      	echo view('fragments/footer');
	}
}
