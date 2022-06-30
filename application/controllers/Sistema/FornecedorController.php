<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class FornecedorController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/FornecedorModel', 'base');
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
        $this->load->view('Sistema/Fornecedor/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Fornecedor/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("fornecedor" => $this->base->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Fornecedor/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $fornecedor = array(
                    "designacao" => ($this->input->post("designacao")),
                    "nif" => ($this->input->post("nif")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($fornecedor);
                redirect('fornecedor/listar/1');
            } catch (Exception $exc) {
                redirect('fornecedor/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $fornecedor = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "nif" => ($this->input->post("nif")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($fornecedor['id'], $fornecedor);
                redirect('fornecedor/listar/1');
            } catch (Exception $exc) {
                redirect('fornecedor/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('fornecedor/listar/1');
        } else {
            redirect('fornecedor/listar/2');
        }
    }


}
