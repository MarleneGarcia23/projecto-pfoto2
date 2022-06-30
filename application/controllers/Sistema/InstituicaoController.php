<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

/* Autor: Hilquias Chitazo 19/21/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class InstituicaoController extends CI_Controller {

    //Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/InstituicaoModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/MunicipioModel', 'basemunicipio');
        $this->load->model('Sistema/EnderecoModel', 'baseendereco');
        $this->load->model('Sistema/ContactoModel', 'basecontacto');
    }

    //Funcao que verifica a sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Funcao inicial
    public function nova() {
        $dados['dados'] = $this->basemunicipio->buscarmunicipios();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Instituicao/Nova', $dados);
        $this->load->view('include/rodape');
    }

    public function arquivo($ficheiro) {
        $formato = array("docx", "xlssx", "jpeg", "jpg", "png", "gif");
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

    //Funcao cadastrar
    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            $instituicao = array(
                "nome" => ($this->input->post('nome')),
                "nif" => ($this->input->post('nif')),
                "data" => $this->input->post('data'),
                "logotipo" => $this->arquivo($_FILES),
                "estado" => 'Activo'
            );
            $endereco = array(
                "casa" => ($this->input->post('casa')),
                "rua" => ($this->input->post('rua')),
                "bairro" => ($this->input->post('bairro')),
                "idmunicipio" => $this->input->post('municipio'),
                "cpostal" => $this->input->post('codigopostal')
            );
            $contacto = array(
                "email" =>  mb_strtolower($this->input->post('email')),
                "telefone" => $this->input->post('telefone')
            );

            //Inserir Dados
            try {
                $this->base->inserir($instituicao);
                $idinstituicao = $this->db->insert_id();

                $this->baseendereco->inserir($endereco);
                $idendereco = $this->db->insert_id();

                $this->basecontacto->inserir($contacto);
                $idcontacto = $this->db->insert_id();

                $this->base->inserirInstEnder(array("idinstituicao" => $idinstituicao, "idendereco" => $idendereco));
                $this->base->inserirInstCont(array("idinstituicao" => $idinstituicao, "idcontacto" => $idcontacto));


                /*                 * *********Envio de Email************* */
                require 'PHP-Mailer/vendor/autoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'sublimeescolar@gmail.com';
                $mail->Password = '@meu*genio@';
                $mail->setFrom('sublimeescolar@gmail.com', 'MEUGÉNIO');
                $mail->addReplyTo('sublimeescolar@gmail.com', 'MEUGÉNIO');
                $mail->addAddress('' . $this->input->post('email') . '', 'MEUGÉNIO');
                $mail->Subject = 'Sublime-Escolar';
                $msg = '<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head> <b>Caro(a) Senhor(a) <i> ' . $this->input->post('nome') . '</i></b>.<br>';
                $msg .= 'Vimos por este meio agradecer-lhe pelo processo de cadastro ao sistema!.<br>';
                $msg .= 'Melhores cumprimentos.<br>';
                $msg .= 'A Equipa Sublime<br>';
                $mail->Body = $msg;
                $mail->AltBody = "HTL";
                $mail->send();
                /*                 * ********************** */
                redirect('instituicao/listar/1');
            } catch (Exception $exc) {
                redirect('instituicao/listar/2');
            }
        }
        redirect('instituicao/home');
    }

    //Funcao actualizar
    public function actualizar() {

        if (isset($_POST['actualizar'])) {

            if ($_FILES["arquivo"]["tmp_name"] != null) {
                $instituicao = array(
                    "id" => $this->input->post('id'),
                    "nome" => ($this->input->post('nome')),
                    "nif" => ($this->input->post('nif')),
                    "data" => $this->input->post('data'),
                    "logotipo" => $this->arquivo($_FILES),
                    "estado" => 'Activo'
                );
            } else {
                $instituicao = array(
                    "id" => $this->input->post('id'),
                    "nome" => ($this->input->post('nome')),
                    "nif" => ($this->input->post('nif')),
                    "data" => $this->input->post('data'),
                    "estado" => 'Activo'
                );
            }
            $endereco = array(
                "id" => $this->input->post('idendereco'),
                "casa" => ($this->input->post('casa')),
                "rua" => ($this->input->post('rua')),
                "bairro" => ($this->input->post('bairro')),
                "idmunicipio" => $this->input->post('municipio'),
                "cpostal" => $this->input->post('codigopostal')
            );
            $contacto = array(
                "id" => $this->input->post('idcontacto'),
                "email" =>  mb_strtolower($this->input->post('email')),
                "telefone" => $this->input->post('telefone')
            );

            //Actualizar dados
            try {
                $this->base->actualizar($instituicao['id'], $instituicao);
                $this->baseendereco->actualizar($endereco['id'], $endereco);
                $this->basecontacto->actualizar($contacto['id'], $contacto);
                redirect('instituicao/listar/1');
            } catch (Exception $exc) {
                redirect('instituicao/listar/2');
            }
        }
        redirect('instituicao/listar');
    }

    //Funcao listar
    public function listar() {
        $dados['dados'] = $this->base->getAll();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Instituicao/Listar', $dados);
        $this->load->view('include/rodape');
    }

    //Funcao editar
    public function editar() {
        $dados['dados'] = array("instituicao" => $this->base->getId($this->uri->segment(3)), "municipios" => $this->basemunicipio->buscarmunicipios());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Instituicao/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Funcao eliminar
    public function eliminar() {
        if ($this->base->eliminar($this->uri->segment(3)) == TRUE) {
            redirect('instituicao/listar');
        } else {
            redirect('instituicao/listar');
        }
    }

    //Funcao mudar estado
    public function estado() {
        if ($this->base->estado($this->uri->segment(3)) == TRUE) {
            redirect('instituicao/listar');
        } else {
            redirect('instituicao/listar');
        }
    }

}
