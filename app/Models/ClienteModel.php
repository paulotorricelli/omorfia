<?php

namespace App\Models;

use CodeIgniter\Model;

use CodeIgniter\Database\ConnectionInterface;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    protected $allowedFields = [
        'nome', 
        'sobrenome', 
        'telefone', 
        'celular', 
        'data_nascimento', 
        'rg',
        'cpf',
        'email', 
        'instagram',
        'facebook',
        'hobby',
        'endereco',
        'numero',
        'complemento',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'como_conheceu',
        'relatorio',
        'data_criacao', 
        'data_modificacao'];
    protected $returnType = 'object'; //ou array
}