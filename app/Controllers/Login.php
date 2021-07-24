<?php

namespace App\Controllers;

use App\Models\LoginModel;
use Sonata\GoogleAuthenticator\GoogleAuthenticator;

class Login extends BaseController
{
	private $login;
	private $secret;
	private $auth;

	public function __construct()
	{
		$this->login = new LoginModel();   
		$this->secret = '3DHTQX4GCRKHGS55CJ'; 
		$this->auth = new GoogleAuthenticator();  
	}

	public function index(){
		//$qrcode = $this->auth->getUrl('omorfiaestetica', 'omorfiaestetica.com.br', $this->secret);
		$qrcode = $this->auth->getUrl('omorfiaestetica', $_SERVER['HTTP_HOST'], $this->secret);
		$code = $this->auth->getCode($this->secret);
		$secret = $this->secret;

		$dados = array(
			'qrcode' => $qrcode,
			'code' => $code,
			'secret' => $secret
		);

      	echo view('login/index', $dados);
	}

	public function sessao()
	{
		if ($this->request->getPost()) {

			$dados = $this->request->getPost();		 
			$retorno = $this->login->login($dados);
			echo $retorno;
		} else {
			echo "erro";
		}
	}
}
