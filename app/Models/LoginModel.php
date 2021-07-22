<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;
use App\Controllers\Hash;

class loginModel extends Model
{   
    protected $db;
    protected $hash;
    
    public function __construct(){
        $this->db = db_connect();
        $this->hash = new Hash();   
    }

    //INICIO - LOGIN
    public function login($dados)
    {
        $email =    trim($dados['inputUsuario']);
        $senha =    trim($dados['inputSenha']);
		$captcha =  $dados['g-recaptcha-response'];

		if (isset($captcha) && !empty($captcha)) {

            /*$url = "https://www.google.com/recaptcha/api/siteverify";
            $data = array('secret' => "6LduiH0bAAAAAFrDpnCRixzpHLarw-XHm6YI2YGP", 'response' => $captcha);

            $options = array(
                    'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data)
                    )
            );

            $context = stream_context_create($options);
            $results = file_get_contents($url, false, $context);
            $json = json_decode($results);
            $valid = $json->success;
            */
            $valid = true;

            //echo $valid;
            if ($email != "" and $senha != "" and $valid === true) {                   
                $query = $this->db->query("SELECT * FROM usuario WHERE email = '$email'");
                $usuario = $query->getRowArray();
                $senhaDatabase = $usuario['senha'];

                //verificar usuário e senha
                if (isset($usuario)) {
                    $result = $this->hash->valid($senha, $senhaDatabase); //verifica se a senha digitada é válida com password_hash

                    if ($result == true) {
                        session()->set("id_usuario", $usuario['id_usuario']);
                        session()->set("nome", ucfirst($usuario['nome']));
                        session()->set("nome_sobrenome", ucfirst($usuario['nome']) . " " . ucfirst($usuario['sobrenome']));
                        session()->set("email", $usuario['email']);
                        session()->set("estado", $usuario['status']);
                        session()->set("celular", $usuario['celular']);
                        return 'logado';
                    } else {
                        return "senha";
                    }
                }
            } else {
                return "campo";
            }
        }else{
            return "captcha";    
        }
    }

    //VERIFICA SE JA EXISTE SESSÃO 
    public function verificaLogin()
    {
        $nome = session()->get("nome");
        $nome_sobrenome = session()->get("nome_sobrenome");
        $email = session()->get("email");
        $celular = session()->get("celular");
        $id_usuario = session()->get("id_usuario");
        $estado = session()->get("estado");

        // VERIFICA SE EXISTE DADOS NA SESSAO
        if ((isset($nome) || !empty($nome)) && (isset($nome_sobrenome) || !empty($nome_sobrenome)) && (isset($email) || !empty($email)) && (isset($celular) || !empty($celular)) && (isset($id_usuario) || !empty($id_usuario)))
        {

            if ($estado == 's') 
            {
                return true;
            } else {   
                $items = ['nome','nome_sobrenome','email','celular','id_usuario','estado'];
                session()->remove($items);
                redirect()->to('/login');
            }

        } else {
            $items = ['nome','nome_sobrenome','email','celular','id_usuario','estado'];
            session()->remove($items);
            redirect()->to('/login');
        }
    }

    //VERIFICA PERMISSÃO DE ACESSO
    public function verificaAcesso($menu)
    {
        if ($this->verificaLogin()) {
            $id_usuario = session()->get("id_usuario"); //usuario logado

            $this->db->select("m.*");
            $this->db->from("menu as m");
            $this->db->join("menu_usuario as mu", "mu.id_menu = m.id_menu");
            $this->db->where("mu.id_usuario_ad = '$id_usuario'");
            $this->db->where("m.nome = '$menu'");
            $count = $this->db->get()->num_rows();

            if ($count == 1) {
                return true;
            } else {
                redirect(base_url() . "Submissao", 'index');
            }
        }
    }
}
