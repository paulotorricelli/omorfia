<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;

class Despesa extends BaseController
{
	private $menu; 

	public function __construct()
	{
		$this->menu = new UsuarioMenuModel(); 
	}

	public function index()
	{

		$menus = $this->menu->listar();

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
