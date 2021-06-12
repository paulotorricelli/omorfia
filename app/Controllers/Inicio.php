<?php

namespace App\Controllers;

class Inicio extends BaseController
{
	public function index()
	{
		//view('welcome_message');
		echo view('fragments/header');
      	//view('cliente/index', $dados);
      	echo view('fragments/footer');
	}
}
