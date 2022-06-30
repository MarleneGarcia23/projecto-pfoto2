<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class PessoaModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('pessoa', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('pessoa');
        return $this->db->get()->result();
    }

    public function getNdi($ndi) {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->where('ndi', $ndi);
        return $this->db->get()->result();
    }

    public function getId($id) {
        $this->db->select('*');
        $this->db->from('pessoa');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmaxid() {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('pessoa');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('pessoa', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('pessoa')) {
            return TRUE;
        }
        return FALSE;
    }

    public function inserirPessoaEndereco($dados) {
        if ($this->db->insert('pessoa_endereco', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function inserirPessoaContacto($dados) {
        if ($this->db->insert('pessoa_contacto', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que descarrega 
    public function descarregar() {
        $this->db->select('*');
        $this->db->where("descarregado='0'");
        $this->db->from('pessoa');
        return $this->db->get()->result();
    }

    //funcao que valida a descarga 
    public function descarregado() {
        $query = "UPDATE pessoa SET descarregado='1';";
        return $this->db->query($query);
    }

}
