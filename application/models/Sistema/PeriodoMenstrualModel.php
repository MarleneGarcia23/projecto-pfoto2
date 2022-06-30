<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class PeriodoMenstrualModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('periodomenstrual', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM periodomenstrual ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('periodomenstrual', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('periodomenstrual')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("periodomenstrual");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    public function getIdPaciente($id) {
        return $this->db->query("SELECT * "
                        . "FROM periodomenstrual "
                        . "WHERE idpaciente = $id "
                        . "ORDER BY data2 DESC")->result();
    }

    public function getPeriodoMenstrual($id) {
        return $this->db->query("SELECT periodomenstrual.*, paciente.*, paciente.data'pacientedata'  
        FROM periodomenstrual, paciente
        WHERE periodomenstrual.idpaciente = $id 
        AND periodomenstrual.idpaciente = paciente.id ; ")->result();
	}
	
	public function getPeriodoMenstrualAll() {
        return $this->db->query("SELECT periodomenstrual.*, paciente.*, paciente.data'pacientedata'  
        FROM periodomenstrual, paciente
        WHERE periodomenstrual.idpaciente = paciente.id ; ")->result();
	}

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("periodomenstrual");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("periodomenstrual");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
