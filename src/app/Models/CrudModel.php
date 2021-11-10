<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CrudModel extends CI_Model
{
    public function __construct()
	{
        $this->db = db_connect();
	}

    public function status($update)
    {
        try {
            $this->db->where('id_'.$update['tabela'], $update['id']);
            $this->db->update($update['tabela'], array('status' => $update['status']));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
