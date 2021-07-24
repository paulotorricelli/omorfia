<?php

namespace App\Controllers;

use App\Models\UsuarioMenuModel;
use App\Models\DespesaModel;

class Despesa extends BaseController
{
	private $menu;
	private $despesa;

	public function __construct()
	{
		$this->despesa = new DespesaModel();  
		$this->menu = new UsuarioMenuModel();
	}

	public function index()
	{

		$menus = $this->menu->listar();

		$header = array(
			"aba" => "Despesas",
			"menus" => $menus
		);

		$despesas =  $this->despesa->findAll();

		$dados = array(
			"despesas" => $despesas
		);

		$script = array(
			"script" => 'despesa'
		);

		echo view('fragments/header', $header);
		echo view('despesa/index', $dados);
		echo view('fragments/footer', $script);
	}
}
