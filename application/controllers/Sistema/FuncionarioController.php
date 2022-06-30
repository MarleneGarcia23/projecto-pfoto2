<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class FuncionarioController extends CI_Controller {

//Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/FuncionarioModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/PessoaModel', 'basepessoa');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
        $this->load->model('Sistema/MunicipioModel', 'basemunicipio');
        $this->load->model('Sistema/EnderecoModel', 'baseendereco');
        $this->load->model('Sistema/ContactoModel', 'basecontacto');
        $this->load->model('Sistema/DepartamentoModel', 'basedepartamento');
        $this->load->model('Sistema/CargoModel', 'basecargo');
    }

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

//Funcao inicial
    public function nova() {
        switch ($this->uri->segment(3)) {
            case 1:
                $dados['dados'] = array("municipios" => $this->basemunicipio->buscarmunicipios());
                $this->load->view('include/cabecalho');
                $this->load->view('include/menu');
                $this->load->view('Sistema/Funcionario/Nova', $dados);
                $this->load->view('include/rodape');
                break;
            case 2:
                $dados['dados'] = array("municipios" => $this->basemunicipio->buscarmunicipios());
                $this->load->view('include/cabecalho');
                $this->load->view('include/menu');
                $this->load->view('Sistema/Funcionario/Nova', $dados);
                $this->load->view('include/rodape');
                break;
            case 3:
                $dados['dados'] = array("municipios" => $this->basemunicipio->buscarmunicipios());
                $this->load->view('include/cabecalho');
                $this->load->view('include/menu');
                $this->load->view('Sistema/Funcionario/Nova', $dados);
                $this->load->view('include/rodape');
                break;
            case 4:
                if (isset($_POST['continuar'])) {
                    $dados['funcionario'] = $this->input->post();
                    $dados['funcionario']['imagem'] = $this->arquivo($_FILES);
                    $this->session->set_userdata($dados);
                    $dados['dados'] = array("cargo" => $this->basecargo->listar(), "municipios" => $this->basemunicipio->buscarmunicipios());
                    $this->load->view('include/cabecalho');
                    $this->load->view('include/menu');
                    $this->load->view('Sistema/Funcionario/Nova', $dados);
                    $this->load->view('include/rodape');
                } else {
                    redirect('funcionario/listar/2');
                }
                break;
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

    //Funcao cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            //Inserir Dados
            try {
                if ($this->basepessoa->getNdi($this->session->userdata('funcionario')["ndi"]) == null) {
                    $pessoa = array(
                        "nome" => ($this->session->userdata('funcionario')["nome"]),
                        "apelido" => ($this->session->userdata('funcionario')["apelido"]),
                        "data" => ($this->session->userdata('funcionario')["data"]),
                        "genero" => ($this->session->userdata('funcionario')["genero"]),
                        "ndi" => ($this->session->userdata('funcionario')["ndi"]),
                        "foto" => $this->session->userdata('funcionario')["imagem"]
                    );
                    $endereco = array(
                        "casa" => ($this->session->userdata('funcionario')["casa"]),
                        "rua" => ($this->session->userdata('funcionario')["rua"]),
                        "bairro" => ($this->session->userdata('funcionario')["bairro"]),
                        "idmunicipio" => $this->session->userdata('funcionario')["municipio"],
                        "cpostal" => null
                    );
                    $contacto = array(
                        "email" => mb_strtolower($this->session->userdata('funcionario')["email"]),
                        "telefone" => $this->session->userdata('funcionario')["telefone"]
                    );

                    $this->basepessoa->inserir($pessoa);
                    $idpessoa = $this->db->insert_id();

                    $funcionario = array(
                        "id" => $idpessoa,
                        "idcargo" => $this->input->post("cargo"),
                        "salario" => $this->input->post("salario"),
                        "data" => $this->input->post("data"),
                        "estado" => 'Activo'
                    );

                    $this->base->inserir($funcionario);
                    $id = $this->db->insert_id();

                    $this->baseendereco->inserir($endereco);
                    $idendereco = $this->db->insert_id();

                    $this->basecontacto->inserir($contacto);
                    $idcontacto = $this->db->insert_id();

                    $this->basepessoa->inserirPessoaEndereco(array("idpessoa" => $idpessoa, "idendereco" => $idendereco));
                    $this->basepessoa->inserirPessoaContacto(array("idpessoa" => $idpessoa, "idcontacto" => $idcontacto));


                    redirect('funcionario/listar/1');
                }
                redirect('funcionario/listar/2');
            } catch (Exception $exc) {
                redirect('funcionario/listar/2');
            }
        }
        redirect('home');
    }

    //Funcao listar
    public function listar() {
        $dados['dados'] = $this->base->getAll();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Funcionario/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //Funcao editar
    public function editar($valor = null) {
        if (!isset($_POST['continuar'])) {
            $dados['dados'] = array("funcionario" => $this->base->getId($valor), "municipios" => $this->basemunicipio->buscarmunicipios());
            $this->load->view('include/cabecalho');
            $this->load->view('include/menu');
            $this->load->view('Sistema/Funcionario/Editar', $dados);
            $this->load->view('include/rodape');
        } else if (isset($_POST['continuar'])) {
            $dados['funcionario'] = $this->input->post();
            $dados['funcionario']['imagem'] = $this->arquivo($_FILES);
            $this->session->set_userdata($dados);
            $dados['dados'] = array("funcionario" => $this->base->getId($valor), "cargo" => $this->basecargo->listar(), "municipios" => $this->basemunicipio->buscarmunicipios());
            $this->load->view('include/cabecalho');
            $this->load->view('include/menu');
            $this->load->view('Sistema/Funcionario/Editar', $dados);
            $this->load->view('include/rodape');
        }
    }

    //Funcao actualizar
    public function actualizar() {
        if (isset($_POST['salvar'])) {
            //Inserir Dados
            try {
                if ($this->session->userdata('funcionario')["imagem"] != null) {
                    $pessoa = array(
                        "id" => $this->session->userdata('funcionario')["id"],
                        "nome" => ($this->session->userdata('funcionario')["nome"]),
                        "apelido" => ($this->session->userdata('funcionario')["apelido"]),
                        "data" => $this->session->userdata('funcionario')["data"],
                        "genero" => ($this->session->userdata('funcionario')["genero"]),
                        "ndi" => ($this->session->userdata('funcionario')["ndi"]),
                        "foto" => $this->session->userdata('funcionario')["imagem"]
                    );
                } else {
                    $pessoa = array(
                        "id" => $this->session->userdata('funcionario')["id"],
                        "nome" => ($this->session->userdata('funcionario')["nome"]),
                        "apelido" => ($this->session->userdata('funcionario')["apelido"]),
                        "data" => $this->session->userdata('funcionario')["data"],
                        "genero" => ($this->session->userdata('funcionario')["genero"]),
                        "ndi" => ($this->session->userdata('funcionario')["ndi"]),
                    );
                }
                $endereco = array(
                    "id" => $this->session->userdata('funcionario')["idendereco"],
                    "casa" => ($this->session->userdata('funcionario')["casa"]),
                    "rua" => ($this->session->userdata('funcionario')["rua"]),
                    "bairro" => ($this->session->userdata('funcionario')["bairro"]),
                    "idmunicipio" => $this->session->userdata('funcionario')["municipio"],
                    "cpostal" => null
                );
                $contacto = array(
                    "id" => $this->session->userdata('funcionario')["idcontacto"],
                    "email" =>  mb_strtolower($this->session->userdata('funcionario')["email"]),
                    "telefone" => $this->session->userdata('funcionario')["telefone"]
                );

                $this->basepessoa->actualizar($pessoa['id'], $pessoa);

                $funcionario = array(
                    "id" => $this->session->userdata('funcionario')["id"],
                    "idcargo" => $this->input->post("cargo"),
                    "salario" => $this->input->post("salario"),
                    "data" => $this->input->post("data"),
                    "estado" => 'Activo'
                );

                $this->base->actualizar($funcionario['id'], $funcionario);

                $this->baseendereco->actualizar($endereco['id'], $endereco);

                $this->basecontacto->actualizar($contacto['id'], $contacto);

                redirect('funcionario/listar/1');
            } catch (Exception $exc) {
                redirect('funcionario/listar/2');
            }
        }
        redirect('home');
    }

    //Funcao eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('funcionario/listar/1');
        } else {
            redirect('funcionario/listar/1');
        }
    }

}
