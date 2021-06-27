<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Procedimento extends BaseController
{
	public function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = $MenuModel->all();

		$header = array(
			"aba" => "Procedimentos",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('procedimento/index');
      	echo view('fragments/footer');
	}
}
