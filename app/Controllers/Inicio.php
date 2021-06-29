<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\LoginModel;
use App\Controllers\Logout;

class Inicio extends BaseController
{
	public function index()
	{	
		$db = db_connect();
		$login = new LoginModel($db);
		$logout = new Logout();

		if ($login->verificaLogin()) 
		{
			$MenuModel = new MenuModel();
			$menus = $MenuModel->findAll();

			$header = array(
				"aba" => "Início",
				"menus" => $menus
			);

			echo view('fragments/header', $header);
			//view('cliente/index', $dados);
			echo view('fragments/footer');
		}else{
			return $logout->index();
		}
	}
}
