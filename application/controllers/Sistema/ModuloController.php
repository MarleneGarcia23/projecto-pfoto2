<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ModuloController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/ModuloModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Listar
    public function listar() {
        $dados['dados'] = array("modulo" => $this->base->listar(),
            "paginacao" => array("qtd" => ceil($this->basehome->select("SELECT COUNT(id) AS qtd FROM modulo")[0]->qtd / 5),
                "ant" => 0, "prox" => 1)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Modulo/Listar', $dados);
        $this->load->view('include/rodape');
    }

    public function activar($valor) {
        try {
            $this->base->updateModo(1, $valor);
            redirect('modulo/listar/1');
        } catch (Exception $exc) {
            redirect('modulo/listar/2');
        }
    }

    public function desactivar($valor) {
        try {
            $this->base->updateModo(0, $valor);
            redirect('modulo/listar/1');
        } catch (Exception $exc) {
            redirect('modulo/listar/2');
        }
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('modulo/listar/1');
        } else {
            redirect('modulo/listar/2');
        }
    }

}
