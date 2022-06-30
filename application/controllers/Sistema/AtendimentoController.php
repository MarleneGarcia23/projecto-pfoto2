<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class AtendimentoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/AtendimentoModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/ServicoModel', 'baseservico');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova() {
        $dados['dados'] = array("servico" => $this->baseservico->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Atendimento/Nova', $dados);
        $this->load->view('include/rodape');
    }

    public function atender($idservico) {
        $dados['dados'] = array("servico" => $this->baseservico->getId($idservico),
            "cliente" => $this->basecliente->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Atendimento/Atender', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("atendimento" => $this->base->getId($id), "servico" => $this->baseservico->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Atendimento/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("atendimento" => $this->base->maxlistar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM atendimento")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Atendimento/Listar', $dados);
        $this->load->view('include/rodape');
    }

    public function calendario() {
        $dados['dados'] = array("atendimento" => $this->base->maxlistar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Atendimento/Calendario', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $atendimento = array(
                    "idservico" => ($this->input->post("idservico")),
                    "idcliente" => ($this->input->post("cliente")),
                    "valor" => ($this->input->post("valor")),
                    "qtd" => ($this->input->post("qtd")),
                    "data" => ($this->input->post("data")),
                    "modo" =>0,
                );
                $this->base->inserir($atendimento);
                redirect('atendimento/listar/1');
            } catch (Exception $exc) {
                redirect('atendimento/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $atendimento = array(
                    "id" => $this->input->post("id"),
                    "qtd" => ($this->input->post("qtd")),
                    "data" => ($this->input->post("data")),
                );
                $this->base->actualizar($atendimento['id'], $atendimento);
                redirect('atendimento/listar/1');
            } catch (Exception $exc) {
                redirect('atendimento/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('atendimento/listar/1');
        } else {
            redirect('atendimento/listar/2');
        }
    }

}
