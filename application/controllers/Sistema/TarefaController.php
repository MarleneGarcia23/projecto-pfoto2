<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class TarefaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/TarefaModel', 'base');
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
        $this->load->view('Sistema/Tarefa/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null) {
        $dados['dados'] = array("tarefa" => $this->base->getId($id), "funcionario" => $this->basefuncionario->getAll());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tarefa/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function percentagem($id = null) {
        $dados['dados'] = array("tarefa" => $this->base->getId($id));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tarefa/Percentagem', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("tarefa" => $this->base->getAll(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM tarefa")[0]->qtd / 5),
                "ant" => 0, "prox" => 0)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tarefa/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //Detalhe 
    public function detalhe($id) {
        $dados['dados'] = array("tarefa" => $this->base->getDetalhe($id));
        $this->basehome->query("UPDATE tarefa SET modo = 1 WHERE idfuncionario=$id");
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Tarefa/Detalhe', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $tarefa = array(
                    "designacao" => ($this->input->post("designacao")),
                    "data1" => $this->input->post("data1"),
                    "data2" => $this->input->post("data2"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "nivel" => 0,
                    "descricao" => ($this->input->post("descricao")),
                    "modo" => 0
                );
                $this->base->inserir($tarefa);
                redirect('tarefa/listar/1');
            } catch (Exception $exc) {
                redirect('tarefa/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            try {
                $tarefa = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "data1" => $this->input->post("data1"),
                    "data2" => $this->input->post("data2"),
                    "idfuncionario" => $this->input->post("idfuncionario"),
                    "estado" => $this->input->post("estado"),
                    "descricao" => ($this->input->post("descricao"))
                );
                $this->base->actualizar($tarefa['id'], $tarefa);
                redirect('tarefa/listar/1');
            } catch (Exception $exc) {
                redirect('tarefa/listar/2');
            }
        }
        redirect('home');
    }

    public function actualizarnivel() {
        if (isset($_POST['salvar'])) {
            try {
                $tarefa = array(
                    "id" => $this->input->post("id"),
                    "nivel" => $this->input->post("nivel"),
                );
                $this->base->actualizar($tarefa['id'], $tarefa);
                redirect('tarefa/detalhe/'.$this->session->userdata('id'));
            } catch (Exception $exc) {
                redirect('tarefa/detalhe/'.$this->session->userdata('id'));
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('tarefa/listar/1');
        } else {
            redirect('tarefa/listar/2');
        }
    }


}
