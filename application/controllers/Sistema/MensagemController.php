<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class MensagemController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/MensagemModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova($valor) {

        $dados['dados'] = array("mensagem" => $this->base->getMensagem($this->session->userdata('id'), $valor),
            "mensagens" => $this->base->getAllMensagem($this->session->userdata('id')),
            "agente1" => $this->basefuncionario->getAgente($this->session->userdata('id')),
            "agente2" => $this->basefuncionario->getAgente($valor)
        );
        $this->base->updateModo(1, $this->session->userdata('id'), $valor);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Mensagem/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $mensagem = array(
                    "descricao" => base64_encode($this->input->post("descricao")),
                    "idagente1" => $this->input->post("idagente1"),
                    "idagente2" => $this->input->post("idagente2"),
                    "data" => date('Y-m-d'),
                    "modo" => 0
                );
                $this->base->inserir($mensagem);
                redirect('mensagem/nova/' . $this->input->post("idagente2"));
            } catch (Exception $exc) {
                redirect('mensagem/nova/' . $this->input->post("idagente2"));
            }
        }
        redirect('home');
    }

    //Listar
    public function agente() {
        $dados['dados'] = array("agente" => $this->basefuncionario->getElseAgente($this->session->userdata('id')));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Mensagem/Agente', $dados);
        $this->load->view('include/rodape');
    }


}
