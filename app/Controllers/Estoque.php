<?php

namespace App\Controllers;

class Estoque extends BaseController
{
	public function index()
	{
		echo view('fragments/header');
      	echo view('estoque/index');
      	echo view('fragments/footer');
	}
}
