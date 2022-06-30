<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class TarefaModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('tarefa', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM tarefa ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('tarefa', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('tarefa')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*, tarefa.id as idtarefa");
        $this->db->from("tarefa,pessoa");
        $this->db->where("tarefa.id = $id AND tarefa.idfuncionario=pessoa.id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*, tarefa.id as idtarefa");
        $this->db->from("tarefa,pessoa");
        $this->db->where("tarefa.idfuncionario=pessoa.id");
        return $this->db->get()->result();
    }

   //funcao  GetId
    public function getDetalhe($id) {
        $this->db->select("*, tarefa.id as idtarefa");
        $this->db->from("tarefa,pessoa");
        $this->db->where("tarefa.idfuncionario = $id AND tarefa.idfuncionario=pessoa.id");
        return $this->db->get()->result();
    }
    
    //funcao GetTransacao
    public function getTransacao($valor) {
        $query = "SELECT *, tarefa.id as idtarefa "
                . "FROM tarefa,pessoa "
                . "WHERE tarefa.idfuncionario=pessoa.id ";
        return $this->db->query($query)->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*, tarefa.id as idtarefa");
        $this->db->from("tarefa,pessoa");
        $this->db->where("tarefa.idfuncionario=pessoa.id AND designacao LIKE '%$valor%'");
        return $this->db->get()->result();
    }

}
