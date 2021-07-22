<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcedimentoModel extends Model
{
    protected $table = 'procedimento';
    protected $primaryKey = 'id_procedimento';
    protected $allowedFields = ['nome', 'descricao', 'valor', 'status', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}