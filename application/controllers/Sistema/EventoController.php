<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class EventoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/EventoModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/TipoeventoModel', 'basetipoevento');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova() {
        $dados['dados'] = array("tipoevento" => $this->basetipoevento->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Evento/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("evento" => $this->base->getId($id),"tipoevento" => $this->basetipoevento->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Evento/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("evento" => $this->base->getAll(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM evento")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Evento/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $evento = array(
                    "idtipoevento" => ($this->input->post("tipoevento")),
                    "data1" => ($this->input->post("data1")),
                    "data2" => ($this->input->post("data2")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($evento);
                redirect('evento/listar/1');
            } catch (Exception $exc) {
                redirect('evento/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        var_dump($this->input->post());
        die();
        if (isset($_POST['salvar'])) {
            try {
                $evento = array(
                    "id" => ($this->input->post("idevento")),
                    "idtipoevento" => ($this->input->post("tipoevento")),
                    "data1" => ($this->input->post("data1")),
                    "data2" => ($this->input->post("data2")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($evento['id'], $evento);
                redirect('evento/listar/1');
            } catch (Exception $exc) {
                redirect('evento/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('evento/listar/1');
        } else {
            redirect('evento/listar/2');
        }
    }



}
