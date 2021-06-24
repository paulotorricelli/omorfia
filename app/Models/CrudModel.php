<?php
defined('BASEPATH') or exit('No direct script access allowed');

class crudModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar($tabela, $status = null)
    {

        //consulta todos
        $status != null ? $this->db->where('status', $status) : '';
        $query = $this->db->get($tabela);
        return $query->result_array();
    }

    public function id($tabela, $coluna, $campo)
    {
        $this->db->select('id_' . $tabela);
        $this->db->from($tabela);
        $this->db->where($coluna, $campo);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function cadastrar($tabela, $dados, $id = false)
    {
        //atualizar
        if ($id) {
            $this->db->where('id_' . $tabela, $id);
            $this->db->update($tabela, $dados);

            $this->db->where('id_' . $tabela, $id);
            $query = $this->db->get($tabela);
            return $query->row_array();

        }else{
            //cadastrar

            //tabelas de gerenciamento
            //verificar se o item já existe com base na tabela passada
            $comparador = '';
            /*switch ($tabela) {
                case 'aviso':
                    $comparador = 'data_criacao';
                    break;                   
            }*/

            //verificar se item ja esta registrado
            $this->db->select($comparador);
            $this->db->from($tabela);
            $this->db->where($comparador, $dados[$comparador]);

            $query = $this->db->get();
            $pesquisa = $query->num_rows();

            if ($pesquisa === 0) {
                $this->db->insert($tabela, $dados);
                $id_registro = $this->db->insert_id();

                $this->db->where('id_' . $tabela, $id_registro);
                $query = $this->db->get($tabela);
                return $query->row_array();
            } else {
                return false;
            }
        }
    }

    public function apagar($tabela, $dados)
    {
        $this->db->update($tabela, $dados);
        $this->db->where('id_' . $tabela, $dados['id_' . $tabela]);
        return $this->db->affected_rows();
    }

    public function status($update)
    {
        try {
            $this->db->where('id_'.$update['tabela'], $update['id']);
            $this->db->update($update['tabela'], array('status' => $update['status']));
            return true;
        } catch (Exception $e) {
            //return $e->getMessage();
            return false;
        }
    }

    public function remover($tabela, $dados)
    {
        $this->db->delete($tabela, $dados);
        return true;
    }
}
