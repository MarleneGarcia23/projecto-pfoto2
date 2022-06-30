<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ReceitaModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('receita', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('receita');
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmaxid() {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('receita');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('receita', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('receita')) {
            return TRUE;
        }
        return FALSE;
    }


    public function getId($id) {
        return $this->db->query("SELECT *, receita.id'idreceita', receita.descricao'descricaoreceita',receita.data'datareceita'
                                 FROM receita,paciente
                                 WHERE paciente.id=$id AND receita.idpaciente = paciente.id ORDER BY receita.data DESC")->result();
    }

    public function getIdReceita($id) {
        return $this->db->query("SELECT *, receita.id'idreceita', receita.descricao'descricaoreceita',receita.data'datareceita'
                                 FROM receita,paciente
                                 WHERE receita.id=$id AND receita.idpaciente = paciente.id ORDER BY receita.data DESC")->result();
    }


    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("receita,");
        $this->db->where("");
        return $this->db->get()->result();
    }

}
