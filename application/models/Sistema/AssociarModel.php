<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class AssociarModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('perfil_modulo', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT perfil_modulo.*, perfil.designacao as perfil, modulo.designacao as modulo "
                        . "FROM perfil_modulo, perfil, modulo "
                        . "WHERE perfil_modulo.idperfil=perfil.id AND perfil_modulo.idmodulo=modulo.id ")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('perfil_modulo', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('perfil_modulo')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("perfil_modulo");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("perfil_modulo");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        return $this->db->query("SELECT perfil_modulo.*, perfil.designacao as perfil, modulo.designacao as modulo "
                        . "FROM perfil_modulo, perfil, modulo "
                        . "WHERE perfil_modulo.idperfil=perfil.id AND perfil_modulo.idmodulo=modulo.id "
                        . " AND (perfil.designacao LIKE '%$valor%' OR  modulo.designacao LIKE '%$valor%')")->result();
    }

}
