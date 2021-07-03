<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\LoginModel;
use App\Controllers\Logout;

class Inicio extends BaseController
{
	private $login;
	private $logout;
	private $menu; 

	public function __construct()
	{
		$this->login = new LoginModel();  
		$this->menu = new MenuModel();
		$this->logout = new Logout();     
	}

	public function index()
	{	

		if ($this->login->verificaLogin()) 
		{
			$menus = $this->menu->findAll();

			$header = array(
				"aba" => "Início",
				"menus" => $menus
			);

			echo view('fragments/header', $header);
			echo view('inicio/index');
			echo view('fragments/footer');
		}else{
			return $this->logout->index();
		}
	}
}
