<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class UtilizadorModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('utilizador', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('utilizador');
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmaxid() {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('utilizador');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('utilizador', $dados)) {
            return TRUE;
        }
        return FALSE;
    }
    
    public function alterarSenha($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('utilizador', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('utilizador')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao 
    public function getAll() {
        $this->db->select("pessoa.*,utilizador.*,perfil.designacao as nomeperfil,utilizador.id as idutilizador");
        $this->db->from("pessoa, utilizador, perfil");
        $this->db->where("pessoa.id = utilizador.id AND utilizador.idperfil = perfil.id");
        return $this->db->get()->result();
    }

    public function getId($id) {
        $this->db->select("pessoa.*,utilizador.*,perfil.designacao as nomeperfil,utilizador.id as idutilizador");
        $this->db->from("pessoa, utilizador, perfil");
        $this->db->where("utilizador.id = $id AND pessoa.id = utilizador.id AND utilizador.idperfil = perfil.id");
        return $this->db->get()->result();
    }

    //funcao 
    public function getPessoa() {
        $this->db->select("pessoa.*");
        $this->db->from("pessoa");
        return $this->db->get()->result();
    }

    public function getUsername($username) {
        $this->db->select('*');
        $this->db->from('utilizador');
        $this->db->where('username', $username);
        return $this->db->get()->result();
    }

    //funcao 
    public function getProcurar($valor) {
        $this->db->select("pessoa.*,utilizador.*");
        $this->db->from("pessoa,utilizador");
        $this->db->where("pessoa.id = utilizador.id AND pessoa.nome LIKE '%$valor%'");
        return $this->db->get()->result();
    }
    //funcao que descarrega 
    public function descarregar() {
        $this->db->select('*');
        $this->db->where("descarregado='0'");
        $this->db->from('utilizador');
        return $this->db->get()->result();
    }

    //funcao que valida a descarga 
    public function descarregado() {
        $query = "UPDATE encarregado SET descarregado='1';";
        return $this->db->query($query);
    }

}
