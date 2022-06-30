<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class CorreioModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('correio', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM correio")->result();
    }

    //funcao que lista 
    public function listarmax() {
        return $this->db->query("SELECT * FROM correio ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('correio', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('correio')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("correio");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("correio");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao 
    public function getEmailDepartamento($iddepartamento) {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("pessoa.id = funcionario.id AND funcionario.idcargo = cargo.id "
                . "AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto "
                . "AND cargo.iddepartamento=$iddepartamento");
        return $this->db->get()->result();
    }

}
