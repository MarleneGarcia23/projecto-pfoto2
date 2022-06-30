<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ExameController extends CI_Controller
{

    //Instacia
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/ExameModel', 'base');
        $this->load->model('Sistema/ExameItemModel', 'baseitem');
        $this->load->model('Sistema/GrupoExameModel', 'basegrupoexame');
        $this->load->model('Sistema/HomeModel', 'basehome');
    }

    //Verificar sessão
    public function verificar_sessao()
    {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Nova 
    public function nova()
    {
        $dados['dados'] = array("grupoexame" => $this->basegrupoexame->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Exame/Nova', $dados);
        $this->load->view('include/rodape');
    }

    //Editar
    public function editar($id = null)
    {/* 
        $this->base->getIdExame($id); */



        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        if ($this->base->getId($id)[0]->isexameitem != 1) {
            $dados['dados'] = $this->base->getId($id);
            $this->load->view('Sistema/Exame/Editar', $dados);
        } else {
            $dados['dados'] =  array("exame" => $this->base->getId($id), "exameitem" => $this->baseitem->getIdExame($id), "grupoexame" => $this->basegrupoexame->listar());
            $this->load->view('Sistema/Exame/EditarItem', $dados);
        }
        $this->load->view('include/rodape');
    }

    //Listar
    public function listar()
    {
        $dados['dados'] = array("exame" => $this->base->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Exame/Listar', $dados);
        $this->load->view('include/rodape');
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
            return 'imagem.png';
        }
        return 'imagem.png';
    }

    //cadastrar
    public function cadastrar()
    {
        if (isset($_POST['salvar'])) {
            try {
                $exame = array(
                    "designacao" => ($this->input->post("designacao")),
                    "valor" => ($this->input->post("valor")),
                    "descricao" => $this->input->post("descricao")
                );
                $this->base->inserir($exame);
                redirect('exame/listar/1');
            } catch (Exception $exc) {
                redirect('exame/listar/2');
            }
        }
        redirect('home');
    }

    //cadastrar
    public function insupditem()
    {

        $itemexame_grupo = $this->input->post('itemexame_grupo');
        $itemexame_designacao = $this->input->post('itemexame_designacao');
        $itemexame_valor = $this->input->post('itemexame_valor');

        if ($this->input->post('idexame') == null) {
            $exame = array(
                "designacao" => ($this->input->post("designacao")),
                "isexameitem" => 1
            );
            $this->base->inserir($exame);

            $idexame = $this->db->insert_id();

            for ($i = 0; $i < count($itemexame_designacao); $i++) {
                $exameitem = array(
                    "designacao" => $itemexame_designacao[$i],
                    "valor" => $itemexame_valor[$i],
                    "idgrupoexame" => $itemexame_grupo[$i],
                    "idexame" => $idexame,
                );
                $this->baseitem->inserir($exameitem);
            }
        } else {
            $exame = array(
                "id" => $this->input->post("idexame"),
                "designacao" => ($this->input->post("designacao")),
                "isexameitem" => 1
            );
            $this->base->actualizar($exame['id'], $exame);
            if ($this->baseitem->eliminarExame($exame['id']) == TRUE) {
                for ($i = 0; $i < count($itemexame_designacao); $i++) {
                    $exameitem = array(
                        "designacao" => $itemexame_designacao[$i],
                        "valor" => $itemexame_valor[$i],
                        "idgrupoexame" => $itemexame_grupo[$i],
                        "idexame" => $exame['id'],
                    );
                    $this->baseitem->inserir($exameitem);
                }
            }
        }

        exit(json_encode(array('valor' => 1)));
    }

    //Actualizar
    public function actualizar()
    {
        if (isset($_POST['salvar'])) {
            try {

                $exame = array(
                    "id" => $this->input->post("id"),
                    "designacao" => ($this->input->post("designacao")),
                    "valor" => ($this->input->post("valor")),
                    "descricao" => $this->input->post("descricao")
                );
                $this->base->actualizar($exame['id'], $exame);
                redirect('exame/listar/1');
            } catch (Exception $exc) {
                redirect('exame/listar/2');
            }
        }
        redirect('home');
    }

    //Eliminar
    public function eliminar($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('exame/listar/1');
        } else {
            redirect('exame/listar/2');
        }
    }
}
