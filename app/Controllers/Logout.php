<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel', 'login');
	}	

	public function index()
	{ 
		$this->login->logout();
		redirect(base_url(), 'auto');
	}
}