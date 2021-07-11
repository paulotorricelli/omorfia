<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Procedimento extends BaseController
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
			"aba" => "Procedimentos",
			"menus" => $menus
		);

		echo view('fragments/header', $header);
      	echo view('procedimento/index');
      	echo view('fragments/footer');
	}
}
