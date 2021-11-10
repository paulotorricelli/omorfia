<?php

namespace App\Models;

use CodeIgniter\Model;

class DespesaModel extends Model
{
    protected $table = 'despesa';
    protected $primaryKey = 'id_despesa';
    protected $allowedFields = ['valor', 'descricao', 'id_categoria', 'repetir', 'status', 'data_despesa', 'despesa_fixa', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}
