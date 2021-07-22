<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Produto extends BaseController
{
	private $menu; 

	public function __construct()
	{
		$this->menu = new MenuModel();   
	}

	public function index()
	{
		$menus = $this->menu->findAll();

		$header = array(
			"aba" => "Produtos",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('produto/index');
      	echo view('fragments/footer');
	}
}
