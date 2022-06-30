<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class ResultadoExameModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('resultadoexame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT *
        FROM resultadoexame")->result();
    }

    public function listarresultadoexame()
    {
        return $this->db->query("SELECT DISTINCT(pedidoexame.id)'idpedido',paciente.nome,paciente.imagem,paciente.ndi,paciente.telefone,resultadoexame.data'dataresultadoexame'
        FROM paciente,pedidoexame, resultadoexame
        WHERE resultadoexame.idpaciente=paciente.id
        AND resultadoexame.idpedido=pedidoexame.id
        ORDER BY resultadoexame.id DESC;
        ")->result();
    }

    public function listarResultadoExameIdPaciente($id)
    {
        return $this->db->query("SELECT DISTINCT(pedidoexame.id)'idpedido',paciente.nome,paciente.imagem,paciente.ndi,paciente.telefone,resultadoexame.data'dataresultadoexame'
        FROM paciente,pedidoexame, resultadoexame
        WHERE  paciente.id=$id
        AND resultadoexame.idpaciente=paciente.id
        AND resultadoexame.idpedido=pedidoexame.id
        ORDER BY resultadoexame.data DESC;
        ")->result();
    }


    public function listarresultadoexameId($id)
    {
        return $this->db->query("SELECT *,exame.designacao'designacaoexame',exame.valor'valorexame',exame.isexameitem,resultadoexame.estado'estadoexame',resultadoexame.resultado'resultadoexame', resultadoexame.id'idresultadoexame',resultadoexame.data'dataresultadoexame'
        FROM paciente, exame,pedidoexame, resultadoexame
        WHERE resultadoexame.idpaciente=paciente.id
        AND pedidoexame.id=$id
        AND resultadoexame.idexame=exame.id
        AND resultadoexame.idpedido=pedidoexame.id
        ORDER BY resultadoexame.data DESC
        ")->result();
    }







    //funcao que lista 
    public function listarmaxid()
    {
        $this->db->select('MAX(id) as maxid');
        $this->db->from('resultadoexame');
        return $this->db->get()->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('resultadoexame', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('resultadoexame')) {
            return TRUE;
        }
        return FALSE;
    }

    public function eliminarresultadoexame($id)
    {
        $this->db->where('idpedido', $id);
        if ($this->db->delete('resultadoexame')) {
            return TRUE;
        }
        return FALSE;
    }


    //funcao GetAll
    public function getAll()
    {
        $this->db->select("*");
        $this->db->from("resultadoexame,");
        $this->db->where("");
        return $this->db->get()->result();
    }
}
