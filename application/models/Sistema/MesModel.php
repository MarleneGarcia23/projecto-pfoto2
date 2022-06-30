<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class MesModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere a inscrição
    public function inserir($dados) {
        if ($this->db->insert('mes', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista a inscrição
    public function listar() {
        $this->db->select('*');
        $this->db->from('mes');
        return $this->db->get()->result();
    }

    //funcao que lista a inscrição
    public function getID($valor) {
        $this->db->select('*');
        $this->db->from('mes');
        $this->db->where('id', $valor);
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('mes', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina a inscrição
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('mes')) {
            return TRUE;
        }
        return FALSE;
    }


}
