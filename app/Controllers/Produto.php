<?php

namespace App\Controllers;

class Produto extends BaseController
{
	public function index()
	{
		echo view('fragments/header');
      	echo view('produto/index');
      	echo view('fragments/footer');
	}
}
