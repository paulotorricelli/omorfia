<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\LoginModel;
use App\Models\ClienteModel;
use App\Controllers\Logout;

class Inicio extends BaseController
{
	private $login;
	private $logout;
	private $menu; 
	private $cliente;

	public function __construct()
	{
		$this->login = new LoginModel();  
		$this->menu = new UsuarioMenuModel();
		$this->cliente = new ClienteModel();  
		$this->logout = new Logout();     
	}

	public function index()
	{	

		if ($this->login->verificaLogin()) 
		{
			$menus = $this->menu->listar();

			$header = array(
				"aba" => "Início",
				"menus" => $menus
			);

			$dados = array(
				"atendimentos" => "0",
				"retornos" => "0%",
				"clientes" => count($this->cliente->findAll()),
				"unicos" => "0"
			);

			$script = array(
				"script" => 'inicio'
			);

			echo view('fragments/header', $header);
			echo view('inicio/index', $dados);
			echo view('fragments/footer', $script);
		}else{
			return $this->logout->index();
		}
	}
}
