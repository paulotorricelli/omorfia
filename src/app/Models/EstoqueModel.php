<?php

namespace App\Models;

use CodeIgniter\Model;

class EstoqueModel extends Model
{
    protected $table = 'estoque';
    protected $primaryKey = 'id_estoque';
    protected $allowedFields = ['lote', 'unidade', 'tipo_unidade', 'data_validade', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}