<?php

namespace App\Controllers;

use App\Models\CrudModel;

class Crud extends BaseController
{
	private $crud; 

	public function __construct()
	{
		$this->crud = new CrudModel(); 
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
