<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioMenuModel extends Model
{
    public function __construct()
	{
        $this->db = db_connect();
	}

    public function userMenus($id)
    {
        $builder = $this->db->table('menu m');
        $builder->select("m.id_menu, m.aba, m.url, m.tipo, mu.id_usuario, mu.id_usuario_menu");
        $builder->join("(select mu.* from usuario_menu as mu where mu.id_usuario = '$id') as mu", "mu.id_menu = m.id_menu", "left");
        $builder->where('m.status', 's');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function listar()
    {
        $id = session()->get("id_usuario");
        $builder = $this->db->table('menu m');
        $builder->join('usuario_menu um', 'm.id_menu = um.id_menu');
        $builder->where('um.id_usuario', $id);
        $builder->where('m.status', 's');
        $query = $builder->get();
        return $query->getResult();
    }

    public function inserir($data)
    {
        $query = $this->db->table('usuario_menu')->insert($data);
        return $query;
    }

    public function remover($id)
    {   
        $query = $this->db->table('usuario_menu')->where('id_usuario', $id)->delete();
        return $query;
    }

    

}
