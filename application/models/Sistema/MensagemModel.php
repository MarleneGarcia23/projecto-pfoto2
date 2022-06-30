<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class MensagemModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('mensagem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM mensagem ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('mensagem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('mensagem')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("mensagem");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("mensagem");
        $this->db->where("");
        return $this->db->get()->result();
    }

    public function getMensagem($agente1, $agente2) {
        $this->db->select("*");
        $this->db->from("mensagem");
        $this->db->where("(idagente1 = $agente1 AND idagente2 = $agente2) OR "
                . "(idagente1 = $agente2 AND idagente2 = $agente1)");
        return $this->db->get()->result();
    }

    public function getAllMensagem($id) {
        $this->db->select("mensagem.*,pessoa.*, pessoa.id as idpessoa, mensagem.data as datamensagem");
        $this->db->from("mensagem, pessoa");
        $this->db->where("((mensagem.idagente1=$id AND mensagem.idagente2 !=$id AND pessoa.id=mensagem.idagente2) "
                . "OR (mensagem.idagente1 !=$id AND mensagem.idagente2 =$id AND pessoa.id=mensagem.idagente1));");
        return $this->db->get()->result();
    }

    public function updateModo($modo, $agente1, $agente2) {
        $query = "UPDATE mensagem "
                . "SET modo = $modo "
                . "WHERE (idagente1 = $agente2 AND idagente2 = $agente1)";
        return $this->db->query($query);
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("mensagem");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
