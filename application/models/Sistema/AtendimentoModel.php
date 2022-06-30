<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class AtendimentoModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('atendimento', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM atendimento")->result();
    }

    //funcao que lista 
    public function maxlistar() {
        return $this->db->query("SELECT atendimento.*,cliente.nome as cliente, servico.designacao as servico, servico.imagem as imagem "
                        . "FROM atendimento,servico, cliente "
                        . "WHERE atendimento.idcliente=cliente.id AND atendimento.idservico=servico.id ")->result();
    }

    //funcao que lista 
    public function listarAllCliente() {
        return $this->db->query("SELECT DISTINCT(cliente.nome),cliente.tipo,cliente.id as idcliente
            FROM atendimento, cliente
            WHERE atendimento.idcliente=cliente.id AND atendimento.modo= 0;")->result();
    }

    //funcao que lista 
    public function listarCliente($valor) {
        return $this->db->query("SELECT cliente.* FROM atendimento, cliente
        WHERE atendimento.idcliente=cliente.id 
        AND cliente.id = $valor AND atendimento.modo= 0;")->result();
    }

    //funcao que lista 
    public function listarServico($valor) {
        return $this->db->query("SELECT servico.designacao,atendimento.qtd, atendimento.valor FROM atendimento, cliente, servico
        WHERE atendimento.idcliente=cliente.id AND atendimento.idservico=servico.id AND
        cliente.id = $valor AND atendimento.modo= 0")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('atendimento', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('atendimento')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("atendimento.*,cliente.nome");
        $this->db->from("atendimento,cliente");
        $this->db->where("atendimento.id = $id AND atendimento.idcliente=cliente.id ");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("atendimento");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select(" atendimento.*,cliente.nome as cliente, servico.designacao as servico, servico.imagem as imagem ");
        $this->db->from("atendimento,servico, cliente");
        $this->db->where("atendimento.idcliente=cliente.id AND atendimento.idservico=servico.id AND cliente.nome LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

}
