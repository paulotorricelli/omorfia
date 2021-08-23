<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcedimentoModel extends Model
{
    protected $table = 'procedimento';
    protected $primaryKey = 'id_procedimento';
    protected $allowedFields = ['nome', 'descricao', 'valor', 'status', 'data_criacao', 'data_modificacao'];
    protected $returnType = 'object'; //array

    public function buscaProcedimento($busca){

        $builder = $this->db->table('procedimento p');
        $builder->like("p.nome", $busca);
        $builder->orLike("p.id_procedimento", $busca);
        $builder->orLike("p.descricao", $busca);
        $builder->where("p.status", "s");
        $query = $builder->get();
        return $query->getResult();
    }
}