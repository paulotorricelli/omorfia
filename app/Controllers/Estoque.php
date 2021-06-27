<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Estoque extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();

		$header = array(
			"aba" => "Estoque",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('estoque/index');
      	echo view('fragments/footer');
	}
}
