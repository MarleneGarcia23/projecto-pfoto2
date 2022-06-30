<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class SalarioModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('salario', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM salario")->result();
    }

    //funcao que lista 
    public function listarmax() {
        return $this->db->query("SELECT * FROM salario ")->result();
    }

    //funcao que lista 
    public function nfatura() {
        return $this->db->query("SELECT id as nfactura FROM salario ORDER BY id DESC LIMIT 1;")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('id', $id);
        if ($this->db->update('salario', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('salario')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("salario");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("salario");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("salario");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

    public function getSalario() {
        return $this->db->query(
                        "SELECT DISTINCT(salario.id), pessoa.nome'funcionario', mes.designacao'mes', "
                        . "salario.id'idsalario', salario.total'total',salario.data'datasalario' "
                        . "FROM pessoa, salario , mes "
                        . "WHERE pessoa.id=salario.idfuncionario AND salario.idmes=mes.id ")->result();
        return $this->db->get()->result();
    }

    public function getSalarioPeriodo($inicio, $fim) {
        return $this->db->query(
                        "SELECT DISTINCT(salario.id), pessoa.nome'funcionario', mes.designacao'mes', "
                        . "salario.id'idsalario',salario.subtotal, salario.salario, salario.irt, "
                        . "salario.ssocial, salario.subcidio,salario.desconto, salario.subtotal, salario.total'total',salario.data'datasalario' "
                        . "FROM pessoa, salario , mes "
                        . "WHERE pessoa.id=salario.idfuncionario AND salario.idmes=mes.id AND (salario.data >= '$inicio' AND salario.data <= '$fim');")->result();
        return $this->db->get()->result();
    }

    public function getSalarioID($valor) {
        return $this->db->query(
                        "SELECT DISTINCT(salario.id), pessoa.nome'funcionario', mes.designacao'mes', "
                        . "salario.id'idsalario',salario.subtotal, salario.salario, salario.irt, "
                        . "salario.ssocial, salario.subcidio,salario.desconto, salario.subtotal, salario.total'total',salario.data'datasalario' "
                        . "FROM pessoa, salario , mes "
                        . "WHERE pessoa.id=salario.idfuncionario AND salario.idmes=mes.id "
                        . " AND salario.id=$valor")->result();
        return $this->db->get()->result();
    }

    public function getOperador($valor) {
        return $this->db->query(
                        "SELECT pessoa.nome'operador' "
                        . "FROM pessoa, salario "
                        . "WHERE pessoa.id=salario.idoperador "
                        . "AND salario.id=$valor")->result();
        return $this->db->get()->result();
    }

    public function getDetalhe($valor, $tipo) {
        return $this->db->query(
                        "SELECT subcidio_desconto.designacao,salario_sub_desc.*
            FROM salario_sub_desc, subcidio_desconto
            WHERE subcidio_desconto.id=salario_sub_desc.idsubdesc
            AND salario_sub_desc.idsalario=$valor AND salario_sub_desc.tipo='$tipo'")->result();
        return $this->db->get()->result();
    }

}
