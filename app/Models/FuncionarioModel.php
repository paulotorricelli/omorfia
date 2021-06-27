<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class FuncionarioModel extends Model
{
    protected $db;

    public function __construct(ConnectionInterface &$db){
        $this->db =& $db;
    }

    function listar(){
        $query = $this->db->query('SELECT id_usuario, email, nome, sobrenome, telefone, status FROM usuario');
        return $query->getResult();
	}
}