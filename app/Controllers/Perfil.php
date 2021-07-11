<?php

namespace App\Controllers;


use App\Models\MenuModel;
use App\Models\FuncionarioModel;
use App\Controllers\Hash;


class Perfil extends BaseController
{
	private $login;
	private $logout;
	private $menu; 
	private $funcionario;
	private $hash; 

	public function __construct()
	{
		$this->menu = new MenuModel();
		$this->funcionario = new FuncionarioModel();   
		$this->hash = new Hash();   
	}


	public function index()
	{
		$menus = $this->menu->findAll();
		
		$header = array(
			"aba" => "Perfil",
			"menus" => $menus
		);
		
		$funcionario = $this->funcionario->where('id_usuario', '1')->first();

		$dados = array(
			"perfil" => $funcionario
		);

		echo view('fragments/header', $header);
      	echo view('perfil/index', $dados);
      	echo view('fragments/footer');
	}

	public function atualizar(){
		if($this->request->getMethod() === 'post'){
			$id_usuario = $this->request->getVar('id_usuario');
			$senha = $this->hash->set($this->request->getVar('senha'));
			$data = [
            	'nome' => $this->request->getVar('nome'),
            	'sobrenome'  => $this->request->getVar('sobrenome'),
				'celular'  => $this->request->getVar('celular'),
				'email'  => $this->request->getVar('email'),
				'senha'  => $senha,
				'data_modificacao'  => date('Y-m-d H:i:s'),
        	];
			$this->funcionario->update($id_usuario, $data);
			return true;
		}
	}
}
