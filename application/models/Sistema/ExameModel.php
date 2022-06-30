<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ExameModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('exame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT * FROM exame ORDER BY designacao ASC")->result();
    }


    public function listaritempedidoexame($idpedidoexame)
    {
        return $this->db->query("SELECT *, paciente.id'idpaciente', exame.id'idexame',exame.designacao'designacaoexame',exame.valor'valorexame',pedidoexame.data'datapedidoexame'
        FROM paciente, exame, pedidoexame, itempedidoexame  
        WHERE pedidoexame.id = $idpedidoexame AND itempedidoexame.idexame =exame.id AND pedidoexame.id = itempedidoexame.idpedido AND pedidoexame.idpaciente=paciente.id;")->result();
    }

    /**
     * Recupera todos resultados de exames referentes a um pedido
     * @author Bernardo Issenguel <beissenguel12@gmail.com>
     * @param int $pedido_id identificado do pedido de exame
     * @return array $resultados resultados de exames
     */
    public function get_resultado_exame($pedido_id)
    {
        $this->db->select("re.id, re.idexame, re.resultado, re.estado, re.idexameitem, e.designacao, e.valor, re.observacao,  e.isexameitem");
        $this->db->from("resultadoexame re, exame e");
        $this->db->where("re.idexame = e.id AND re.idpedido = $pedido_id");
        return $this->db->get()->result();
    }

    public function getresultadoexamegrupo($pedidoid, $exameid, $idgrupo)
    {
        return $this->db->query("SELECT 
        re.id, re.idexame, re.resultado, re.estado, re.idexameitem, e.designacao,ei.designacao'designacaoitem', ei.valor, re.observacao,  e.isexameitem, ei.idgrupoexame
        FROM 
        resultadoexame re, exame e, exameitem ei
        WHERE re.idexame = e.id 
        AND e.id=$exameid
        AND re.idpedido = $pedidoid
        AND ei.idgrupoexame=$idgrupo
        AND ei.id=re.idexameitem;")->result();
    }


    //funcao que lista 
    public function listarmax()
    {
        return $this->db->query("SELECT * FROM exame")->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('exame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('exame')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id)
    {
        $this->db->select("*");
        $this->db->from("exame");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll()
    {
        $this->db->select("*");
        $this->db->from("exame");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor)
    {
        $this->db->select("*");
        $this->db->from("exame");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

    public function getIdExameItem($id)
    {
        $this->db->select("exameitem.id'idexameitem',exameitem.designacao'designacaoitem', grupoexame.id'idgrupoexame',grupoexame.designacao'designacaogrupoexame',exameitem.*");
        $this->db->from("grupoexame, exameitem");
        $this->db->where("exameitem.idexame = $id AND exameitem.idgrupoexame=grupoexame.id");
        return $this->db->get()->result();
    }
    public function getIdExameItemIdGrupo($id)
    {
        $this->db->select("DISTINCT(grupoexame.id)'idgrupoexame',grupoexame.designacao'designacaogrupoexame'");
        $this->db->from("grupoexame, exameitem");
        $this->db->where("exameitem.idexame = $id AND exameitem.idgrupoexame=grupoexame.id");
        return $this->db->get()->result();
    }
}
