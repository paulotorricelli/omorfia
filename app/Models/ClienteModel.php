<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = ['nome', 'sobrenome', 'telefone', 'celular', 'email', 'data_nascimento', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //ou array
}