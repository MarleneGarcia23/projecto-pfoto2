<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class NoticiaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/NoticiaModel', 'base');
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
        $this->load->view('Sistema/Noticia/Nova');
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = $this->base->getId($id);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Noticia/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("noticia" => $this->base->listar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM noticia")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Noticia/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $noticia = array(
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao")),
                    "data" => ($this->input->post("data"))
                );
                $this->base->inserir($noticia);
                redirect('noticia/listar/1');
            } catch (Exception $exc) {
                redirect('noticia/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $noticia = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "descricao" => ($this->input->post("descricao")),
                    "data" => ($this->input->post("data"))
                );
                $this->base->actualizar($noticia['id'], $noticia);
                redirect('noticia/listar/1');
            } catch (Exception $exc) {
                redirect('noticia/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('noticia/listar/1');
        } else {
            redirect('noticia/listar/2');
        }
    }



    //Funcao importar
    public function importar() {
        $url = "https://sublime.com/SublimeEscolar/inscricao/exportar";
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);
        if (!empty($result)) {
            foreach ($result as $dados) {
                foreach ($dados as $valor) {
                    $dados = array(
                        "designacao" => $valor->nome,
                        "descricao" => $valor->classe,
                        "data" => $valor->valor,
                    );
                    if (!($this->base->inserir($dados) == TRUE))
                        break;
                }
            }
            redirect('inscricao/listar');
        }
        redirect('principal');
    }

    //Funcao exportar
    public function exportar() {
        $this->verificar_sessao();
        $json = array();
        header('Content-Type: application/json; charset=utf');
        if (count($this->base->descarregar())) {
            $json['noticias'] = $dados['dados'] = $this->base->descarregar();
        } else {
            $json['noticias'] = array();
        }
        echo json_encode($json, JSON_UNESCAPED_UNICODE);
    }

}
