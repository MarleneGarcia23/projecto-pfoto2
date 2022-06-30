<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class PedidoExameModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('pedidoexame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT * FROM pedidoexame")->result();
    }

    public function listarpaciente($id)
    {
        
        return $this->db->query("SELECT *,pedidoexame.id'idpedidoexame',pedidoexame.data'datapedidoexame' FROM pedidoexame, paciente WHERE pedidoexame.idpaciente=$id AND pedidoexame.idpaciente=paciente.id ORDER BY pedidoexame.id DESC")->result();
    }

    public function listarpedidoexame()
    {
        return $this->db->query("SELECT *,pedidoexame.id'idpedidoexame',pedidoexame.data'datapedidoexame',pedidoexame.estado'estadopedidoexame' FROM pedidoexame, paciente WHERE pedidoexame.idpaciente=paciente.id ORDER BY pedidoexame.data DESC")->result();
    }

    //funcao que lista 
    public function listarmax()
    {
        return $this->db->query("SELECT * FROM pedidoexame")->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('pedidoexame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('pedidoexame')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id)
    {
        $this->db->select("*");
        $this->db->from("pedidoexame");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll()
    {
        $this->db->select("*");
        $this->db->from("pedidoexame");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor)
    {
        $this->db->select("*");
        $this->db->from("pedidoexame");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }
    
    
    /**
     * Recupera todos itens de um pedido de exame
     * @author Bernardo Issenguel <beissenguel12@gmail.com>
     * @param int $pedido_id identificador do pedido de exame
     * @return array itens de um pedido de exame
     */
    public function find_itens_by_id($pedido_id)
    {
        $this->db->select("*");
        $this->db->from("itempedidoexame");
        $this->db->where("idpedido", $pedido_id);
        return $this->db->get()->result();
    }

    /**
     * Recupera paciente de um pedido de exame
     * @author Bernardo Issenguel <beissenguel12@gmail.com>
     * @param int $pedido_id identificador do pedido de exame
     * @return object paciente que fez o pedido de exame
     */
    public function get_paciente_by_id($pedido_id)
    {
        $this->db->select("paciente.*");
        $this->db->from("paciente, pedidoexame");
        $this->db->where("paciente.id = pedidoexame.idpaciente AND pedidoexame.id = $pedido_id");
        return $this->db->get()->result()[0];
    }

    /**
     * Remove todos intes de um pedido de exame
     * @author Bernardo Issenguel <beissenguel12@gmail.com>
     * @param int $pedido_id identificador do pedido de exame
     * @return boolean true - successo,  false - erro
     */
    public function delete_itens($pedido_id)
    {
        $this->db->where('idpedido', $pedido_id);
        return $this->db->delete('itempedidoexame');
    }
}
