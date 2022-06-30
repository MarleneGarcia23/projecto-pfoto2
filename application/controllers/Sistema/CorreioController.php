<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class CorreioController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/CorreioModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/DepartamentoModel', 'basedepartamento');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function email() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Correio/Email');
        $this->load->view('include/rodape');
    }

    public function emailsuporte() {
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Correio/EmailSuporte');
        $this->load->view('include/rodape');
    }

    public function emailmassa() {
        $dados['dados'] = array("departamento" => $this->basedepartamento->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Correio/EmailMassa', $dados);
        $this->load->view('include/rodape');
    }

    //Caixa 
    public function caixa() {
        $dados['dados'] = array("caixa" => $this->base->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Correio/Caixa', $dados);
        $this->load->view('include/rodape');
    }

    //Caixa 
    public function ver($id) {
        $dados['dados'] = array("caixa" => $this->base->getId($id));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Correio/Ver', $dados);
        $this->load->view('include/rodape');
    }

    public function arquivo($ficheiro) {
        $formato = array("jpeg", "jpg", "png", "gif");
        $extensao = pathinfo($ficheiro["arquivo"]["name"], PATHINFO_EXTENSION);
        if (in_array($extensao, $formato)) {
            $pasta = "assets/media/anexo/";
            if ($ficheiro["arquivo"]["tmp_name"] != null) {
                $temp = $ficheiro["arquivo"]["tmp_name"];
                $nome = uniqid() . ".$extensao";
                if (move_uploaded_file($temp, $pasta . $nome)) {
                    return $nome;
                }
            }
            return null;
        }
        return null;
    }

    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {
                $correio = array(
                    "email" => mb_strtolower($this->input->post("email")),
                    "assunto" => $this->input->post("assunto"),
                    "conteudo" => $this->input->post("conteudo"),
                    "anexo" => $this->arquivo($_FILES),
                    "tipo" => mb_strtolower("normal"),
                    "data" => date('Y-m-d H:i:s'),
                );
                $this->base->inserir($correio);

                /***********Envio de Email**************/
                require 'PHP-Mailer/vendor/autoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'mail.sublime.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'crm@sublime.com';
                $mail->Password = '75639210@mrC';
                $mail->setFrom('crm@sublime.com', 'Sublime');
                $mail->addReplyTo('crm@sublime.com', 'Sublime');
                $mail->addAddress('' . $this->input->post('email') . '', 'Sublime');
                $mail->Subject = 'Sublime';
                $msg = '<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
                $msg .= $this->input->post("conteudo");
                $mail->Body = $msg;
                $mail->AltBody = "HTL";
                $mail->send();
                /*************************/
                
                redirect('correio/caixa/1');
            } catch (Exception $exc) {
                redirect('correio/caixa/2');
            }
        }
        redirect('home');
    }

      public function emaillicenca() {
        if (isset($_POST['salvar'])) {
            try {
                $correio = array(
                    "email" => mb_strtolower($this->input->post("email")),
                    "assunto" => $this->input->post("assunto"),
                    "conteudo" => $this->input->post("conteudo"),
                    "anexo" => $this->arquivo($_FILES),
                    "tipo" => mb_strtolower("normal"),
                    "data" => date('Y-m-d H:i:s'),
                );
                $this->base->inserir($correio);

                /***********Envio de Email************* */
                require 'PHP-Mailer/vendor/autoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'mail.sublime.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'suporte@sublime.com';
                $mail->Password = 'sublime.comTc@75639210!';
                $mail->setFrom('suporte@sublime.com', 'MEUGÉNIO');
                $mail->addReplyTo('suporte@sublime.com', 'MEUGÉNIO');
                $mail->addAddress('' . $this->input->post('email') . '', 'MEUGÉNIO');
                $mail->Subject = 'Sublime';
                $msg = '<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
                $msg .= $this->input->post("conteudo");
                $mail->Body = $msg;
                $mail->AltBody = "HTL";
                $mail->send();
                /*                 * ********************** */
                redirect('licenca/nova/1');
            } catch (Exception $exc) {
                redirect('licenca/nova/2');
            }
        }
        redirect('licenca/nova/2');
    }

    
    public function cadastraremailmassa() {
        if (isset($_POST['salvar'])) {
            try {
                foreach ($this->base->getEmailDepartamento($this->input->post("departamento")) as $valor) {
                    $correio = array(
                        "email" => mb_strtolower($valor->email),
                        "assunto" => $this->input->post("assunto"),
                        "conteudo" => $this->input->post("conteudo"),
                        "anexo" => $this->arquivo($_FILES),
                        "tipo" => mb_strtolower("normal"),
                        "data" => date('Y-m-d H:i:s'),
                    );
                    $this->base->inserir($correio);

                    /*                     * *********Envio de Email************* */
                    require 'PHP-Mailer/vendor/autoload.php';
                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->SMTPDebug = 0;
                    $mail->Host = 'mail.sublime.com';
                    $mail->Port = 587;
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'suporte@sublime.com';
                    $mail->Password = 'sublime.comTc@75639210!';
                    $mail->setFrom('suporte@sublime.com', 'MEUGÉNIO');
                    $mail->addReplyTo('suporte@sublime.com', 'MEUGÉNIO');
                    $mail->addAddress('' . $valor->email . '', 'MEUGÉNIO');
                    $mail->Subject = 'Sublime';
                    $msg = '<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
                    $msg .= $this->input->post("conteudo");
                    $mail->Body = $msg;
                    $mail->AltBody = "HTL";
                    $mail->send();
                    /*                     * ********************** */
                }
                redirect('correio/caixa/1');
            } catch (Exception $exc) {
                redirect('correio/caixa/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('correio/caixa/1');
        } else {
            redirect('correio/caixa/2');
        }
    }

}
