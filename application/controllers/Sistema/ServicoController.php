<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ServicoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/ServicoModel', 'base');
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
        $this->load->view('Sistema/Servico/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Servico/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = $this->base->listar();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Servico/Listar', $dados);
        $this->load->view('include/rodape');
    }


    public function arquivo($ficheiro) {
        $formato = array("jpeg", "jpg", "png", "gif");
        $extensao = pathinfo($ficheiro["arquivo"]["name"], PATHINFO_EXTENSION);
        if (in_array($extensao, $formato)) {
            $pasta = "assets/media/imagem/";
            if ($ficheiro["arquivo"]["tmp_name"] != null) {
                $temp = $ficheiro["arquivo"]["tmp_name"];
                $nome = uniqid() . ".$extensao";
                if (move_uploaded_file($temp, $pasta . $nome)) {
                    return $nome;
                }
            }
            return 'imagem.png';
        }
        return 'imagem.png';
    }

    //Servico
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $servico = array(
                    "designacao" => ($this->input->post("designacao")),
                    "valor" => ($this->input->post("valor")),
                    "imposto" => ($this->input->post("imposto")),
                    "imagem" => $this->arquivo($_FILES),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($servico);
                redirect('servico/listar/1');
            } catch (Exception $exc) {
                redirect('servico/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                if ($_FILES["arquivo"]["tmp_name"] != null) {
                    $servico = array(
                        "id" => $this->input->post("id"),
                        "designacao" => ($this->input->post("designacao")),
                        "valor" => ($this->input->post("valor")),
                        "imposto" => ($this->input->post("imposto")),
                        "imagem" => $this->arquivo($_FILES),
                        "descricao" => ($this->input->post("descricao"))
                    );
                } else {
                    $servico = array(
                        "id" => $this->input->post("id"),
                        "designacao" => ($this->input->post("designacao")),
                        "valor" => ($this->input->post("valor")),
                        "imposto" => ($this->input->post("imposto")),
                        "descricao" => ($this->input->post("descricao"))
                    );
                }
                $this->base->actualizar($servico['id'], $servico);
                redirect('servico/listar/1');
            } catch (Exception $exc) {
                redirect('servico/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('servico/listar/1');
        } else {
            redirect('servico/listar/2');
        }
    }

}
