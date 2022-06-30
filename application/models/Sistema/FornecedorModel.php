<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class FornecedorModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('fornecedor', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM fornecedor")->result();
    }

    //funcao que lista 
    public function maxlistar() {
        return $this->db->query("SELECT * FROM fornecedor ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('fornecedor', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('fornecedor')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("fornecedor");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

        //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("fornecedor");
        $this->db->where("");
        return $this->db->get()->result();
    }
    
    //funcao 
    public function getSubcidio() {
        $this->db->select("*");
        $this->db->from("fornecedor");
        $this->db->where("tipo='subcidio'");
        return $this->db->get()->result();
    }
        //funcao 
    public function getDesconto() {
        $this->db->select("*");
        $this->db->from("fornecedor");
        $this->db->where("tipo='desconto'");
        return $this->db->get()->result();
    }
    

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("fornecedor");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
