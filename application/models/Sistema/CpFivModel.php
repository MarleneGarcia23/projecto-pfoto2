<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class CpFivModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('cpfiv', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM cpfiv ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('cpfiv', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('cpfiv')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("cpfiv");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    public function getIdPaciente($id) {
        return $this->db->query("SELECT cpfiv.*, paciente.nome, paciente.nomeparceiro, paciente.telefone FROM cpfiv, paciente WHERE cpfiv.idpaciente = $id AND cpfiv.idpaciente = paciente.id ORDER BY id desc")->result();
    }

    public function getIdCpFivPaciente($id) {
        return $this->db->query("SELECT cpfiv.*, paciente.nome,paciente.data'datapaciente', paciente.nomeparceiro,paciente.dataparceiro'dataparceiropaciente', paciente.telefone FROM cpfiv, paciente WHERE cpfiv.id = $id AND cpfiv.idpaciente = paciente.id ORDER BY id desc")->result();
    }

    public function getCpFiv($id) {
        return $this->db->query("SELECT cpfiv.*, cpfiv.data'datacpfiv', paciente.*, paciente.data'pacientedata'  
        FROM cpfiv, paciente
        WHERE cpfiv.idpaciente = $id 
        AND cpfiv.idpaciente = paciente.id ORDER BY cpfiv.id DESC; ")->result();
	}
	
	public function getCpFivAll() {
        return $this->db->query("SELECT cpfiv.*,cpfiv.data'datacpfiv', paciente.*, paciente.data'pacientedata'  
        FROM cpfiv, paciente
        WHERE cpfiv.idpaciente = paciente.id ORDER BY cpfiv.id DESC; ")->result();
	}
	
	public function getCpFivPeriodo($inicio,$fim) {

        return $this->db->query("SELECT cpfiv.*,cpfiv.data'datacpfiv', paciente.*, paciente.data'pacientedata'  
        FROM cpfiv, paciente
        WHERE cpfiv.idpaciente = paciente.id 
		AND cpfiv.data >= '$inicio' AND cpfiv.data <= '$fim' 
		ORDER BY cpfiv.id DESC; ")->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("cpfiv");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("cpfiv");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
