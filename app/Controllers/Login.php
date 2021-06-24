<?php

namespace App\Controllers;

use App\Models\loginModel as NLogin;

class Login extends BaseController
{
	/*public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel', 'login');
	}	*/

	public function index()
	{
      	return view('login/index');
	}

	public function sessao()
	{		
		if ($this->input->post()) {
			$dados = $this->input->post();		
			$login = new NLogin();       
			$retorno = $login->login($dados);
			echo $retorno;

		} else {
			echo "erro";
		}
	}
}
