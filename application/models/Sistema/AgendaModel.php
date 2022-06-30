<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class AgendaModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('agenda', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT agenda.*, servico.designacao as servico, servico.imagem as imagem "
                        . "FROM agenda,servico "
                        . "WHERE agenda.idservico=servico.id")->result();
    }

    //funcao que lista 
    public function maxlistar() {
        return $this->db->query("SELECT agenda.*, servico.designacao as servico, servico.imagem as imagem "
                        . "FROM agenda,servico "
                        . "WHERE agenda.idservico=servico.id")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('agenda', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('agenda')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("agenda");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("agenda");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("agenda.*, servico.designacao as servico, servico.imagem as imagem ");
        $this->db->from("agenda,servico");
        $this->db->where("agenda.idservico=servico.id AND nome LIKE '%$valor%'");
        return $this->db->get()->result();
    }

    public function updateEstado($id, $estado) {
        $query = "UPDATE agenda "
                . "SET estado = '$estado' "
                . "WHERE id = $id";
        return $this->db->query($query);
    }

}
