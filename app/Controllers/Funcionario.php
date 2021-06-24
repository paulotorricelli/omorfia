<?php

namespace App\Controllers;

class Funcionario extends BaseController
{
	public function index()
	{
		echo view('fragments/header');
      	echo view('funcionario/index');
      	echo view('fragments/footer');
	}
}
