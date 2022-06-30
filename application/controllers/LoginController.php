<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Login
 */

class LoginController extends CI_Controller {

    //Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->load->model('Autenticar/UtilizadorModel', 'utilizador');
        $this->load->model('Sistema/LicencaModel', 'baselicenca');
    }

    //Funcao inicial
    public function index() {
        //*****Validar Licença*****
//        $url = "https://sistemahospitalar.com/sistemagestor/licenca/getlicenca";
//        $client = curl_init($url);
//        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
//        $response = curl_exec($client);
//        $result = json_decode($response);
//        $validar = 0;
//        if (!empty($result)) {
//            foreach ($result as $dados) {
//                foreach ($dados as $valor) {
//                    if ((strval(trim($this->baselicenca->listar()[0]->codigo)) == strval(trim($valor->codigo))) && (strval(trim($valor->estado)) == "Activo")) {
//
//                        $this->actualizarlicenca($valor);
//                        if ($this->baselicenca->validarlicenca()) {
//                            $validar = 1;
                            $this->load->view('Autenticar/include/inicio');
                            $this->load->view('Autenticar/Login');
                            $this->load->view('Autenticar/include/fim');
//                        } else {
//                            redirect('licenca/nova/3');
//                        }
//                    }
//                }
//            }
//            ($validar==1)?:redirect('licenca/nova');
//        } else {
//            if ($this->baselicenca->validarlicenca()) {
//                $this->load->view('Autenticar/include/inicio');
//                $this->load->view('Autenticar/Login');
//                $this->load->view('Autenticar/include/fim');
//            } else {
//                redirect('licenca/nova/3');
//            }
//        }
    }

    private function criar_sessao($utilizador) {
        $dados_sessao['logado'] = true;
        $dados_sessao['apelido'] = $utilizador->apelido;
        $dados_sessao['imagem'] = $utilizador->foto;
        $dados_sessao['id'] = $utilizador->id;
        $this->session->set_userdata($dados_sessao);
    }

    public function terminarsessao() {
        $this->session->sess_destroy();
        redirect('login');
    }

    //Funcao que efectua o login
    public function autenticar() {
        $username = filter_var($this->input->post('username'), FILTER_SANITIZE_STRING);
        $senha = filter_var($this->input->post('senha'), FILTER_SANITIZE_STRING);
        if ($this->utilizador->autenticar($username, $senha)) {
            $utilizador = $this->utilizador->autenticar($username, $senha)[0];
            $this->criar_sessao($utilizador);
              if($utilizador->alter == 1)
                redirect('home');
            else
                redirect('alterar');
        } else {
            $dados_sessao['mensagem'] = "Credênciais Inválidas";
            $this->session->set_userdata($dados_sessao);
            redirect('login');
        }
    }
    

    public function actualizarlicenca($valor) {
        $licenca = array(
            "id" => 1,
            "empresa" => ($valor->empresa),
            "nif" => ($valor->nif),
            "email" => $valor->email,
            "telefone" => $valor->telefone,
            "data1" => $valor->data1,
            "data2" => $valor->data2,
            "tipo" => $valor->tipo,
            "estado" => $valor->estado,
            "software" => $valor->software,
            "codigo" => $valor->codigo,
        );
        $this->baselicenca->actualizar($licenca['id'], $licenca);
    }

}
