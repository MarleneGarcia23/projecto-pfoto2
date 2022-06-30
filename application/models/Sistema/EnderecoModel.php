<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Morada_model
 *
 * @author Hilquias Chitazo
 */
class EnderecoModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    public function inserir($dados) {
        if ($this->db->insert('endereco', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('endereco', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('endereco')) {
            return TRUE;
        }
        return FALSE;
    }

}
