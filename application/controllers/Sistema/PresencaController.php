<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class PresencaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/PresencaModel', 'base');
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
    public function nova() {
        $dados['dados'] = array("funcionario" => $this->basefuncionario->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Presenca/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("presenca" => $this->base->getId($id), "funcionario" => $this->basefuncionario->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Presenca/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("presenca" => $this->base->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Presenca/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $presenca = array(
                    "data" => $this->input->post("data"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "descricao" => ($this->input->post("descricao")),
                    "modo" => 0
                );
                $this->base->inserir($presenca);
                redirect('presenca/listar/1');
            } catch (Exception $exc) {
                redirect('presenca/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $presenca = array(
                    "id" => $this->input->post("id"),
                    "data" => $this->input->post("data"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "descricao" => ($this->input->post("descricao")),
                    "modo" => 0
                );
                $this->base->actualizar($presenca['id'], $presenca);
                redirect('presenca/listar/1');
            } catch (Exception $exc) {
                redirect('presenca/listar/2');
            }
        }
        redirect('home');
    }

    public function calendario() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Presenca/Calendario');
        $this->load->view('include/rodape');
    }
    
        public function getpresenca() {
        $dados = array();
        foreach ($this->base->getAll() as $valor) {
            $dados[] = array("id" => $valor->id,
                "nome" => $valor->nome,
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
            redirect('presenca/listar/1');
        } else {
            redirect('presenca/listar/2');
        }
    }

}
