<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoModel extends Model
{
    protected $table = 'produto';
    protected $primaryKey = 'id_produto';
    protected $allowedFields = ['nome', 'descricao', 'valor_venda', 'status', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}