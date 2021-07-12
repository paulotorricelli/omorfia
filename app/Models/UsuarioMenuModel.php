<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioMenuModel extends Model
{
    public function __construct()
	{
        $this->db = db_connect();
	}

    public function userMenus($id){
        $builder = $this->db->table('menu m');
        $builder->join('usuario_menu um', 'm.id_menu = um.id_menu');
        $builder->where('um.id_usuario', $id);
        $builder->where('m.status', 's');
        $query = $builder->get();
        return $query->getResultArray();
    }
}
