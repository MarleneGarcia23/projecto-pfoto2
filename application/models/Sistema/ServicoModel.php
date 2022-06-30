<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ServicoModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('servico', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('servico');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('servico', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('servico')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("servico");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("servico");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("servico");
        $this->db->where("designacao LIKE '%$valor%'");
        return $this->db->get()->result();
    }

}
