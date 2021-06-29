<?php

namespace App\Models;

use CodeIgniter\Model;

class FuncionarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['email', 'nome', 'sobrenome', 'telefone'];
    protected $returnType = 'object'; //array
}