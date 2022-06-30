<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class AgendaController extends CI_Controller
{

    //Instacia
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/AgendaModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/ServicoModel', 'baseservico');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
    }

    //Verificar sessão
    public function verificar_sessao()
    {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }


    //cadastrar
    public function notificar($id = null)
    {

        if ($id != null) {
            try {

                /***********Envio de Email**************/
                require 'PHP-Mailer/vendor/autoload.php';
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 587;
                $mail->SMTPSecure = 'tls';
                $mail->SMTPAuth = true;
                $mail->Username = 'sistemaofficial@gmail.com';
                $mail->Password = 'sistema777';
                $mail->setFrom('sistemaofficial@gmail.com', 'SISTEMA');
                $mail->addReplyTo('sistemaofficial@gmail.com', 'SISTEMA');
                $mail->addAddress('' . $this->input->post('email') . '', 'SISTEMA');
                $mail->isHTML(true);
                $mail->Subject = 'SISTEMA';
                $msg = '<head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>';
                $msg .= "<p><strong>Sauda&ccedil;&atilde;o Sr(a). " . $this->base->getId($id)[0]->nome . "</strong></p>
                            <p>Informamos com est&aacute;, da agenda marcada referente ao atendimento, da data " . $this->base->getId($id)[0]->data . "</p>
                            <p>Estaremos dispon&iacute;veis para mais esclarecimentos pelo seguintes contactos &quot;contactos da institui&ccedil;&atilde;o&quot;</p>
                            <p>&nbsp;</p>
                            <p>Atenciosamente</p>";
                $mail->Body = $msg;
                $mail->AltBody = "HTL";
                if ($mail->send()) {
                    $agenda = array(
                        "id" => $id,
                        "notificacao" => 'NOTIFICADO',
                        "data_notificacao" => date('Y-m-d H:m:s'),
                    );
                    $this->base->actualizar($agenda['id'], $agenda);
                    redirect('agenda/listar/1');
                }


                /*************************/
                redirect('agenda/listar/2');
            } catch (Exception $exc) {
                redirect('agenda/listar/2');
            }
        }
        redirect('agenda/listar/2');
    }
    //Nova 
    public function nova()
    {
        $dados['dados'] = array("servico" => $this->baseservico->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Agenda/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null)
    {
        $dados['dados'] = array("agenda" => $this->base->getId($id), "servico" => $this->baseservico->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Agenda/Editar', $dados);
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar()
    {
        $dados['dados'] = array("agenda" => $this->base->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Agenda/Listar', $dados);
        $this->load->view('include/rodape');
    }

    public function calendario()
    {
        $dados['dados'] = array("cliente" => $this->basecliente->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Agenda/Calendario', $dados);
        $this->load->view('include/rodape');
    }

    //cadastrar
    public function cadastrar()
    {
        if (isset($_POST['salvar'])) {
            try {
                $agenda = array(
                    "nome" => ($this->input->post("nome")),
                    "ndi" => ($this->input->post("ndi")),
                    "idservico" => ($this->input->post("servico")),
                    "telefone" => ($this->input->post("telefone")),
                    "email" => mb_strtolower($this->input->post("email")),
                    "data" => ($this->input->post("data")),
                    "estado" => ("PENDENTE"),
                );
                $this->base->inserir($agenda);
                redirect('agenda/listar/1');
            } catch (Exception $exc) {
                redirect('agenda/listar/2');
            }
        }
        redirect('home');
    }

    //Actualizar
    public function actualizar()
    {
        if (isset($_POST['salvar'])) {
            try {
                $agenda = array(
                    "id" => $this->input->post("id"),
                    "nome" => ($this->input->post("nome")),
                    "ndi" => ($this->input->post("ndi")),
                    "idservico" => ($this->input->post("servico")),
                    "telefone" => ($this->input->post("telefone")),
                    "email" => mb_strtolower($this->input->post("email")),
                    "data" => ($this->input->post("data")),
                );
                $this->base->actualizar($agenda['id'], $agenda);
                redirect('agenda/listar/1');
            } catch (Exception $exc) {
                redirect('agenda/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('agenda/listar/1');
        } else {
            redirect('agenda/listar/2');
        }
    }

    public function getagenda()
    {
        $dados = array();
        foreach ($this->base->listar() as $valor) {
            $dados[] = array(
                "id" => $valor->id,
                "nome" => $valor->nome,
                "data" => $valor->data,
                "estado" => $valor->estado
            );
        }
        exit(json_encode($dados));
    }

    //Eliminar
    public function estado($id, $estado)
    {
        if ($this->base->updateEstado($id, (($estado == 1) ? 'APROVADO' : 'REJEITADO'))) {
            redirect('agenda/listar');
        } else {
            redirect('agenda/listar/2');
        }
    }
}
