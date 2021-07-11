<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Estoque extends BaseController
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
			"aba" => "Estoque",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('estoque/index');
      	echo view('fragments/footer');
	}
}
