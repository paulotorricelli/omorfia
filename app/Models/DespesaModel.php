<?php

namespace App\Models;

use CodeIgniter\Model;

class DespesaModel extends Model
{
    protected $table = 'despesa_entrada';
    protected $primaryKey = 'id_despesa_entrada';
    protected $allowedFields = ['valor', 'descricao', 'categoria', 'repetir', 'tipo', 'status', 'data_despesa', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}