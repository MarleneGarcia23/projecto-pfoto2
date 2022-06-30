<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ClienteController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/ClienteModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/MunicipioModel', 'basemunicipio');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
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
            return 'avatar.png';
        }
        return 'avatar.png';
    }

    //Nova 
    public function nova() {
        $dados['dados'] = array("municipios" => $this->basemunicipio->buscarmunicipios());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cliente/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("cliente" => $this->base->getId($id), "municipios" => $this->basemunicipio->buscarmunicipios());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cliente/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("cliente" => $this->base->maxlistar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM cliente")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Cliente/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $cliente = array(
                    "nome" => ($this->input->post("nome")),
                    "ndi" => ($this->input->post("ndi")),
                    "tipo" => ($this->input->post("tipo")),
                    "data" => ($this->input->post("data")),
                    "cidade" => ($this->input->post("municipio")),
                    "bairro" => ($this->input->post("bairro")),
                    "rua" => ($this->input->post("rua")),
                    "ncasa" => ($this->input->post("ncasa")),
                    "telefone" => ($this->input->post("telefone")),
                    "email" => $this->input->post("email"),
                    "imagem" => $this->arquivo($_FILES),
                    "datacadastro" => date('Y-m-d'),
                );
                $this->base->inserir($cliente);
                redirect('cliente/listar/1');
            } catch (Exception $exc) {
                redirect('cliente/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                if ($_FILES["arquivo"]["tmp_name"] != null) {
                    $cliente = array(
                        "id" => $this->input->post("id"),
                        "nome" => ($this->input->post("nome")),
                        "ndi" => ($this->input->post("ndi")),
                        "tipo" => ($this->input->post("tipo")),
                        "data" => ($this->input->post("data")),
                        "cidade" => ($this->input->post("cidade")),
                        "bairro" => ($this->input->post("bairro")),
                        "rua" => ($this->input->post("rua")),
                        "ncasa" => ($this->input->post("ncasa")),
                        "telefone" => ($this->input->post("telefone")),
                        "email" => $this->input->post("email"),
                        "imagem" => $this->arquivo($_FILES),
                    );
                } else {
                    $cliente = array(
                        "id" => $this->input->post("id"),
                        "nome" => ($this->input->post("nome")),
                        "ndi" => ($this->input->post("ndi")),
                        "tipo" => ($this->input->post("tipo")),
                        "data" => ($this->input->post("data")),
                        "cidade" => ($this->input->post("cidade")),
                        "bairro" => ($this->input->post("bairro")),
                        "rua" => ($this->input->post("rua")),
                        "ncasa" => ($this->input->post("ncasa")),
                        "telefone" => ($this->input->post("telefone")),
                        "email" => $this->input->post("email"),
                    );
                }
                $this->base->actualizar($cliente['id'], $cliente);
                redirect('cliente/listar/1');
            } catch (Exception $exc) {
                redirect('cliente/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('cliente/listar/1');
        } else {
            redirect('cliente/listar/2');
        }
    }

}
