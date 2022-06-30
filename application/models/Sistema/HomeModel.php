<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class HomeModel extends CI_Model {

//put your code here
    public function __construct() {
        parent:: __construct();
    }

    public function query($query) {
        return $this->db->query($query);
    }

    public function select($query) {
        return $this->db->query($query)->result();
    }

    //*********MÉTODOS DOS MODULOS**********
    public function getModulo($id, $modulo) {
        $this->db->select("modulo.designacao");
        $this->db->from("perfil,modulo,perfil_modulo, utilizador");
        $this->db->where("perfil_modulo.idperfil = perfil.id "
                . "AND  perfil_modulo.idmodulo = modulo.id "
                . "AND utilizador.idperfil=perfil.id AND  modulo.designacao = '$modulo' "
                . "AND modulo.modo=1 AND utilizador.id=$id");
        return $this->db->get()->result();
    }

    //*********MÉTODOS DA RECEITA**********
    public function getReceita($tabela) {
        $this->db->select("SUM(valor) as total");
        $this->db->from($tabela);
        return $this->db->get()->result();
    }

    //*********MÉTODOS DA TAREFA**********
    public function getTarefa($id) {
        $query = "SELECT * "
                . "FROM tarefa "
                . "WHERE idfuncionario=$id ORDER BY id DESC";
        return $this->db->query($query)->result();
    }

    public function getContTarefa($tabela, $id) {
        $this->db->select("COUNT(id) as cont");
        $this->db->from($tabela);
        $this->db->where("idfuncionario=$id AND modo = 0");
        return $this->db->get()->result();
    }

    //*********MÉTODOS DO EVENTO**********
    public function getEvento() {
        $this->db->select("*, evento.id as idevento, evento.descricao as descricaoevento");
        $this->db->from("evento, tipoevento");
        $this->db->where("(evento.idtipoevento = tipoevento.id) ORDER BY evento.id DESC;");
        return $this->db->get()->result();
    }

    public function getContEvento($tabela) {
        $this->db->select("COUNT(id) as cont");
        $this->db->from($tabela);
        $this->db->where("data1= '" . date('Y-m-d') . "'");
        return $this->db->get()->result();
    }

    //*********MÉTODOS DA MENSAGEM**********
    public function getMensagem($id) {
        $this->db->select("mensagem.*,pessoa.*, pessoa.id as idpessoa, mensagem.data as datamensagem");
        $this->db->from("mensagem, pessoa");
        $this->db->where("((mensagem.idagente1=$id AND mensagem.idagente2 !=$id AND pessoa.id=mensagem.idagente2) "
                . "OR (mensagem.idagente1 !=$id AND mensagem.idagente2 =$id AND pessoa.id=mensagem.idagente1)) ORDER BY mensagem.id DESC;");
        return $this->db->get()->result();
    }

    public function getContMensagem($tabela, $id) {
        $this->db->select("COUNT(id) as cont");
        $this->db->from($tabela);
        $this->db->where("(idagente1 !=$id AND idagente2 =$id) AND modo = 0");
        return $this->db->get()->result();
    }

}
