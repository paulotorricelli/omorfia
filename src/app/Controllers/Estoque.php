<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;

class Estoque extends BaseController
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
			"aba" => "Estoque",
			"menus" => $menus
		);

		$script = array(
			"script" => 'estoque'
		);

		echo view('fragments/header', $header);
		echo view('estoque/index');
		echo view('fragments/footer', $script);
	}
}
