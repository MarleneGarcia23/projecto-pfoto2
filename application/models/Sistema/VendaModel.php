<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class VendaModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('venda', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM venda")->result();
    }
        //funcao que lista 
    public function listarmax() {
        return $this->db->query("SELECT * FROM venda ")->result();
    }

        //funcao que lista 
    public function nfatura() {
        return $this->db->query("SELECT id as nvenda FROM venda ORDER BY id DESC LIMIT 1;")->result();
    }
    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('venda', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('venda')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("venda");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("venda");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("venda");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
