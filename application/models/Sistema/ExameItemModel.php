<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ExameItemModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('exameitem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT * FROM exameitem")->result();
    }


    public function listaritempedidoexame($idpedidoexame)
    {
        return $this->db->query("SELECT *, paciente.id'idpaciente', exameitem.id'idexame',exameitem.designacao'designacaoexame',exameitem.valor'valorexame',pedidoexame.data'datapedidoexame'
        FROM paciente, exameitem, pedidoexame, itempedidoexame  
        WHERE pedidoexame.id = $idpedidoexame AND itempedidoexame.idexame =exameitem.id AND pedidoexame.id = itempedidoexame.idpedido AND pedidoexame.idpaciente=paciente.id;")->result();
    }

    /**
     * Recupera todos resultados de exames referentes a um pedido
     * @author Bernardo Issenguel <beissenguel12@gmail.com>
     * @param int $pedido_id identificado do pedido de exameitem
     * @return array $resultados resultados de exames
     */
    public function get_resultado_exame($pedido_id)
    {
        $this->db->select("re.id, re.resultado, re.estado, e.designacao, e.valor, re.observacao");
        $this->db->from("resultadoexame re, exameitem e");
        $this->db->where("re.idexame = e.id AND re.idpedido = $pedido_id");
        return $this->db->get()->result();
    }

    //funcao que lista 
    public function listarmax()
    {
        return $this->db->query("SELECT * FROM exameitem")->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('exameitem', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('exameitem')) {
            return TRUE;
        }
        return FALSE;
    }

    public function eliminarExame($idexame)
    {
        $this->db->where('idexame', $idexame);
        if ($this->db->delete('exameitem')) {
            return TRUE;
        }
        return FALSE;
    }

    

    //funcao  GetId
    public function getId($id)
    {
        $this->db->select("*");
        $this->db->from("exameitem");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    public function getIdExame($id)
    {
        $this->db->select("grupoexame.id'idgrupoexame',grupoexame.designacao'designacaogrupoexame',exameitem.*");
        $this->db->from("grupoexame, exameitem");
        $this->db->where("exameitem.idexame = $id AND exameitem.idgrupoexame=grupoexame.id");
        return $this->db->get()->result();
    }
    //funcao GetAll
    public function getAll()
    {
        $this->db->select("*");
        $this->db->from("exameitem");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor)
    {
        $this->db->select("*");
        $this->db->from("exameitem");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }
}
