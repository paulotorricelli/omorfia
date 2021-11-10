<?php

namespace App\Controllers;

class Logout extends BaseController
{
	public function index()
	{
		$items = ['nome', 'nome_sobrenome', 'email', 'telefone', 'id_usuario', 'estado'];
		session()->remove($items);
		return redirect()->to('/login');
	}
}
