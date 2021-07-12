<?php

namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\UsuarioMenuModel;
use App\Models\FuncionarioModel;

class Menu extends BaseController
{
	private $menu; 
	private $usuarioMenu;
	private $funcionario; 

	public function __construct()
	{
		$this->menu = new MenuModel(); 
		$this->usuarioMenu = new UsuarioMenuModel();
		$this->funcionario = new FuncionarioModel(); 
	}

	public function index()
	{
		$menus = $this->menu->findAll();
		echo json_encode($menus);
	}

	public function usuario()
	{
		if($this->request->getMethod() === 'get'){
			$id = $this->request->getVar('id');
    		$menus = $this->usuarioMenu->userMenus($id);

			echo json_encode($menus);
		}else{
			echo json_encode('erro');
		}	
	}
}
