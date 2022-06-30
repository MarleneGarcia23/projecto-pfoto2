<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class SiteController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/SiteModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    public function arquivo($ficheiro, $arquivo) {
        $formato = array("jpeg", "jpg", "png", "gif");
        $extensao = pathinfo($ficheiro[$arquivo]["name"], PATHINFO_EXTENSION);
        if (in_array($extensao, $formato)) {
            $pasta = "assets/media/imagem/";
            if ($ficheiro[$arquivo]["tmp_name"] != null) {
                $temp = $ficheiro[$arquivo]["tmp_name"];
                $nome = uniqid() . ".$extensao";
                if (move_uploaded_file($temp, $pasta . $nome)) {
                    return $nome;
                }
            }
            return 'null.png';
        }
        return 'null.png';
    }

    public function painel() {
        $dados['dados'] = $this->base->listar();
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Site/Painel', $dados);
        $this->load->view('include/rodape');
    }

    public function actualizar() {
                $dados = array(
                    "id" => $this->input->post("id"),
                    "logotipo" => ($_FILES["arquivo"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo"):$this->input->post("arquivo"),
                    "telefone1" => $this->input->post("telefone1"),
                    "telefone2" => $this->input->post("telefone2"),
                    "email" => $this->input->post("email"),
                    "dias" => $this->input->post("dias"),
                    "horas" => $this->input->post("horas"),
                    "facebook" => $this->input->post("facebook"),
                    "instagram" => $this->input->post("instagram"),
                    "btn1" => $this->input->post("btn1"),
                    "btn2" => $this->input->post("btn2"),
                    "slide_img1" => ($_FILES["arquivo1"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo1"):$this->input->post("arquivo1"),
                    "slide_txt1" => $this->input->post("slide_txt1"),
                    "slide_img2" => ($_FILES["arquivo2"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo2"):$this->input->post("arquivo2"),
                    "slide_txt2" => $this->input->post("slide_txt2"),
                    "slide_img3" => ($_FILES["arquivo3"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo3"):$this->input->post("arquivo3"),
                    "slide_txt3" => $this->input->post("slide_txt3"),
                    "nota_titulo" => $this->input->post("nota_titulo"),
                    "nota_descricao" => $this->input->post("nota_descricao"),
                    "nota_autor" => $this->input->post("nota_autor"),
                    "nota_cargo" => $this->input->post("nota_cargo"),
                    "servico" => $this->input->post("servico"),
                    "servico_titulo" => $this->input->post("servico_titulo"),
                    "servico_titulo1" => $this->input->post("servico_titulo1"),
                    "servico_descricao1" => $this->input->post("servico_descricao1"),
                    "servico_titulo2" => $this->input->post("servico_titulo2"),
                    "servico_descricao2" => $this->input->post("servico_descricao2"),
                    "servico_titulo3" => $this->input->post("servico_titulo3"),
                    "servico_descricao3" => $this->input->post("servico_descricao3"),
                    "servico_titulo4" => $this->input->post("servico_titulo4"),
                    "servico_descricao4" => $this->input->post("servico_descricao4"),
                    "servico_titulo5" => $this->input->post("servico_titulo5"),
                    "servico_descricao5" => $this->input->post("servico_descricao5"),
                    "servico_img1" => ($_FILES["arquivo4"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo4"):$this->input->post("arquivo4"),
                    "servico_img2" => ($_FILES["arquivo5"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo5"):$this->input->post("arquivo5"),
                    "servico_img3" => ($_FILES["arquivo6"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo6"):$this->input->post("arquivo6"),
                    "servico_img4" => ($_FILES["arquivo7"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo7"):$this->input->post("arquivo7"),
                    "servico_img5" => ($_FILES["arquivo8"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo8"):$this->input->post("arquivo8"),
                    "nota_img" => ($_FILES["arquivo9"]["tmp_name"] != null)? $this->arquivo($_FILES,"arquivo9"):$this->input->post("arquivo9"),
                    
                );
                $this->base->actualizar($dados['id'], $dados);
        
        
        redirect('site/painel/1');
    }

}
