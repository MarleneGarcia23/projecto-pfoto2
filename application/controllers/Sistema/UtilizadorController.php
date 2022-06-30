<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class UtilizadorController extends CI_Controller {

//Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/UtilizadorModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/PessoaModel', 'basepessoa');
        $this->load->model('Sistema/PerfilModel', 'baseperfil');
    }

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

//Funcao inicial
    public function nova() {
        $dados['dados'] = array("utilizador" => $this->base->getAll(), "pessoas" => $this->base->getPessoa(),"perfil" => $this->baseperfil->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Utilizador/Nova', $dados);
        $this->load->view('include/rodape');
    }

    public function alterarPass() {
        $this->load->view('Autenticar/include/inicio');
        $this->load->view('Autenticar/Alterar');
        $this->load->view('Autenticar/include/fim');
    }
    
    public function listarajax() {
        $html = '';
        if (count($this->base->listar()) != 0) {
            echo json_encode(['estado' => 'sucesso', 'html' => $this->base->listar()]);
        } else {
            echo json_encode(['estado' => 'sucesso', 'html' => $html]);
        }
    }

    public function procurar() {
        $procurar = $this->input->post()["procurar"];
        if (!empty($procurar)) {
            if (count($this->base->getProcurar($procurar)) != 0) {
                echo json_encode(['dados' => $this->base->getProcurar($procurar)]);
            } else {
                echo json_encode(['dados' => null]);
            }
        }
    }

    public function procurarAll() {
        if (count($this->base->getAll()) != 0) {
            echo json_encode(['dados' => $this->base->getAll()]);
        } else {
            echo json_encode(['dados' => null]);
        }
    }

    //Funcao cadastrar
    public function cadastrar() {
        try {
            if ($this->base->getUsername($this->input->post("username")) == null) {
                //dados aluno
                $utilizador = array(
                    "id" => $this->input->post("idpessoa"),
                    "username" => $this->input->post("username"),
                    "senha" => sha1($this->input->post("senha")),
                    "idperfil" => $this->input->post("idperfil"),
                    "estado" => '1'
                );

                $this->base->inserir($utilizador);

                redirect('utilizador/nova/1');
            }
            redirect('utilizador/nova/2');
        } catch (Exception $exc) {
            redirect('utilizador/nova/2');
        }
    }

    //Funcao listar
    public function listar() {
        $dados['dados'] = $this->base->getAll();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Utilizador/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //Funcao editar
    public function editar($valor = null) {
        //Dados do encarregado
        $dados['dados'] = array("utilizador" => $this->base->getid($valor),"perfil" => $this->baseperfil->listar() );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Utilizador/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Funcao actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            //Inserir Dados
            try {
                //dados aluno
                $utilizador = array(
                    "id" => $this->input->post("id"),
                    "username" => $this->input->post("username"),
                    "idperfil" => $this->input->post("perfil"),
                );
                $this->base->actualizar($utilizador['id'],$utilizador);
                redirect('utilizador/nova/1');
            } catch (Exception $exc) {
                redirect('utilizador/nova/2');
            }
        }
        redirect('home');
    }
    
    
        //Funcao actualizar
    public function redifinirSenha($valor = null) {
        if ($valor != null) {
            //Inserir Dados
            try {
                //dados aluno
                $utilizador = array(
                    "id" => $valor,
                    "senha" => sha1('12345678'),
                    "alter" => '0',
                );
                $this->base->actualizar($utilizador['id'],$utilizador);
                redirect('utilizador/nova/1');
            } catch (Exception $exc) {
                redirect('utilizador/nova/2');
            }
        }
        redirect('home');
    }
    
    public function newPass() {
        if($this->input->post('senha') == $this->input->post('senha_')){

            $dados = array(
                "senha" => sha1($this->input->post("senha")),
                "alter" => '1',
            );

            if ($this->base->alterarSenha($this->session->id, $dados)) {
                redirect('home');
            } 
        }else {
            $dados_sessao['mensagem'] = "Credênciais Diferentes";
            $this->session->set_userdata($dados_sessao);
            redirect('alterar');
        }
    }

    //Funcao eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('utilizador/nova/1');
        } else {
            redirect('utilizador/nova/1');
        }
    }

}
