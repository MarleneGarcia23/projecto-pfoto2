<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class FeriaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/FeriaModel', 'base');
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
        $this->load->view('Sistema/Feria/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("feria" => $this->base->getId($id), "funcionario" => $this->basefuncionario->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Feria/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("feria" => $this->base->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Feria/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $feria = array(
                    "data1" => $this->input->post("data1"),
                    "data2" => $this->input->post("data2"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "descricao" => ($this->input->post("descricao")),
                    "modo" => 0
                );
                $this->base->inserir($feria);
                redirect('feria/listar/1');
            } catch (Exception $exc) {
                redirect('feria/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $feria = array(
                    "id" => $this->input->post("id"),
                    "data1" => $this->input->post("data1"),
                    "data2" => $this->input->post("data2"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "descricao" => ($this->input->post("descricao")),
                    "modo" => 0
                );
                $this->base->actualizar($feria['id'], $feria);
                redirect('feria/listar/1');
            } catch (Exception $exc) {
                redirect('feria/listar/2');
            }
        }
        redirect('home');
    }

    public function calendario() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Feria/Calendario');
        $this->load->view('include/rodape');
    }
    
        public function getferia() {
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
            redirect('feria/listar/1');
        } else {
            redirect('feria/listar/2');
        }
    }

}
