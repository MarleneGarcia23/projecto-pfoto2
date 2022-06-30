<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class CalendarioController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/CalendarioModel', 'base');
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
        $this->load->view('Sistema/Calendario/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("calendario" => $this->base->getId($id));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Calendario/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("calendario" => $this->base->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Calendario/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $calendario = array(
                    "designacao" => ($this->input->post("designacao")),
                    "estado" => ($this->input->post("estado")),
                    "data1" => ($this->input->post("data1")),
                    "data2" => ($this->input->post("data2")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($calendario);
                redirect('calendario/listar/1');
            } catch (Exception $exc) {
                redirect('calendario/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $calendario = array(
                    "id" => ($this->input->post("idcalendario")),
                    "designacao" => ($this->input->post("designacao")),
                    "estado" => ($this->input->post("estado")),
                    "data1" => ($this->input->post("data1")),
                    "data2" => ($this->input->post("data2")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($calendario['id'], $calendario);
                redirect('calendario/listar/1');
            } catch (Exception $exc) {
                redirect('calendario/listar/2');
            }
        }
        redirect('home');
    }

    public function calendario() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Calendario/Calendario');
        $this->load->view('include/rodape');
    }

    public function getcalendario() {
        $dados = array();
        foreach ($this->base->listar() as $valor) {
            $dados[] = array("id" => $valor->id,
                "designacao" => $valor->designacao,
                "data1" => $valor->data1,
                "data2" => $valor->data2,
                "estado" => $valor->estado
            );
        }
        exit(json_encode($dados));
    }

    
    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('calendario/listar/1');
        } else {
            redirect('calendario/listar/2');
        }
    }

}
