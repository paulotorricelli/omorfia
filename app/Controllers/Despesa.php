<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Despesa extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();

		$header = array(
			"aba" => "Despesas",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('despesa/index');
      	echo view('fragments/footer');
	}
}
