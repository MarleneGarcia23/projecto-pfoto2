<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class CpFivItemModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('cpfivitem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT * FROM cpfivitem ")->result();
    }

    public function getId($id)
    {
        $this->db->select("*");
        $this->db->from("cpfivitem");
        $this->db->where("idcpfiv = $id AND status= 1");
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('cpfivitem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function setStatus($id, $dados)
    {
        $this->db->where('idcpfiv', $id);
        if ($this->db->update('cpfivitem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('cpfivitem')) {
            return TRUE;
        }
        return FALSE;
    }
}
