<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ProdutoController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/ProdutoModel', 'base');
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
        $this->load->view('Sistema/Produto/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Produto/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("produto" => $this->base->listarmax(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM produto")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Produto/Listar', $dados);
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
    

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $produto = array(
                    "designacao" => ($this->input->post("designacao")),
                    "preco1" => ($this->input->post("preco1")),
                    "preco2" => ($this->input->post("preco2")),
                    "imagem" => $this->arquivo($_FILES),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->inserir($produto);
                redirect('produto/listar/1');
            } catch (Exception $exc) {
                redirect('produto/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                if ($_FILES["arquivo"]["tmp_name"] != null) {
                    $produto = array(
                        "id" => $this->input->post("id"),
                        "designacao" => ($this->input->post("designacao")),
                        "preco1" => ($this->input->post("preco1")),
                        "preco2" => ($this->input->post("preco2")),
                        "imagem" => $this->arquivo($_FILES),
                        "descricao" => ($this->input->post("descricao"))
                    );
                } else {
                    $produto = array(
                        "id" => $this->input->post("id"),
                        "designacao" => ($this->input->post("designacao")),
                        "preco1" => ($this->input->post("preco1")),
                        "preco2" => ($this->input->post("preco2")),
                        "descricao" => ($this->input->post("descricao"))
                    );
                }
                $this->base->actualizar($produto['id'], $produto);
                redirect('produto/listar/1');
            } catch (Exception $exc) {
                redirect('produto/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('produto/listar/1');
        } else {
            redirect('produto/listar/2');
        }
    }

}
