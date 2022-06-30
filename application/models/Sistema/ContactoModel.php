<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ContactoModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('contacto', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        $this->db->select('*');
        $this->db->from('contacto');
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmaxid() {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('contacto');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('contacto', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('contacto')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que descarrega 
    public function descarregar() {
        $this->db->select('*');
        $this->db->where("descarregado='0'");
        $this->db->from('contacto');
        return $this->db->get()->result();
    }

    //funcao que valida a descarga 
    public function descarregado() {
        $query = "UPDATE contacto SET descarregado='1';";
        return $this->db->query($query);
    }

}
