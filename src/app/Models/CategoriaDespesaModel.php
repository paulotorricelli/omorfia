<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaDespesaModel extends Model
{
    protected $table = 'categoria_despesa';
    protected $primaryKey = 'id_categoria_despesa';
    protected $allowedFields = ['nome', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}
