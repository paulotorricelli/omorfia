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
        'profissao', 
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

    public function buscaCliente($busca){

        $builder = $this->db->table('cliente c');
        $builder->like("c.cpf", $busca);
        $builder->orLike("c.id_cliente", $busca);
        $builder->orLike("c.nome", $busca);
        $builder->orLike("c.sobrenome", $busca);
        $builder->orLike("c.celular", $busca);
        $query = $builder->get();
        return $query->getResult();
    }

    public function listar()
    {
        $id = session()->get("id_usuario");
        $builder = $this->db->table('menu m');
        $builder->join('usuario_menu um', 'm.id_menu = um.id_menu');
        $builder->where('um.id_usuario', $id);
        $builder->where('m.status', 's');
        $query = $builder->get();
        return $query->getResult();
    }
}