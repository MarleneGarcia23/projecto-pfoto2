<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class PerfilController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/PerfilModel', 'base');
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
        $this->load->view('Sistema/Perfil/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Perfil/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("perfil" => $this->base->listar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM perfil")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Perfil/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $perfil = array(
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($perfil);
                redirect('perfil/listar/1');
            } catch (Exception $exc) {
                redirect('perfil/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $perfil = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($perfil['id'], $perfil);
                redirect('perfil/listar/1');
            } catch (Exception $exc) {
                redirect('perfil/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('perfil/listar/1');
        } else {
            redirect('perfil/listar/2');
        }
    }


}
