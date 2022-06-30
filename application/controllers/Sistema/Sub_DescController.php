<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class Sub_DescController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/Sub_DescModel', 'base');
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
        $this->load->view('Sistema/Sub_Desc/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Sub_Desc/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("sub_desc" => $this->base->maxlistar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM subcidio_desconto")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Sub_Desc/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $sub_desc = array(
                    "designacao" => ($this->input->post("designacao")),
                    "valor" => ($this->input->post("valor")),
                    "tipo" => ($this->input->post("tipo")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($sub_desc);
                redirect('sub_desc/listar/1');
            } catch (Exception $exc) {
                redirect('sub_desc/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $sub_desc = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "valor" => ($this->input->post("valor")),
                    "tipo" => ($this->input->post("tipo")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($sub_desc['id'], $sub_desc);
                redirect('sub_desc/listar/1');
            } catch (Exception $exc) {
                redirect('sub_desc/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('sub_desc/listar/1');
        } else {
            redirect('sub_desc/listar/2');
        }
    }


}
