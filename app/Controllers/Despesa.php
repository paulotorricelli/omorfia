<?php

namespace App\Controllers;

use App\Models\MenuModel;

class Despesa extends BaseController
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
			"aba" => "Despesas",
			"menus" => $menus
		);

		$script = array(
			"script" => 'despesa'
		);

		echo view('fragments/header', $header);
      	echo view('despesa/index');
      	echo view('fragments/footer', $script);
	}
}
