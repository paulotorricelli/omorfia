<?php
defined('BASEPATH') or exit('No direct script access allowed');

class loginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CrudModel', 'crud');
        $this->load->model('UsuarioModel', 'usuario');
    }

    //INICIO - LOGIN
    public function login($dados)
    {      
        //VERIFICA LOGIN E RETORNA USUÁRIO LOGADO
        $user = $dados;
        $nome = $user['nome'];
        $sobrenome = $user['sobrenome'];
        $nome_sobrenome = $user['nome'].' '.$user['sobrenome'];
        $login = $user['usuario'];
        $email = $user['email'];
        $telefone = $user['telefone'];

        $usuario_ret = $this->crud->id('usuario', 'usuario_ad', $login);
        $id = $usuario_ret['id_usuario'] == null || $usuario_ret['id_usuario'] == '' ? null : $usuario_ret['id_usuario'];

        if($id !== null){
            //dados para atualizar
            $dados = array(
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email,
                'telefone' => preg_replace("/[^0-9]/", "", $telefone),
                'data_modificacao' => date('Y-m-d h:m:s')
            );
        }else{
            //dados para cadastrar
            $dados = array(
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'usuario_ad' => $login,
                'email' => $email,
                'telefone' => preg_replace("/[^0-9]/", "", $telefone),
                'status' => 's',
                'data_criacao' => date('Y-m-d h:m:s'),
                'data_modificacao' => date('Y-m-d h:m:s')
            );
        }

        $return = $this->crud->cadastrar("usuario", $dados, $id);

        //DADOS DO USUÁRIO LOGADO
        $this->session->set_userdata("nome", $nome);
        $this->session->set_userdata("nome_sobrenome", $nome_sobrenome);
        $this->session->set_userdata("login", $login);
        $this->session->set_userdata("email", $email);
        $this->session->set_userdata("telefone", $telefone);
        $this->session->set_userdata("estado", $return['status']);

        if($return['status'] == 'n'){
            return '';
        } 

        if($id !== null AND $id !== ""){
            $this->session->set_userdata("id_usuario", $id);
        } else {
            $usuario_ret = $this->crud->id('usuario', 'usuario_ad', $login);
            $menu_ret = $this->crud->id('menu', 'nome', 'Submissão');
            $dados_menu_usuario = array(
                'id_menu' => $menu_ret['id_menu'],
                'id_usuario_ad' => $usuario_ret['id_usuario'],
                'data_criacao' => date('Y-m-d h:m:s')
            );
            $this->usuario->acessoMenu($dados_menu_usuario, 'add');
            $this->session->set_userdata("id_usuario", $usuario_ret['id_usuario']);
        }
        return "logado";   
    }

    //LOGOUT - ENCERRA SESSÃƒO
    public function logout()
    {
        $this->session->unset_userdata("nome");
        $this->session->unset_userdata("nome_sobrenome");
        $this->session->unset_userdata("login");
        $this->session->unset_userdata("email");
        $this->session->unset_userdata("telefone");
        $this->session->unset_userdata("id_usuario");
        return TRUE;
    }

    //VERIFICA SE JA EXISTE SESSÃO 
    public function verificaLogin()
    {
        $nome = $this->session->userdata("nome");
        $nome_sobrenome = $this->session->userdata("nome_sobrenome");
        $login = $this->session->userdata("login");
        $email = $this->session->userdata("email");
        $telefone = $this->session->userdata("telefone");
        $id_usuario = $this->session->userdata("id_usuario");
        $estado = $this->session->userdata("estado");

        // VERIFICA SE EXISTE DADOS NA SESSAO
        if ((isset($nome) || !empty($nome)) && (isset($nome_sobrenome) || !empty($nome_sobrenome)) && (isset($login) || !empty($login)) && (isset($email) || !empty($email)) && (isset($telefone) || !empty($telefone)) && (isset($id_usuario) || !empty($id_usuario)))
        {
            try {
                if ($estado == 's') {
                    return TRUE;
                } else {            
                   return false;
                }
            } catch (Exception $e) {
                return "erro";
            }
        } else {
            $this->logout();
            redirect(base_url() . "home", "auto");
        }
    }

    //VERIFICA PERMISSÃO DE ACESSO
    public function verificaAcesso($menu)
    {
        if ($this->principalModel->verificaLogin()) {
            $id_usuario = $this->session->userdata("id_usuario"); //usuario logado

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
