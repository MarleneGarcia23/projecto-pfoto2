<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class FuncionarioModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('funcionario', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('funcionario');
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmaxid() {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('funcionario');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('funcionario', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('funcionario')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao 
    public function getAll() {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("pessoa.id = funcionario.id AND funcionario.idcargo = cargo.id "
                . "AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto ");
        return $this->db->get()->result();
    }

    //funcao 
    public function getId($id) {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("funcionario.id = $id AND pessoa.id = funcionario.id AND funcionario.idcargo = cargo.id "
                . "AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto ");
        return $this->db->get()->result();
    }

    //funcao 
    public function getElseAgente($id) {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,utilizador,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("pessoa.id = funcionario.id AND funcionario.id != $id AND funcionario.idcargo = cargo.id "
                . "AND utilizador.id = funcionario.id AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto ");
        return $this->db->get()->result();
    }

    public function getAgente($id) {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,utilizador,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("pessoa.id = funcionario.id AND funcionario.id = $id AND funcionario.idcargo = cargo.id "
                . "AND utilizador.id = funcionario.id AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto ");
        return $this->db->get()->result();
    }

    //funcao 
    public function getAgenteLike($id, $valor) {
        $this->db->select("*,funcionario.id as idfuncionario,pessoa.nome as nomefuncionario, cargo.designacao as cargo, endereco.id as idendereco, contacto.id as idcontacto");
        $this->db->from("pessoa,funcionario,utilizador,cargo,endereco,contacto, pessoa_endereco, pessoa_contacto");
        $this->db->where("pessoa.nome LIKE '%$valor%' AND pessoa.id = funcionario.id AND funcionario.id != $id AND funcionario.idcargo = cargo.id "
                . "AND utilizador.id = funcionario.id AND pessoa.id = pessoa_endereco.idpessoa AND pessoa.id = pessoa_contacto.idpessoa "
                . "AND endereco.id = pessoa_endereco.idendereco AND contacto.id = pessoa_contacto.idcontacto ");
        return $this->db->get()->result();
    }

    //funcao que descarrega 
    public function descarregar() {
        $this->db->select('*');
        $this->db->where("descarregado='0'");
        $this->db->from('funcionario');
        return $this->db->get()->result();
    }

    //funcao que valida a descarga 
    public function descarregado() {
        $query = "UPDATE encarregado SET descarregado='1';";
        return $this->db->query($query);
    }

}
