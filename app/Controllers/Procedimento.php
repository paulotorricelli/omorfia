<?php

namespace App\Controllers;

class Procedimento extends BaseController
{
	public function index()
	{
		echo view('fragments/header');
      	echo view('procedimento/index');
      	echo view('fragments/footer');
	}
}
