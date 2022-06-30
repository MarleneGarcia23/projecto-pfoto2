<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Recepcionista_model
 *
 * @author Graça Lambi
 */
class InstituicaoModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //Metodo Que insere 
    public function inserir($dados) {
        if ($this->db->insert('instituicao', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function inserirInstEnder($dados) {
        if ($this->db->insert('instituicao_endereco', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function inserirInstCont($dados) {
        if ($this->db->insert('instituicao_contacto', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    public function listar() {
        $this->db->select('*');
        $this->db->from('instituicao');
        return $this->db->get()->result();
    }

    public function getAll() {
        $this->db->select(' i.id as codigo ,i.* ,e.id as codend,e.*, e.id as codcont, c.*, municipio.nome as nomemunicipio');
        $this->db->from('instituicao i , endereco e, contacto c, instituicao_endereco ie, instituicao_contacto ic, municipio');
        $this->db->where('i.id = ie.idinstituicao AND i.id = ic.idinstituicao AND e.id = ie.idendereco AND c.id= ic.idcontacto'
                        . ' AND e.idmunicipio=municipio.id');
        return $this->db->get()->result();
    }

    public function getId($id) {
        $this->db->select("i.id as codigo ,i.* ,e.id as codend,e.*, c.id as codcont, c.*, mc.nome as nomemunicipio");
        $this->db->from("instituicao i , endereco e, contacto c, instituicao_endereco ie, instituicao_contacto ic, municipio mc");
        $this->db->where("i.id = ie.idinstituicao AND i.id = ic.idinstituicao AND e.id = ie.idendereco AND e.idmunicipio = mc.id AND c.id= ic.idcontacto AND i.id=$id");
        return $this->db->get()->result();
    }

    public function buscarInstituicao($id) {
        $this->db->select('*');
        $this->db->from('instituicao');
        $this->db->where('id', $id);
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('instituicao', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //função actualizar
    public function updateestado($id, $dados) {
        $query = "UPDATE instituicao SET descarregado='1';";
        //return $this->db->query($query);
    }

    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('instituicao')) {
            return TRUE;
        }
        return FALSE;
    }

}
