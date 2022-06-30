<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of Recepcionista_model
 *
 * @author Graça Lambi
 */
class MunicipioModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    //Metodo que busca os municipios na base de dados
    public function buscarmunicipios() {
        $this->db->select('*');
        $this->db->from('municipio');
        return $this->db->get()->result();
    }
}
