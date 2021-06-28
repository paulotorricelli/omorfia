<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class ClienteModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }

    function listar(){
        $query = $this->db->query('SELECT id_cliente, nome, sobrenome, telefone, celular, email, data_nascimento FROM cliente');
        return $query->getResult();
	}
}