<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class FichaClinicaModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('fichaclinica', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM fichaclinica ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('fichaclinica', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('fichaclinica')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("fichaclinica");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    public function getIdPaciente($id) {
        return $this->db->query("SELECT * "
                        . "FROM fichaclinica "
                        . "WHERE idpaciente = $id "
                        . "ORDER BY id desc")->result();
    }

    public function getFichaClinica($id) {
        return $this->db->query("SELECT fichaclinica.*, paciente.*, paciente.data'pacientedata'  
        FROM fichaclinica, paciente
        WHERE fichaclinica.idpaciente = $id 
        AND fichaclinica.idpaciente = paciente.id ; ")->result();
	}
	
	public function getFichaClinicaAll() {
        return $this->db->query("SELECT fichaclinica.*, paciente.*, paciente.data'pacientedata'  
        FROM fichaclinica, paciente
        WHERE fichaclinica.idpaciente = paciente.id ; ")->result();
	}
	
	public function getFichaClinicaProximaConsulta($inicio,$fim) {

        return $this->db->query("SELECT fichaclinica.*, paciente.*, paciente.data'pacientedata'  
        FROM fichaclinica, paciente
        WHERE fichaclinica.idpaciente = paciente.id 
		AND fichaclinica.data2 >= '$inicio' AND fichaclinica.data2 <= '$fim' 
		; ")->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("fichaclinica");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("fichaclinica");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
