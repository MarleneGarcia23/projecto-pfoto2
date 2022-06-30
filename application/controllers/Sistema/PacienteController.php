<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class PacienteController extends CI_Controller
{

    //Instacia
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/PacienteModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/MunicipioModel', 'basemunicipio');
    }

    //Verificar sessão
    public function verificar_sessao()
    {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    public function arquivo($ficheiro)
    {
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

    public function arquivoparceiro($ficheiro)
    {
        $formato = array("jpeg", "jpg", "png", "gif");
        $extensao = pathinfo($ficheiro["arquivoparceiro"]["name"], PATHINFO_EXTENSION);
        if (in_array($extensao, $formato)) {
            $pasta = "assets/media/imagem/";
            if ($ficheiro["arquivoparceiro"]["tmp_name"] != null) {
                $temp = $ficheiro["arquivoparceiro"]["tmp_name"];
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
    public function nova()
    {
        $dados['dados'] = array("pacientes" => $this->base->listar(), "municipios" => $this->basemunicipio->buscarmunicipios());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Paciente/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null)
    {
        $dados['dados'] = array("paciente" => $this->base->getId($id),
        "pacientes" => $this->base->listar(),
        "municipios" => $this->basemunicipio->buscarmunicipios());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Paciente/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar()
    {
        $dados['dados'] = array(
            "paciente" => $this->base->listar()
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Paciente/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar()
    {
        if (isset($_POST['salvar'])) {
            try {
                $paciente = array(
                    "nome" => ($this->input->post("nome")),
                    "ndi" => ($this->input->post("ndi")),
                    "tipo" => ($this->input->post("tipo")),
                    "data" => ($this->input->post("data")),
                    "altura" => ($this->input->post("altura")),
                    "raca" => ($this->input->post("raca")),
                    "cidade" => ($this->input->post("municipio")),
                    "bairro" => ($this->input->post("bairro")),
                    "genero" => ($this->input->post("genero")),
                    "rua" => ($this->input->post("rua")),
                    "ncasa" => ($this->input->post("ncasa")),
                    "telefone" => ($this->input->post("telefone")),
                    "email" => $this->input->post("email"),
                    "imagem" => $this->arquivo($_FILES),
                    "datacadastro" => date('Y-m-d'),
                    //Parceiro
                    "ispaciente" => ($this->input->post("ispaciente")),
                    "nomeparceiro" => ($this->input->post("ispaciente") == '0') ? $this->input->post("nomeparceiro") : $this->input->post("nomepacienteparceiro"),
                    "ndiparceiro" => ($this->input->post("ndiparceiro")),
                    "dataparceiro" => ($this->input->post("dataparceiro")),
                    "alturaparceiro" => ($this->input->post("alturaparceiro")),
                    "racaparceiro" => ($this->input->post("racaparceiro")),
                    "cidadeparceiro" => ($this->input->post("municipioparceiro")),
                    "bairroparceiro" => ($this->input->post("bairroparceiro")),
                    "generoparceiro" => ($this->input->post("generoparceiro")),
                    "ruaparceiro" => ($this->input->post("ruaparceiro")),
                    "ncasaparceiro" => ($this->input->post("ncasaparceiro")),
                    "telefoneparceiro" => ($this->input->post("telefoneparceiro")),
                    "emailparceiro" => $this->input->post("emailparceiro"),
                    "imagemparceiro" => $this->arquivoparceiro($_FILES),

                );
                $this->base->inserir($paciente);
                redirect('paciente/listar/1');
            } catch (Exception $exc) {
                redirect('paciente/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar()
    {
        if (isset($_POST['salvar'])) {
            try {
                if ($_FILES["arquivo"]["tmp_name"] != null) {
                    $paciente = array(
                        "id" => $this->input->post("id"),
                        "nome" => ($this->input->post("nome")),
                        "ndi" => ($this->input->post("ndi")),
                        "tipo" => ($this->input->post("tipo")),
                        "data" => ($this->input->post("data")),
                        "altura" => ($this->input->post("altura")),
                        "raca" => ($this->input->post("raca")),
                        "cidade" => ($this->input->post("municipio")),
                        "bairro" => ($this->input->post("bairro")),
                        "genero" => ($this->input->post("genero")),
                        "rua" => ($this->input->post("rua")),
                        "ncasa" => ($this->input->post("ncasa")),
                        "telefone" => ($this->input->post("telefone")),
                        "email" => $this->input->post("email"),
                        "imagem" => $this->arquivo($_FILES),
                        "datacadastro" => date('Y-m-d'),
                        //Parceiro
                        "ispaciente" => ($this->input->post("ispaciente")),
                        "nomeparceiro" => ($this->input->post("ispaciente") == '0') ? $this->input->post("nomeparceiro") : $this->input->post("nomepacienteparceiro"),
                        "ndiparceiro" => ($this->input->post("ndiparceiro")),
                        "dataparceiro" => ($this->input->post("dataparceiro")),
                        "alturaparceiro" => ($this->input->post("alturaparceiro")),
                        "racaparceiro" => ($this->input->post("racaparceiro")),
                        "cidadeparceiro" => ($this->input->post("municipioparceiro")),
                        "bairroparceiro" => ($this->input->post("bairroparceiro")),
                        "generoparceiro" => ($this->input->post("generoparceiro")),
                        "ruaparceiro" => ($this->input->post("ruaparceiro")),
                        "ncasaparceiro" => ($this->input->post("ncasaparceiro")),
                        "telefoneparceiro" => ($this->input->post("telefoneparceiro")),
                        "emailparceiro" => $this->input->post("emailparceiro"),
                        "imagemparceiro" => $this->arquivoparceiro($_FILES),

                    );
                } else {
                    $paciente = array(
                        "id" => $this->input->post("id"),
                        "nome" => ($this->input->post("nome")),
                        "ndi" => ($this->input->post("ndi")),
                        "tipo" => ($this->input->post("tipo")),
                        "data" => ($this->input->post("data")),
                        "altura" => ($this->input->post("altura")),
                        "raca" => ($this->input->post("raca")),
                        "cidade" => ($this->input->post("municipio")),
                        "bairro" => ($this->input->post("bairro")),
                        "genero" => ($this->input->post("genero")),
                        "rua" => ($this->input->post("rua")),
                        "ncasa" => ($this->input->post("ncasa")),
                        "telefone" => ($this->input->post("telefone")),
                        "email" => $this->input->post("email"),
                        "imagem" => $this->arquivo($_FILES),
                        "datacadastro" => date('Y-m-d'),
                        //Parceiro
                        "ispaciente" => ($this->input->post("ispaciente")),
                        "nomeparceiro" => ($this->input->post("ispaciente") == '0') ? $this->input->post("nomeparceiro") : $this->input->post("nomepacienteparceiro"),
                        "ndiparceiro" => ($this->input->post("ndiparceiro")),
                        "dataparceiro" => ($this->input->post("dataparceiro")),
                        "alturaparceiro" => ($this->input->post("alturaparceiro")),
                        "racaparceiro" => ($this->input->post("racaparceiro")),
                        "cidadeparceiro" => ($this->input->post("municipioparceiro")),
                        "bairroparceiro" => ($this->input->post("bairroparceiro")),
                        "generoparceiro" => ($this->input->post("generoparceiro")),
                        "ruaparceiro" => ($this->input->post("ruaparceiro")),
                        "ncasaparceiro" => ($this->input->post("ncasaparceiro")),
                        "telefoneparceiro" => ($this->input->post("telefoneparceiro")),
                        "emailparceiro" => $this->input->post("emailparceiro"),
                    );
                }
                $this->base->actualizar($paciente['id'], $paciente);
                redirect('paciente/listar/1');
            } catch (Exception $exc) {
                redirect('paciente/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('paciente/listar/1');
        } else {
            redirect('paciente/listar/2');
        }
    }
}
