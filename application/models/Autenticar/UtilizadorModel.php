<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Recepcionista_model
 *
 * @author Graça Lambi
 */
class UtilizadorModel extends CI_Model {

    //put your code here
    public function __construct() {
        parent:: __construct();
    }

    public function autenticar($username, $senha) {
        $this->db->select('*');
        $this->db->from('utilizador');
        $this->db->where('username',$username);
        $this->db->where('senha', sha1($senha));
        $this->db->where('estado', '1');
        $this->db->join('pessoa','utilizador.id=pessoa.id','inner');
        return $this->db->get()->result();
    }

}
