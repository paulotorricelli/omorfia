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
        $query = $this->db->query('SELECT * FROM menu WHERE status = "s"');
        return $query->getResult();
	}
}
