<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Produto extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();

		$header = array(
			"aba" => "Produtos",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('produto/index');
      	echo view('fragments/footer');
	}
}
