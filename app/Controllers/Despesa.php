<?php

namespace App\Controllers;

class Despesa extends BaseController
{
	public function index()
	{
		echo view('fragments/header');
      	echo view('despesa/index');
      	echo view('fragments/footer');
	}
}
