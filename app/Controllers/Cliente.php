<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Cliente extends BaseController
{


	function index()
	{
		$db = db_connect();
		$MenuModel = new MenuModel($db);
		$menus = []; //$MenuModel->all();

		$header = array(
			"aba" => "Clientes",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('cliente/index');
      	echo view('fragments/footer');
	}
}
