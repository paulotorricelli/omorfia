<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'id_menu';
    protected $allowedFields = ['aba', 'url', 'icon', 'descricao', 'tipo', 'status', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array
}
