<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;


class MenuModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }

    function all(){
		return $this->db->table('menu')->get()->getResult();
	}

    function getMenus()
    {
        $builder = $this->db->table("menu");
        return $builder->get()->getResult();
    }
}
