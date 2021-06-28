<?php

namespace App\Controllers;

use \App\Models\LoginModel;

class Login extends BaseController
{
	public function index()
	{
      	return view('login/index');
	}

	public function sessao()
	{		
		if ($this->request->getMethod() === 'post') {
			$db = db_connect();
			$dados = $this->request->getPost();	
			$login = new LoginModel($db);		 
			$retorno = $login->login($dados);
			echo $retorno;

		} else {
			echo "erro";
		}
	}
}
