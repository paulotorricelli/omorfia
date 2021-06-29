<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class loginModel extends Model
{   
    protected $db;
    
    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }
    //INICIO - LOGIN
    public function login($dados)
    {
        $email = trim($dados['inputUsuario']);
        $senha = trim($dados['inputSenha']);

        if ($email != "" and $senha != "") {
            //try {
                
                $query = $this->db->query("SELECT * FROM usuario WHERE email = '$email'");
                $usuario = $query->getRowArray();
                //var_dump($usuario);
                //$senhaDatabase = $usuario->senha;
                //$this->load->Model("hashModel");

                //verificar usuário e senha
                if (isset($usuario)) {
                    //$result = $this->hashModel->verificaHash($senha, $senhaDatabase); //verifica se a senha digitada é válida com password_hash
                    $result = TRUE;
                    if ($result == TRUE) {
                        session()->set("id_usuario", $usuario['id_usuario']);
                        session()->set("nome", ucfirst($usuario['nome']));
                        session()->set("nome_sobrenome", ucfirst($usuario['nome']) . " " . ucfirst($usuario['sobrenome']));
                        session()->set("email", $usuario['email']);
                        session()->set("estado", $usuario['status']);
                        session()->set("telefone", $usuario['telefone']);
                        return 'logado';
                    } else {
                        return "senha";
                    }
                }
            //} catch (Exception $e) {
            //    return "erro";
            //}
        } else {
            return "campo";
        }
    }

    //VERIFICA SE JA EXISTE SESSÃO 
    public function verificaLogin()
    {
        $nome = session()->get("nome");
        $nome_sobrenome = session()->get("nome_sobrenome");
        $email = session()->get("email");
        $telefone = session()->get("telefone");
        $id_usuario = session()->get("id_usuario");
        $estado = session()->get("estado");

        // VERIFICA SE EXISTE DADOS NA SESSAO
        if ((isset($nome) || !empty($nome)) && (isset($nome_sobrenome) || !empty($nome_sobrenome)) && (isset($email) || !empty($email)) && (isset($telefone) || !empty($telefone)) && (isset($id_usuario) || !empty($id_usuario)))
        {

            if ($estado == 's') 
            {
                return true;
            } else {   
                $items = ['nome','nome_sobrenome','email','telefone','id_usuario','estado'];
                session()->remove($items);
                redirect()->to('/login');
            }

        } else {
            $items = ['nome','nome_sobrenome','email','telefone','id_usuario','estado'];
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
