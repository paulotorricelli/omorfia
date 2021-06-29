<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Produto extends BaseController
{
	public function index()
	{
		$MenuModel = new MenuModel();
		$menus = $MenuModel->findAll();

		$header = array(
			"aba" => "Produtos",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('produto/index');
      	echo view('fragments/footer');
	}
}
