<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class CargoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/CargoModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/DepartamentoModel', 'basedepartamento');
        ;
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova() {
        $dados['dados'] = $this->basedepartamento->listar();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cargo/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("cargo" => $this->base->getId($id), "departamento" => $this->basedepartamento->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cargo/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = $this->base->listar();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cargo/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //Cargo
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $cargo = array(
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao")),
                    "iddepartamento" => $this->input->post("departamento")
                );
                $this->base->inserir($cargo);
                redirect('cargo/listar/1');
            } catch (Exception $exc) {
                redirect('cargo/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $cargo = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao")),
                    "iddepartamento" => $this->input->post("departamento")
                );
                $this->base->actualizar($cargo['id'], $cargo);
                redirect('cargo/listar/1');
            } catch (Exception $exc) {
                redirect('cargo/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('cargo/listar/1');
        } else {
            redirect('cargo/listar/2');
        }
    }

}
