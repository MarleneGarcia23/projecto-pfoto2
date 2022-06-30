<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class StoqueModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    //funcao que insere 
    public function inserir($dados) {
        if ($this->db->insert('stoque', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar() {
        return $this->db->query("SELECT * FROM stoque")->result();
    }

    //funcao que lista 
    public function listarmax() {
        return $this->db->query("SELECT * FROM stoque ")->result();
    }

    //funcao que lista 
    public function nfatura() {
        return $this->db->query("SELECT id as nstoque FROM stoque ORDER BY id DESC LIMIT 1;")->result();
    }

    //função actualizar
    public function actualizar($id, $dados) {
        $this->db->where('idproduto', $id);
        if ($this->db->update('stoque', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('stoque')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id) {
        $this->db->select("*");
        $this->db->from("stoque");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll() {
        $this->db->select("*");
        $this->db->from("stoque");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor) {
        $this->db->select("*");
        $this->db->from("stoque");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

    //METODOS DA STOQUE
    public function getLikeStoque($valor) {
        return $this->db->query(
            "SELECT stoque.*, produto.designacao, produto.imagem
            FROM stoque , produto
            WHERE stoque.idproduto = produto.id
            AND produto.designacao LIKE '%$valor%';")->result();
    }

    public function getStoque() {
        return $this->db->query(
                        "SELECT stoque.*, produto.designacao, produto.imagem
                        FROM stoque , produto
                        WHERE stoque.idproduto = produto.id;")->result();
    }

    public function insertupdate($id, $qtd, $tipo) {
        switch (trim(strtoupper($tipo))) {
            case "VENDA":
                if ($this->db->query("SELECT * FROM stoque WHERE idproduto=$id")->result() != null) {

                    $dados = array(
                        "idproduto" => $id,
                        "stoque" => (intval($this->db->query("SELECT * FROM stoque WHERE idproduto=" . $id)->result()[0]->stoque) - $qtd),
                        "qtdvenda" => (intval($this->db->query("SELECT * FROM stoque WHERE idproduto=" . $id)->result()[0]->qtdvenda) + $qtd),
                        "data" => date('Y-m-d'),
                    );
                    $this->actualizar($id, $dados);
                    return TRUE;
                }
                break;
            case "COMPRA":
                if ($this->db->query("SELECT * FROM stoque WHERE idproduto=$id")->result() != null) {
                    $dados = array(
                        "stoque" => (intval($this->db->query("SELECT * FROM stoque WHERE idproduto=" . $id)->result()[0]->stoque) + $qtd),
                        "qtdcompra" => (intval($this->db->query("SELECT * FROM stoque WHERE idproduto=" . $id)->result()[0]->qtdcompra) + $qtd),
                        "data" => date('Y-m-d'),
                    );
                    $this->actualizar($id, $dados);
                    return TRUE;
                } else {
                    $dados = array(
                        "idproduto" => $id,
                        "stoque" => $qtd,
                        "qtdcompra" => $qtd,
                        "data" => date('Y-m-d'),
                    );
                    $this->inserir($dados);
                    return TRUE;
                }
                break;
        }
    }

}
