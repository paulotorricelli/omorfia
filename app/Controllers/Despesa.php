<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Despesa extends BaseController
{
	public function index()
	{
		$MenuModel = new MenuModel();
		$menus = $MenuModel->findAll();

		$header = array(
			"aba" => "Despesas",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('despesa/index');
      	echo view('fragments/footer');
	}
}
