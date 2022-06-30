<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class TipoeventoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/TipoeventoModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tipoevento/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tipoevento/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("tipoevento" => $this->base->listar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM tipoevento")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tipoevento/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $tipoevento = array(
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($tipoevento);
                redirect('tipoevento/listar/1');
            } catch (Exception $exc) {
                redirect('tipoevento/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $tipoevento = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($tipoevento['id'], $tipoevento);
                redirect('tipoevento/listar/1');
            } catch (Exception $exc) {
                redirect('tipoevento/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('tipoevento/listar/1');
        } else {
            redirect('tipoevento/listar/2');
        }
    }

}
