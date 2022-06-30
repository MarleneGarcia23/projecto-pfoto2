<?php

defined('BASEPATH') or exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ClinicoController extends CI_Controller
{

    //Instacia
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        require_once APPPATH . 'third_party/fpdf/fpdf.php';
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
        $this->load->helper('Patient');
        $this->load->model('Sistema/FichaClinicaModel', 'basefichaclinica');
        $this->load->model('Sistema/CpFivModel', 'basecpfiv');
        $this->load->model('Sistema/CpFivItemModel', 'basecpfivitem');
        $this->load->model('Sistema/PeriodoMenstrualModel', 'baseperiodomenstrual');
        $this->load->model('Sistema/PacienteModel', 'basepaciente');
        $this->load->model('Sistema/CardapioModel', 'basecardapio');
        $this->load->model('Sistema/PedidoExameModel', 'basepedidoexame');
        $this->load->model('Sistema/ItemPedidoExameModel', 'baseitempedidoexame');
        $this->load->model('Sistema/ExameModel', 'baseexame');
        $this->load->model('Sistema/ExameItemModel', 'baseexameitem');
        $this->load->model('Sistema/ReceitaModel', 'basereceita');
        $this->load->model('Sistema/ResultadoExameModel', 'baseresultadoexame');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/HomeModel', 'basehome');
    }

    //Verificar sessão
    public function verificar_sessao()
    {
        /*      if ($this->session->userdata('logado') == false) {
            redirect('login');
        } */
    }

    public function abreviarnome($valor)
    {
        $valor = trim($valor);
        $auxnome = explode(' ', $valor);
        $nomenovo = null;
        if (count($auxnome) > 1) {
            for ($i = 0; $i < count($auxnome); $i++) {
                if ($i == 0) {
                    $nomenovo = $auxnome[$i] . ' ';
                } elseif ($i == count($auxnome) - 1) {
                    return $nomenovo .= $auxnome[$i];
                } else {
                    $nomenovo .= substr($auxnome[$i], 0, 1) . '. ';
                }
            }
        } else {
            return $valor;
        }
    }

    public function mecanografico($valor)
    {
        if ($valor > 1000) {
            return 'FAC' . $valor;
        } elseif ($valor > 100) {
            return "FAC0" . $valor;
        } elseif ($valor > 10) {
            return "FAC00" . $valor;
        } else {
            return "FAC000" . $valor;
        }
    }

    private $style = array(
        'position' => '',
        'align' => 'C',
        'stretch' => false,
        'fitwidth' => true,
        'cellfitalign' => '',
        'border' => false,
        'hpadding' => 'auto',
        'vpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => false,
        'text' => false,
        'font' => 'Times',
        'fontsize' => 9,
        'stretchtext' => 4
    );



    public function abrirfile($url, $id)
    {
        $file = str_replace('/', '\\\\', "assets/media/anexo/" . $url);
        shell_exec($file);
        redirect('clinico/fichaclinica/' . $id);
    }

    /***************
     * Paciente
     ***************/
    public function listarpaciente()
    {
        $dados['dados'] = array("paciente" => $this->basepaciente->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/ListarPaciente', $dados);
        $this->load->view('include/rodape');
    }

    /***************
     * Dados Clinico
     ***************/
    public function dadosclinico($id = null)
    {
        $data = array(
            "paciente" => $this->basepaciente->getId($id)[0],
            "fichaclinica" => $this->basefichaclinica->getIdPaciente($id),
            "cardapio" => $this->basecardapio->listar(),
            "historicoexame" => $this->baseresultadoexame->listarResultadoExameIdPaciente($id),
            "historicoreceita" => $this->basereceita->getId($id)
        );

        $array = calculate_age_and_months_of_life($data['paciente']->data);
        $data['months_to_birth_day'] = $array['months_to_birth_day'];
        $data['age'] = $array['age'];
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/DadosClinico', $data);
        $this->load->view('include/rodape');
    }


    /***************
     * Ficha Clínica
     ***************/
    public function fichaclinica($id = null)
    {
        $data = array(
            "paciente" => $this->basepaciente->getId($id)[0],
            "fichaclinica" => $this->basefichaclinica->getIdPaciente($id),
            "cardapio" => $this->basecardapio->listar()
        );
        $array = calculate_age_and_months_of_life($data['paciente']->data);
        $data['months_to_birth_day'] = $array['months_to_birth_day'];
        $data['age'] = $array['age'];

        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/FichaClinica', $data);
        $this->load->view('include/rodape');
    }

    public function cadastrarfichaclinica()
    {
        $dados = array(
            "idpaciente" => $this->input->post('idpaciente'),
            "idcardapio" => $this->input->post('idcardapio'),
            "data1" => date('Y-m-d'),
            "peso" => $this->input->post('peso'),
            "temperatura" => $this->input->post('temperatura'),
            "pa" => $this->input->post('pa'),
            "pulso" => $this->input->post('pulso'),
            "data2" => $this->input->post('data2'),
            "descricao" => $this->input->post('descricao'),
        );
        $this->basefichaclinica->inserir($dados);

        redirect('clinico/fichaclinica/' . $this->input->post('idpaciente'));
    }


    public function actualizarfichaclinica()
    {
        $dados = array(
            "id" => $this->input->post('id'),
            "idpaciente" => $this->input->post('idpaciente'),
            "idcardapio" => $this->input->post('idcardapio'),
            "data1" =>  $this->input->post('data1'),
            "peso" => $this->input->post('peso'),
            "altura" => $this->input->post('altura'),
            "pa" => $this->input->post('pa'),
            "pulso" => $this->input->post('pulso'),
            "data2" => $this->input->post('data2'),
            "descricao" => $this->input->post('descricao'),
        );

        $this->basefichaclinica->actualizar($dados['id'], $dados);


        redirect('clinico/fichaclinica/' . $this->input->post('idpaciente'));
    }

    public function eliminarfichaclinica($valor)
    {
        $this->basefichaclinica->eliminar($valor);
        redirect('clinico/fichaclinica/' . $_GET['idpaciente']);
    }


    public function getfichaclinica()
    {
        $dados = array();
        foreach ($this->basefichaclinica->getIdPaciente($this->input->post("valor")) as $valor) {
            $dados[] = array(
                "id" => $valor->id,
                "data1" => $valor->data1,
                "peso" => $valor->peso,
                "pa" => $valor->pa,
                "pulso" => $valor->pulso,
                "data2" => $valor->data2,
            );
        }
        exit(json_encode($dados));
    }


    /***************
     * Periodo Menstrual
     ***************/
    public function periodomenstrual($id = null)
    {
        $dados['dados'] = array("paciente" => $this->basepaciente->getId($id), "periodomenstrual" => $this->baseperiodomenstrual->getIdPaciente($id), "fichaclinica" => $this->basefichaclinica->getIdPaciente($id), "pedidoexame" => $this->basepedidoexame->listarpaciente($id),);
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/PeriodoMenstrual', $dados);
        $this->load->view('include/rodape');
    }


    /***************
     * Exame
     ***************/
    public function pedidoexame($id = null)
    {
        $dados['dados'] = array("paciente" => $this->basepaciente->getId($id), "fichaclinica" => $this->basefichaclinica->getIdPaciente($id), "pedidoexame" => $this->basepedidoexame->listarpaciente($id),  "exame" => $this->baseexame->listar());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/PedidoExame', $dados);
        $this->load->view('include/rodape');
    }


    public function elaborarexame($id = null)
    {
        $dados['dados'] = array("idpedido" => $id, "paciente" => $this->basepaciente->getId($this->baseexame->listaritempedidoexame($id)[0]->idpaciente), "itempedidoexame" => $this->baseexame->listaritempedidoexame($id));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/ElaborarExame', $dados, $this->baseexameitem);
        $this->load->view('include/rodape');
    }

    public function editarresultadoexame($pedido_id = null)
    {
        $dados = array(
            "pedido_id" => $pedido_id,
            "paciente" => $this->basepedidoexame->get_paciente_by_id($pedido_id),
            "resultados" => $this->baseexame->get_resultado_exame($pedido_id)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/EditarResultadoExame', $dados);
        $this->load->view('include/rodape');
    }

    public function actualizarresultadoexame()
    {
        $ids = $this->input->post('ids');
        foreach ($ids as $index => $id) {
            $this->baseresultadoexame->actualizar($id, [
                'resultado' => $this->input->post('resultados')[$index],
                'estado' => $this->input->post('estados')[$index],
            ]);
        }
        return redirect('clinico/listarresultadoexame');
    }

    public function listarresultadoexame()
    {
        $dados['dados'] = array("resultadoexame" => $this->baseresultadoexame->listarresultadoexame());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/ListarResultadoExame', $dados);
        $this->load->view('include/rodape');
    }

    public function listarpedidoexame()
    {
        $dados['dados'] = array("pedidoexame" => $this->basepedidoexame->listarpedidoexame());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/ListarPedidoExame', $dados);
        $this->load->view('include/rodape');
    }

    public function arquivo($ficheiro, $pos)
    {
        $extensao = pathinfo($ficheiro["arquivo$pos"]["name"], PATHINFO_EXTENSION);
        $pasta = "assets/media/anexo/";
        if ($ficheiro["arquivo$pos"]["tmp_name"] != null) {
            $temp = $ficheiro["arquivo$pos"]["tmp_name"];
            $nome = uniqid() . ".$extensao";
            if (move_uploaded_file($temp, $pasta . $nome)) {
                return $nome;
            }
        }
        return null;
    }

    public function cadastrarpedidoexame()
    {

        $aux = 0;
        $idpedidoexame = null;
        if (count($this->input->post()) > 1) {

            foreach ($this->input->post() as $valor) {
                if ($aux == 0) {
                    $aux++;
                    date_default_timezone_set('Africa/Luanda');
                    $dados = array(
                        "idpaciente" =>  $valor,
                        "data" => date('Y-m-d H:m:s'),
                    );
                    $this->basepedidoexame->inserir($dados);
                    $idpedidoexame = $this->db->insert_id();
                } else {
                    $dados = array(
                        "idpedido" => $idpedidoexame,
                        "idexame" =>  $valor,
                    );
                    $this->baseitempedidoexame->inserir($dados);
                }
            }
        }

        redirect('clinico/pedidoexame/' . $this->input->post('idpaciente'));
    }

    public function mostrar_pedido_exame($pedido_id)
    {
        $dados = array(
            "itens" => $this->basepedidoexame->find_itens_by_id($pedido_id),
            "paciente" => $this->basepedidoexame->get_paciente_by_id($pedido_id),
            "exames" => $this->baseexame->listar(),
            "pedido_id" => $pedido_id
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/EditarPedidoExame', $dados);
        $this->load->view('include/rodape');
    }

    public function editar_pedido_exame()
    {
        if ($this->basepedidoexame->delete_itens($this->input->post('pedido_id'))) {
            foreach ($this->input->post('exames') as $exame_id) {
                $this->baseitempedidoexame->inserir([
                    'idpedido' => $this->input->post('pedido_id'),
                    'idexame' => $exame_id
                ]);
            }
            return redirect('clinico/listarpedidoexame');
        }
        $this->mostrar_pedido_exame($this->input->post('pedido_id'));
    }

    public function eliminarpedidoexame($valor, $idpaciente)
    {
        $this->basepedidoexame->eliminar($valor);
        redirect('clinico/pedidoexame/' . $idpaciente);
    }

    public function cadastrarelaborarexame()
    {
        if (count($this->input->post()) > 1) {
            $aux = 0;
            $idpedido = 0;
            $idpaciente = 0;
            $idexame = 0;
            $idexameitem = 0;
            $resultado = 0;
            $estado = 0;

            foreach ($this->input->post() as $valor) {
                ++$aux;
                switch ($aux) {
                    case 1:
                        $idpedido = $valor;
                        break;
                    case 2:
                        $idpaciente = $valor;
                        break;
                    case 3:
                        $idexame = $valor;
                        break;
                    case 4:
                        $idexameitem = $valor;
                        break;
                    case 5:
                        $resultado = $valor;
                        break;
                    case 6:
                        $estado = $valor;
                        $dados = array(
                            "idpedido" =>  $idpedido,
                            "idpaciente" =>  $idpaciente,
                            "idexame" =>  $idexame,
                            "idexameitem" =>  $idexameitem,
                            "resultado" =>  $resultado,
                            "estado" =>  $estado,
                            "observacao" => $this->input->post('observacao'),
                            "data" => date('Y-m-d H:m:s'),
                        );
                        $this->baseresultadoexame->inserir($dados);
                        $pedidoexame = array(
                            "id" => $idpedido,
                            "estado" => 1,
                        );
                        $this->basepedidoexame->actualizar($pedidoexame['id'], $pedidoexame);
                        $aux = 0;
                        $idpedido = 0;
                        $idpaciente = 0;
                        $idexame = 0;
                        $resultado = 0;
                        $estado = 0;
                        break;
                }
            }
        }
        redirect('clinico/listarresultadoexame/1');
    }

    public function eliminarresultadoexame($valor)
    {
        $this->baseresultadoexame->eliminarresultadoexame($valor);
        redirect('clinico/listarresultadoexame/1');
    }


    /***************
     * Receita
     ***************/
    public function receita($id = null)
    {
        $dados['dados'] = array("paciente" => $this->basepaciente->getId($id), "fichaclinica" => $this->basefichaclinica->getIdPaciente($id), "receita" => $this->basereceita->getId($id));
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/Receita', $dados);
        $this->load->view('include/rodape');
    }

    public function editarreceita($receita_id)
    {
        $dados = array(
            'receita' => $this->basereceita->getIdReceita($receita_id)[0],
            "paciente" => $this->basepaciente->getId($receita->idpaciente)[0],
            "fichaclinica" => $this->basefichaclinica->getIdPaciente($receita->id)
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/EditarReceita', $dados);
        $this->load->view('include/rodape');
    }

    public function cadastrarreceita()
    {
        $dados = array(
            "idpaciente" => $this->input->post('idpaciente'),
            "descricao" => $this->input->post('descricao'),
            "data" => date('Y-m-d H:m:s'),
        );
        $this->basereceita->inserir($dados);

        redirect('clinico/receita/' . $this->input->post('idpaciente'));
    }

    public function eliminarreceita($valor, $idpaciente)
    {
        $this->basereceita->eliminar($valor);
        redirect('clinico/receita/' . $idpaciente);
    }
    public function actualizarreceita()
    {
        $this->basereceita->actualizar($this->input->post('idreceita'), [
            'descricao' => $this->input->post('descricao')
        ]);
        return redirect("clinico/receita/" . $this->input->post('idpaciente'));
    }


    /***************
     * Periodo Menstrual
     ***************/
    public function cadastrarperiodomenstrual()
    {

        $dados = array(
            "idpaciente" => $this->input->post('idpaciente'),
            "data1" => $this->input->post('data1'),
            "dia" => $this->input->post('dia'),
            "dias" => $this->input->post('dias'),
            "data2" => date('Y-m-d', strtotime('+' . (intval($this->input->post('dias'))) . " days", strtotime($this->input->post('data1')))),
            "descricao" => $this->input->post('descricao'),
        );
        $this->baseperiodomenstrual->inserir($dados);

        redirect('clinico/periodomenstrual/' . $this->input->post('idpaciente'));
    }

    public function actualizarperiodomenstrual()
    {
        $dados = array(
            "id" => $this->input->post('id'),
            "idpaciente" => $this->input->post('idpaciente'),
            "data1" => $this->input->post('data1'),
            "dia" => $this->input->post('dia'),
            "dias" => $this->input->post('dias'),
            "data2" => date('Y-m-d', strtotime('+' . (intval($this->input->post('dias'))) . " days", strtotime($this->input->post('data1')))),
            "descricao" => $this->input->post('descricao'),
        );

        $this->baseperiodomenstrual->actualizar($dados['id'], $dados);


        redirect('clinico/periodomenstrual/' . $this->input->post('idpaciente'));
    }

    public function eliminarperiodomenstrual($valor)
    {
        $this->baseperiodomenstrual->eliminar($valor);
        redirect('clinico/periodomenstrual/' . $_GET['idpaciente']);
    }


    /***************
     * Controlo de Procedimento FIV
     ***************/
    public function cpfiv($id = null)
    {
        $data = array(
            "paciente" => $this->basepaciente->getId($id)[0],
            "fichaclinica" => $this->basefichaclinica->getIdPaciente($id),
            "cpfiv" => $this->basecpfiv->getIdPaciente($id),
        );
        $array = calculate_age_and_months_of_life($data['paciente']->data);
        $data['months_to_birth_day'] = $array['months_to_birth_day'];
        $data['age'] = $array['age'];
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Clinico/CpFiv', $data);
        $this->load->view('include/rodape');
    }

    public function cadastrarcpfiv()
    {
        $dados = array(
            "idpaciente" => $this->input->post('idpaciente'),
            "data" => date('Y-m-d'),
            //S1 - CARACTERÍSTICAS DO CICLO
            "cpfiv_s1_i1" => $this->input->post('cpfiv_s1_i1'),
            "cpfiv_s1_i2" => $this->input->post('cpfiv_s1_i2'),
            "cpfiv_s1_i3" => $this->input->post('cpfiv_s1_i3'),
            "cpfiv_s1_i4" => $this->input->post('cpfiv_s1_i4'),
            "cpfiv_s1_i5" => $this->input->post('cpfiv_s1_i5'),

            //S2 - OBTENÇÃO DE OVÓCITOS
            "cpfiv_s2_i1" => $this->input->post('cpfiv_s2_i1'),
            "cpfiv_s2_i2" => $this->input->post('cpfiv_s2_i2'),
            "cpfiv_s2_i3" => $this->input->post('cpfiv_s2_i3'),
            "cpfiv_s2_i4" => $this->input->post('cpfiv_s2_i4'),

            //S3 - OVÓCITOS RECUPERADOS
            "cpfiv_s3_i2" => $this->input->post('cpfiv_s3_i2'),
            "cpfiv_s3_i3" => $this->input->post('cpfiv_s3_i3'),
            "cpfiv_s3_i4" => $this->input->post('cpfiv_s3_i4'),

            //S4 - SÉMEN
            "cpfiv_s4_i1" => $this->input->post('cpfiv_s4_i1'),
            "cpfiv_s4_i2" => $this->input->post('cpfiv_s4_i2'),
            "cpfiv_s4_i3" => $this->input->post('cpfiv_s4_i3'),
            "cpfiv_s4_i4" => $this->input->post('cpfiv_s4_i4'),
            //Table
            "cpfiv_s4_i5_1_1" => $this->input->post('cpfiv_s4_i5_1_1'),
            "cpfiv_s4_i5_1_2" => $this->input->post('cpfiv_s4_i5_1_2'),
            "cpfiv_s4_i5_2_1" => $this->input->post('cpfiv_s4_i5_2_1'),
            "cpfiv_s4_i5_2_2" => $this->input->post('cpfiv_s4_i5_2_2'),
            "cpfiv_s4_i5_3_1" => $this->input->post('cpfiv_s4_i5_3_1'),
            "cpfiv_s4_i5_3_2" => $this->input->post('cpfiv_s4_i5_3_2'),

            //S5 - OVÓCITOS RECUPERADOS
            "cpfiv_s5_i1" => $this->input->post('cpfiv_s5_i1'),
            "cpfiv_s5_i2" => $this->input->post('cpfiv_s5_i2'),
            "cpfiv_s5_i3" => $this->input->post('cpfiv_s5_i3'),
            "cpfiv_s5_i4" => $this->input->post('cpfiv_s5_i4'),

            //S6 - RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA
            "cpfiv_s6_i1" => $this->input->post('cpfiv_s6_i1'),
            "cpfiv_s6_i2" => $this->input->post('cpfiv_s6_i2'),
            "cpfiv_s6_i3" => $this->input->post('cpfiv_s6_i3'),
            "cpfiv_s6_i4" => $this->input->post('cpfiv_s6_i4'),
            "cpfiv_s6_i5" => $this->input->post('cpfiv_s6_i5'),

        );
        $this->basecpfiv->inserir($dados);
        $idcpfiv = $this->db->insert_id();

        //S3 - OVÓCITOS RECUPERADOS - Table 
        if ($this->input->post('cpfiv_s3_i1_1') != NULL) {

            for ($i = 0; $i < count($this->input->post('cpfiv_s3_i1_1')); $i++) {

                $dados_item = array(
                    "idcpfiv" =>   $idcpfiv,
                    "cpfiv_s3_i1_1" => $this->input->post('cpfiv_s3_i1_1')[$i],
                    "cpfiv_s3_i1_2" => $this->input->post('cpfiv_s3_i1_2')[$i],
                    "cpfiv_s3_i1_3" => $this->input->post('cpfiv_s3_i1_3')[$i],
                    "status" => 1,
                );
                $this->basecpfivitem->inserir($dados_item);
            }
        }
        redirect('clinico/cpfiv/' . $this->input->post('idpaciente') . '?key=1');
    }


    public function actualizarcpfiv()
    {
        $dados = array(
            "id" => $this->input->post('id'),
            "idpaciente" => $this->input->post('idpaciente'),
            "data" => date('Y-m-d'),
            //S1 - CARACTERÍSTICAS DO CICLO
            "cpfiv_s1_i1" => $this->input->post('cpfiv_s1_i1'),
            "cpfiv_s1_i2" => $this->input->post('cpfiv_s1_i2'),
            "cpfiv_s1_i3" => $this->input->post('cpfiv_s1_i3'),
            "cpfiv_s1_i4" => $this->input->post('cpfiv_s1_i4'),
            "cpfiv_s1_i5" => $this->input->post('cpfiv_s1_i5'),

            //S2 - OBTENÇÃO DE OVÓCITOS
            "cpfiv_s2_i1" => $this->input->post('cpfiv_s2_i1'),
            "cpfiv_s2_i2" => $this->input->post('cpfiv_s2_i2'),
            "cpfiv_s2_i3" => $this->input->post('cpfiv_s2_i3'),
            "cpfiv_s2_i4" => $this->input->post('cpfiv_s2_i4'),

            //S3 - OVÓCITOS RECUPERADOS
            "cpfiv_s3_i2" => $this->input->post('cpfiv_s3_i2'),
            "cpfiv_s3_i3" => $this->input->post('cpfiv_s3_i3'),
            "cpfiv_s3_i4" => $this->input->post('cpfiv_s3_i4'),

            //S4 - SÉMEN
            "cpfiv_s4_i1" => $this->input->post('cpfiv_s4_i1'),
            "cpfiv_s4_i2" => $this->input->post('cpfiv_s4_i2'),
            "cpfiv_s4_i3" => $this->input->post('cpfiv_s4_i3'),
            "cpfiv_s4_i4" => $this->input->post('cpfiv_s4_i4'),
            //Table
            "cpfiv_s4_i5_1_1" => $this->input->post('cpfiv_s4_i5_1_1'),
            "cpfiv_s4_i5_1_2" => $this->input->post('cpfiv_s4_i5_1_2'),
            "cpfiv_s4_i5_2_1" => $this->input->post('cpfiv_s4_i5_2_1'),
            "cpfiv_s4_i5_2_2" => $this->input->post('cpfiv_s4_i5_2_2'),
            "cpfiv_s4_i5_3_1" => $this->input->post('cpfiv_s4_i5_3_1'),
            "cpfiv_s4_i5_3_2" => $this->input->post('cpfiv_s4_i5_3_2'),

            //S5 - OVÓCITOS RECUPERADOS
            "cpfiv_s5_i1" => $this->input->post('cpfiv_s5_i1'),
            "cpfiv_s5_i2" => $this->input->post('cpfiv_s5_i2'),
            "cpfiv_s5_i3" => $this->input->post('cpfiv_s5_i3'),
            "cpfiv_s5_i4" => $this->input->post('cpfiv_s5_i4'),

            //S6 - RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA
            "cpfiv_s6_i1" => $this->input->post('cpfiv_s6_i1'),
            "cpfiv_s6_i2" => $this->input->post('cpfiv_s6_i2'),
            "cpfiv_s6_i3" => $this->input->post('cpfiv_s6_i3'),
            "cpfiv_s6_i4" => $this->input->post('cpfiv_s6_i4'),
            "cpfiv_s6_i5" => $this->input->post('cpfiv_s6_i5'),
        );

        $this->basecpfiv->actualizar($dados['id'], $dados);

        //S3 - OVÓCITOS RECUPERADOS - Table 
        $this->basecpfivitem->setStatus($this->input->post('id'), array(
            "idcpfiv" =>  $this->input->post('id'),
            "status" => 0,
        ));


        if ($this->input->post('cpfiv_s3_i1_1') != NULL) {

            for ($i = 0; $i < count($this->input->post('cpfiv_s3_i1_1')); $i++) {

                $dados_item = array(
                    "idcpfiv" =>  $this->input->post('id'),
                    "cpfiv_s3_i1_1" => $this->input->post('cpfiv_s3_i1_1')[$i],
                    "cpfiv_s3_i1_2" => $this->input->post('cpfiv_s3_i1_2')[$i],
                    "cpfiv_s3_i1_3" => $this->input->post('cpfiv_s3_i1_3')[$i],
                    "status" => 1,
                );
                $this->basecpfivitem->inserir($dados_item);
            }
        }


        redirect('clinico/cpfiv/' . $this->input->post('idpaciente') . '?key=1');
    }

    public function eliminarcpfiv($valor)
    {
        $this->basecpfiv->eliminar($valor);
        redirect('clinico/cpfiv/' . $_GET['idpaciente']);
    }


    public function getcpfiv()
    {
        $dados = array();
        foreach ($this->basecpfiv->getIdPaciente($this->input->post("valor")) as $valor) {
            $dados[] = array(
                "id" => $valor->id,
                "data1" => $valor->data1,
                "peso" => $valor->peso,
                "pa" => $valor->pa,
                "pulso" => $valor->pulso,
                "data2" => $valor->data2,
            );
        }
        exit(json_encode($dados));
    }

    /***************
     * IMPRESSÂO
     ***************/

    public function imprimirfichaclinica($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Ficha Clíncia');
        $pdf->SetSubject('Ficha Clíncia');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        //$pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 10, 15, 50, 'JPG');

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->basefichaclinica->getFichaClinica($valor)[0]->imagem, 25, 70, 20, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'FICHA CLÍNICA ', 0, 1,'R');
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5,strtoupper ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        /*$pdf->Cell(130, 5, strtolower(($this->baseinstituicao->getAll()[0]->bairro) .'-'. ($this->baseinstituicao->getAll()[0]->nomemunicipio). ', ANGOLA'), 0, 0);*/
        $pdf->Cell(130, 5, 'Patriota - Luanda, Angola', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        if ($this->basefichaclinica->getFichaClinica($valor)[0]->id != null) {


            $pdf->Cell(189, 10, '', 0, 1);
            $pdf->Cell(100, 10, '', 0, 0);
            $pdf->SetFont('Times', '', 10, '', true);
            $pdf->Cell(89, 5,'Sr(a). '. ($this->basefichaclinica->getFichaClinica($valor)[0]->nome), 0, 1,'R');
            $pdf->SetFont('Times', '', 10, '', true);
            $pdf->Cell(108, 5, '', 0, 0);
            $date_of_birth = $this->basefichaclinica->getFichaClinica($valor)[0]->data;
            $pdf->Cell(81, 5, 'Idade: ' . calculate_age_and_months_of_life($date_of_birth)['age'] . ((calculate_age_and_months_of_life($date_of_birth)['age']  > 1) ? ' Anos' : ' Ano') . ' e ' . calculate_age_and_months_of_life($date_of_birth)['months_to_birth_day'] . ((calculate_age_and_months_of_life($date_of_birth)['months_to_birth_day'] > 1) ? ' Meses' : ' Mês'),0,1,'R');
            $pdf->Cell(109, 5, '', 0, 0);
            $peso_aux = 0;
            foreach ($this->basefichaclinica->getIdPaciente($valor) as $item) {
                $peso_aux = $item->peso;
            }

            $pdf->Cell(80, 5, 'Peso: ' . $peso_aux . ' Kg', 0, 1,'R');
            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFillColor(222, 222, 222);
            $pdf->SetY($pdf->GetY() - 33);
            $pdf->setX(19.9);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Ln(40);
            $pdf->Cell(189, 1, ' DADOS CLÍNICO', 1, 0, 'L', true);
            $pdf->SetFont('Times', '', 10);
            $pdf->Ln(9);
            $pdf->SetFont('Times', 'B', 10);

            $pdf->Cell(5, 5, '#', 0, 0, 'C');
            $pdf->Cell(50, 5, 'Data', 0, 0, 'C');
            $pdf->Cell(20, 5, 'Peso Kg', 0, 0, 'C');
            $pdf->Cell(45, 5, 'P. Arterial', 0, 0, 'C');
            $pdf->Cell(30, 5, 'Pulso', 0, 0, 'C');
            $pdf->Cell(39, 5, 'Proxima Consulta', 0, 1, 'C');

            $pdf->SetFont('Times', '', 10);
            $cont = 1;
            foreach ($this->basefichaclinica->getIdPaciente($valor) as $item) {
                $pdf->Cell(5, 5, $cont++, 0, 0);
                $pdf->Cell(50, 5, date('d-m-Y', strtotime($item->data1)), 0, 0, 'C');
                $pdf->Cell(20, 5, ($item->peso != null) ? $item->peso : 0, 0, 0, 'C');
                $pdf->Cell(45, 5, ($item->pa != null) ? $item->pa . ' mmhg' : 0 . ' mmhg', 0, 0, 'C');
                $pdf->Cell(30, 5, ($item->pulso != null) ? $item->pulso : 0, 0, 0, 'C');
                $pdf->Cell(39, 5, date('d-m-Y', strtotime($item->data2)), 0, 1, 'C');
            }
            $pdf->Ln(9);
            if ($this->input->get('tipo') == 1) {
                foreach ($this->basefichaclinica->getIdPaciente($valor) as $item) {
                    $pdf->SetFont('Times', 'B', 10);
                    $pdf->Cell(189, 5, 'Quadro Clínico - ' . date('d/m/Y', strtotime($item->data1)), 1, 1, 'C');
                    $pdf->SetFont('Times', '', 10);
                    $html = $item->descricao;
                    $pdf->writeHTML($html . '<br><br><br>', true, false, true, false, '');
                }
            }




            /*            $pdf->Cell(189, 5, '', 0, 1);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(189, 5, 'CARDÁPIO ' . $this->basefichaclinica->getFichaClinica($valor)[count($this->basefichaclinica->getFichaClinica($valor)) - 1]->designacaocardapio, 0, 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(189, 5, '', 0, 1); */

            /*        $html = ($this->basefichaclinica->getFichaClinica($valor)[count($this->basefichaclinica->getFichaClinica($valor)) - 1]->descricaocardapio);


            $pdf->writeHTML($html, true, false, true, false, ''); */
        }




        $pdf->Ln((270) - $pdf->GetY());

        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'O Doutor', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        //$pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function imprimirperiodomenstrual($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Periodo Menstrual');
        $pdf->SetSubject('Periodo Menstrual');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        //$pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 15, 15, 60, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'Periodo Menstrual', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);


        if ($this->baseperiodomenstrual->getPeriodoMenstrual($valor)[0]->id != null) {


            $pdf->Cell(189, 10, '', 0, 1);
            $pdf->Cell(100, 10, '', 0, 0);
            $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
            $pdf->SetFont('Times', 'I', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);
            $pdf->Cell(80, 5, ($this->baseperiodomenstrual->getPeriodoMenstrual($valor)[0]->nome), 0, 1);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);

            $pdf->Cell(80, 5, 'IDADE: ' . (intval(date('Y')) - intval(date('Y', strtotime($this->basepaciente->getId($this->baseperiodomenstrual->getPeriodoMenstrual($valor)[0]->idpaciente)[0]->data)))) . ' ANOS', 0, 1);
            $pdf->Cell(109, 5, '', 0, 0);
            $peso_aux = 0;
            foreach ($this->basefichaclinica->getIdPaciente($valor) as $item) {
                $peso_aux = $item->peso;
            }

            $pdf->Cell(80, 5, 'PESO: ' . $peso_aux . ' Kg', 0, 1);
            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFillColor(222, 222, 222);
            $pdf->SetY($pdf->GetY() - 33);
            $pdf->setX(19.9);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Ln(40);
            $pdf->Cell(189, 1, ' DADOS GERAIS', 1, 0, 'L', true);
            $pdf->Ln(9);
            $pdf->SetFont('Times', 'B', 10);

            $html = "";
            $html .=
                "<table>
            <tr>
            <th><b>#</b></th>
            <th><b>Data Da Ultima Menstruação</b></th>
            <th><b>Dias De Duração Da Menstruação</b></th>
            <th><b>Dias De Duração Do Ciclo Menstrual</b></th>
            <th><b>Data Da Proxima Menstruação</b></th>
            </tr>";
            $cont = 1;
            $pdf->SetFont('Times', '', 10);
            foreach ($this->baseperiodomenstrual->getIdPaciente($valor) as $item) {
                $html .= "<tr>
                <td>" .  $cont++ . "</td>
                <td>" . date('d-m-Y', strtotime($item->data1)) . "</td>
                <td>   " . $item->dia . "</td>
                <td>" . $item->dias . "</td>
                <td>" . date('d-m-Y', strtotime($item->data2)) . "</td>
                </tr>";
            }
            $html .= "</table>";


            $pdf->writeHTML($html, true, false, true, false, '');

            $pdf->Ln(20);
            foreach ($this->baseperiodomenstrual->getIdPaciente($valor) as $item) {
                $pdf->Cell(189, 1, ' DADOS DO PERÍODO MENSTRUAL (' . date('d/m/Y', strtotime($item->data2)) . ')', 1, 0, 'L', true);
                $pdf->Ln(9);
                $pdf->SetFont('Times', 'B', 10);

                $html = '';
                $html .=
                    '<table>
                    <tr>
                        <th><b>Ciclo</b></th>
                        <th><b>Data de Inicio</b></th>
                        <th><b>Dias</b></th>
                        <th><b>Data de Termino</b></th>
                        </tr>
                <tbody>';
                $cont = 1;
                $pdf->SetFont('Times', '', 10);
                $data1 = new DateTime(date('d-m-Y', strtotime('+10 days', strtotime($item->data1))));
                $data2 = new DateTime(date('d-m-Y', strtotime('+16 days', strtotime($item->data1))));
                $intervalo1 = $data1->diff($data2)->d + 1;
                $data1 = new DateTime(date('d-m-Y', strtotime('+13 days', strtotime($item->data1))));
                $data2 = new DateTime(date('d-m-Y', strtotime('+14 days', strtotime($item->data1))));
                $intervalo2 = $data1->diff($data2)->d + 1;
                $html .= '<tr style="color:red">
                <td><b>Período Menstrual</b></td>
                <td>' . date('d/m/Y', strtotime($item->data2)) . '</td>
                <td>' . $item->dia . '</td>
                <td>' . date('d/m/Y', strtotime('+' . (intval($item->dia) - 1) . " days", strtotime($item->data2)))  . '</td>
            </tr>
            <tr style="color:green">
                <td><b>Período Fértil</b></td>
                <td>' . date('d/m/Y', strtotime('+10 days', strtotime($item->data1)))  . '</td>
                <td>' . $intervalo1 . '</td>
                <td>' . date('d/m/Y', strtotime('+16 days', strtotime($item->data1))) . '</td>
            </tr>
            <tr style="color:blue">
                <td><b>Ovulação</b></td>
                <td>' . date('d/m/Y', strtotime('+13 days', strtotime($item->data1)))  . '</td>
                <td>' . $intervalo2 . '</td>
                <td>' . date('d/m/Y', strtotime('+14 days', strtotime($item->data1))) . '</td>
            </tr>';

                $html .= '</tbody>
            </table>';
                $pdf->writeHTML($html, true, false, true, false, '');
            }
        }


        $pdf->Ln(40);
        $pdf->Ln((270) - $pdf->GetY());
        if ($pdf->GetY() > 237)
            $pdf->AddPage();

        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'O Doutor', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function imprimirresultadoexame($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Resultado Exame');
        $pdf->SetSubject('Resultado Exame');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        // $pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 15, 15, 60, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(120, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'RESULTADO DE EXAME', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(25, 5, 'Sr.(a).' . $this->abreviarnome(($this->basepaciente->getId($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)[0]->nome)), 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(25, 5, 'Referência Nº ' . $valor, 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 0);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(25, 5,  'IDADE: ' . (intval(date('Y')) - intval(date('Y', strtotime($this->basepaciente->getId($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)[0]->data)))) . ' ANOS', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 0);
        /*$pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);*/
        $pdf->SetFont('Times', 'B', 8, '', true);
        $peso_aux = 0;
        foreach ($this->basefichaclinica->getIdPaciente(($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)) as $item) {
            $peso_aux = $item->peso;
        }
        $pdf->Cell(25, 5,  'PESO: ' . $peso_aux . ' Kg', 0, 1);

        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 0);
        $pdf->Cell(100, 5, 'Data: ' . date('d/m/Y', strtotime($this->baseresultadoexame->listarresultadoexameId($valor)[0]->dataresultadoexame)), 0, 1);


        if (count($this->baseresultadoexame->listarresultadoexameId($valor)) > 0  && count($this->basepaciente->getNdi((isset($_GET['ndi']) == true) ? $_GET['ndi'] : '')) > 0) {
            if ($this->baseresultadoexame->listarresultadoexameId($valor)[0]->id != null) {

                /*   $pdf->SetFont('Times', 'I', 8, '', true);
                $pdf->Cell(189, 5, '', 0, 1);
                $pdf->Cell(100, 5, 'Data: ' . date('d/m/Y', strtotime($this->baseresultadoexame->listarresultadoexameId($valor)[0]->dataresultadoexame)), 0, 0);
                $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
                $pdf->Cell(109, 5, 'Referência Nº ' . $valor, 0, 0);
                $pdf->Cell(80, 5, ($this->basepaciente->getId($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)[0]->nome), 0, 1);
                $pdf->Cell(109, 5, '', 0, 0);
                $pdf->Cell(80, 5, 'IDADE: ' . (intval(date('Y')) - intval(date('Y', strtotime($this->basepaciente->getId($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)[0]->data)))) . ' ANOS', 0, 1);
                $pdf->Cell(109, 5, '', 0, 0);
                $peso_aux = 0;
                foreach ($this->basefichaclinica->getIdPaciente(($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)) as $item) {
                    $peso_aux = $item->peso;
                }
                $pdf->Cell(80, 5, 'PESO: ' . $peso_aux . ' Kg', 0, 1);
                $pdf->Cell(189, 10, '', 0, 1);*/



                $pdf->SetFillColor(222, 222, 222);
                $pdf->SetY($pdf->GetY() - 33);
                $pdf->setX(19.9);
                $pdf->SetFont('Times', 'B', 14);
                $pdf->Ln(40);
                $pdf->Cell(189, 1, 'RESULTADO DE EXAME', 1, 0, 'L', true);
                $pdf->SetFont('Times', '', 12);
                $pdf->Ln(15);
                $pdf->SetFont('Times', 'B', 12);


                $html = "";
                $html .=
                    "<table>
                <tr>
                
                <th><b>EXAME</b></th>
                <th></th>
                <th><b>RESULTADO</b></th>
                <th><b>VALOR DE REFERÊNCIA</b></th>
                </tr><hr>";
                $cont = 1;
                $pdf->SetFont('Times', '', 10);
                $arrayidexame_exameitem = array();
                foreach ($this->baseresultadoexame->listarresultadoexameId($valor) as $item) {
                    if ($item->isexameitem != 1) {
                        $html .= "<tr>
                    <td style='text-align: left;'>" . $item->designacaoexame . "</td>
                    <td style='text-align: left;'></td>
                    <td style='text-align: left;'>" . $item->resultadoexame . "</td>
                    <td style='text-align: left;'>" . $item->valorexame . "</td>
                    </tr><hr>";
                    } else {
                        if (!in_array($item->idexame, $arrayidexame_exameitem)) {
                            array_push($arrayidexame_exameitem, $item->idexame);
                            $html .= "<tr>
                            <td colspan='5'style='text-align: left;'><b>" . $item->designacaoexame . "</b></td>
                            </tr>";
                            foreach ($this->baseexame->getIdExameItemIdGrupo($item->idexame) as $itemgrupo) {
                                $html .= "<tr>
                            <td colspan='5'style='text-align: left;'><b>" . $itemgrupo->designacaogrupoexame  . "</b></td>
                            </tr>";
                                foreach ($this->baseexame->getresultadoexamegrupo($valor, $item->idexame, $itemgrupo->idgrupoexame) as $resultadositem) {
                                    $html .= "<tr>
                                    <td style='text-align: left;'>" . $resultadositem->designacaoitem  . "</td>
                                    <td style='text-align: left;'></td>
                                    <td style='text-align: left;'>" . $resultadositem->resultado  . "</td>
                                    <td style='text-align: left;'>" . $resultadositem->valor  . "</td>
                                    </tr>";
                                }
                            }
                            $html .= "<hr>";
                        }
                    }
                }
                $html .= "</table>";


                $pdf->writeHTML($html, true, false, true, false, '');
            }

            $pdf->Ln((270) - $pdf->GetY());

            $pdf->SetY(237);
            $pdf->SetFont('Times', '', 10, '', true);
            $pdf->Cell(190, 5, 'O/A Técnico', 0, 1, 'C');
            $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
            $pdf->Cell(190, 5, '', 0, 1, 'C');
            $pdf->Cell(190, 5, '', 0, 1, 'C');
            // $pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');
        } else {
            $pdf->SetFont('Times', 'B', 20);
            $pdf->Ln((40));
            $pdf->SetTextColor(255, 0, 0);
            $pdf->Cell(190, 5, 'DADOS INVÁLIDOS', 0, 1, 'C');
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Ln((270) - $pdf->GetY());

            $pdf->SetY(237);
        }



        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function imprimirpedidoexame($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Pedido Exame');
        $pdf->SetSubject('Pedido Exame');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        // $pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 15, 15, 60, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'PEDIDO DE EXAME', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        if ($this->baseexame->listaritempedidoexame($valor)[0]->id != null) {

            $pdf->Cell(189, 10, '', 0, 1);
            $pdf->Cell(100, 10, '', 0, 0);
            $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
            $pdf->SetFont('Times', 'I', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);
            $pdf->Cell(80, 5, ($this->basepaciente->getId($this->baseexame->listaritempedidoexame($valor)[0]->idpaciente)[0]->nome), 0, 1);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);

            $pdf->Cell(80, 5, 'IDADE: ' . (intval(date('Y')) - intval(date('Y', strtotime($this->basepaciente->getId($this->baseexame->listaritempedidoexame($valor)[0]->idpaciente)[0]->data)))) . ' ANOS', 0, 1);
            $pdf->Cell(109, 5, '', 0, 0);

            $peso_aux = 0;
            foreach ($this->basefichaclinica->getIdPaciente(($this->baseresultadoexame->listarresultadoexameId($valor)[0]->idpaciente)) as $item) {
                $peso_aux = $item->peso;
            }

            $pdf->Cell(80, 5, 'PESO: ' . $peso_aux . ' Kg', 0, 1);
            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Data:', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, date('d/m/Y', strtotime($this->baseexame->listaritempedidoexame($valor)[0]->datapedidoexame)), 0, 1);
            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Referência Nº', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, $valor, 0, 1);


            $pdf->SetFillColor(222, 222, 222);
            $pdf->SetY($pdf->GetY() - 33);
            $pdf->setX(19.9);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Ln(40);
            $pdf->Cell(189, 1, 'PEDIDO DE EXAME', 1, 0, 'L', true);
            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(9);
            $pdf->SetFont('Times', 'B', 12);

            $pdf->Cell(5, 5, '#', 0, 0, 'C');
            $pdf->Cell(50, 5, 'Descrição do Exame', 0, 1);

            $pdf->SetFont('Times', '', 10);
            $cont = 1;
            foreach ($this->baseexame->listaritempedidoexame($valor) as $item) {
                $pdf->Cell(5, 5, $cont++, 0, 0);
                $pdf->Cell(50, 5, $item->designacaoexame, 0, 1);
            }

            $pdf->Line(10, $pdf->getY(), 200, $pdf->getY());
        }




        $pdf->Ln((270) - $pdf->GetY());

        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'O Doutor', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        //$pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function imprimir_item_pedidoexame($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Pedido Exame');
        $pdf->SetSubject('Pedido Exame');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        // $pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 15, 15, 60, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'PEDIDO DE EXAME', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        if ($this->baseexame->listaritempedidoexame($valor)[0]->id != null) {

            $pdf->Cell(189, 10, '', 0, 1);
            $pdf->Cell(100, 10, '', 0, 0);
            $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
            $pdf->SetFont('Times', 'I', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);
            $pdf->Cell(80, 5, $this->basepaciente->getId($this->baseexame->listaritempedidoexame($valor)[0]->idpaciente)[0]->nome, 0, 1);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(109, 5, '', 0, 0);
            $pdf->Cell(80, 5, 'IDADE: ' . (intval(date('Y')) - intval(date('Y', strtotime($this->basepaciente->getId($this->baseexame->listaritempedidoexame($valor)[0]->idpaciente)[0]->data)))) . ' ANOS', 0, 1);
            $pdf->Cell(109, 5, '', 0, 0);

            $peso_aux = 0;
            foreach ($this->basefichaclinica->getIdPaciente($this->basepaciente->getId($this->baseexame->listaritempedidoexame($valor)[0]->idpaciente)[0]->id) as $item) {
                $peso_aux = $item->peso;
            }

            $pdf->Cell(80, 5, 'PESO: ' . $peso_aux . ' Kg', 0, 1);
            $pdf->Cell(189, 10, '', 0, 1);

            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Data:', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, date('d/m/Y', strtotime($this->baseexame->listaritempedidoexame($valor)[0]->datapedidoexame)), 0, 1);
            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Referência Nº', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, $valor, 0, 1);


            $pdf->SetFillColor(222, 222, 222);
            $pdf->SetY($pdf->GetY() - 33);
            $pdf->setX(19.9);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Ln(40);
            $pdf->Cell(189, 1, 'PEDIDO DE EXAME', 1, 0, 'L', true);
            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(9);
            $pdf->SetFont('Times', 'B', 12);

            $pdf->Cell(5, 5, '#', 0, 0, 'C');
            $pdf->Cell(50, 5, 'Descrição do Exame', 0, 1);

            $pdf->SetFont('Times', '', 10);
            $cont = 1;
            foreach ($this->baseexame->listaritempedidoexame($valor) as $item) {
                $pdf->Cell(5, 5, $cont++, 0, 0);
                $pdf->Cell(50, 5, $item->designacaoexame, 0, 1);
            }

            $pdf->Line(10, $pdf->getY(), 200, $pdf->getY());
        }




        $pdf->Ln((270) - $pdf->GetY());

        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'O Doutor', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        //$pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "www.sublime.ao ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function imprimirreceita($valor = null)
    {
     $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('RECEITUÁRIO');
        $pdf->SetSubject('RECEITUÁRIO');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        //$pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');


        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 10, 15, 50, 'JPG');

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->basefichaclinica->getFichaClinica($this->basereceita->getIdReceita($valor)[0]->idpaciente)[0]->imagem, 25, 70, 20, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'RECEITUÁRIO ', 0, 1,'R');
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5,strtoupper ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        /*$pdf->Cell(130, 5, strtolower(($this->baseinstituicao->getAll()[0]->bairro) .'-'. ($this->baseinstituicao->getAll()[0]->nomemunicipio). ', ANGOLA'), 0, 0);*/
        $pdf->Cell(130, 5, 'Patriota - Luanda, Angola', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 8, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 8, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

          if ($this->basereceita->getIdReceita($valor)[0]->idreceita != null) {


            $pdf->Cell(189, 10, '', 0, 1);
            $pdf->Cell(100, 10, '', 0, 0);
            $pdf->SetFont('Times', '', 10, '', true);
            $pdf->Cell(89, 5,'Sr(a). '. ($this->abreviarnome($this->basepaciente->getId($this->basereceita->getIdReceita($valor)[0]->idpaciente)[0]->nome)), 0, 1,'R');
            $pdf->SetFont('Times', '', 10, '', true);
            $pdf->Cell(108, 5, '', 0, 0);
            $date_of_birth = $this->abreviarnome($this->basepaciente->getId($this->basereceita->getIdReceita($valor)[0]->idpaciente)[0]->data);
            $pdf->Cell(81, 5, 'Idade: ' . calculate_age_and_months_of_life($date_of_birth)['age'] . ((calculate_age_and_months_of_life($date_of_birth)['age']  > 1) ? ' Anos' : ' Ano') . ' e ' . calculate_age_and_months_of_life($date_of_birth)['months_to_birth_day'] . ((calculate_age_and_months_of_life($date_of_birth)['months_to_birth_day'] > 1) ? ' Meses' : ' Mês'),0,1,'R');
            $pdf->Cell(109, 5, '', 0, 0);
            $peso_aux = 0;
            foreach ($this->basefichaclinica->getIdPaciente($valor) as $item) {
                $peso_aux = $item->peso;
            }

            $pdf->Cell(80, 5, 'Peso: ' . $peso_aux . ' Kg', 0, 1,'R');
            $pdf->Cell(189, 10, '', 0, 1);


            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Data:', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, date('d/m/Y', strtotime($this->basereceita->getIdReceita($valor)[0]->datareceita)), 0, 1);
            $pdf->SetFont('Times', 'B', 12, '', true);
            $pdf->Cell(100, 5, '', 0, 0);
            $pdf->Cell(34, 5, 'Referência Nº', 0, 0);
            $pdf->SetFont('Times', '', 12, '', true);
            $pdf->Cell(55, 5, $valor, 0, 1);


            $pdf->SetFillColor(222, 222, 222);
            $pdf->SetY($pdf->GetY() - 33);
            $pdf->setX(19.9);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Ln(40);
            $pdf->Cell(189, 1, 'RECEITUÁRIO', 1, 0, 'L', true);
            $pdf->SetFont('Times', '', 12);
            $pdf->Ln(9);
            $html = $this->basereceita->getIdReceita($valor)[0]->descricaoreceita;


            $pdf->writeHTML($html, true, false, true, false, '');
        }




        $pdf->Ln((270) - $pdf->GetY());

        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'O Doutor', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        //$pdf->write1DBarcode($valor, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }

    public function relactorioproximaconsulta()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório de Consulta');
        $pdf->SetSubject('Relactório de Consulta');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(194, 10, '', 0, 0);
        $pdf->Cell(70, 7, 'RELACTÓRIO DE CONSULTAS', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(205, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(15, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, date('d/m/Y'), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(205, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, '', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(205, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(277, 20, '', 0, 1);
        $pdf->Cell(277, 5, 'RELACTÓRIO DE CONSULTAS DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 10);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(125, 5, 'Paciente', 1, 0);
        $pdf->Cell(75, 5, 'Última Consulta', 1, 0, 'C');
        $pdf->Cell(72, 5, 'Proxima Consulta', 1, 1, 'C');

        $pdf->SetFont('Times', '', 8);
        $cont = 1;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];


        foreach ($this->basefichaclinica->getFichaClinicaProximaConsulta(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(125, 5, $this->abreviarnome($item->nome), 1, 0);
            $pdf->Cell(75, 5, date('d/m/Y', strtotime($item->data1)), 1, 0, 'C');
            $pdf->Cell(72, 5, date('d/m/Y', strtotime($item->data2)), 1, 1, 'C');
        }
        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }

    public function imprimircpfiv($valor = null)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('CONTROLO DE PROCEDIMENTO FIV');
        $pdf->SetSubject('CONTROLO DE PROCEDIMENTO FIV');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 10, 33, 40, 'JPG');


        $pdf->Ln(10);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(42, 7, '', 0, 0, 'C');
        $pdf->SetFillColor(0, 146, 252);
        $pdf->Cell(150, 7, 'RELATÓRIO DO TRATAMENTO DE PROCRIAÇÃO MEDICAMENTE ASSISTIDA', 0, 1, 'C', true);
        $pdf->Cell(42, 6, '', 0, 0, 'C');

        $pdf->SetFillColor(153, 153, 153);
        $pdf->Cell(25, 6, 'NHC', 0, 0, 'C', true);
        $pdf->Cell(100, 6, 'PACIENTE/S', 0, 0, 'C', true);
        $pdf->Cell(25, 6, 'IDADE', 0, 1, 'C', true);


        $pdf->SetTextColor(0, 0, 0);

        $pdf->Cell(42, 10, '', 0, 0, 'C');
        $pdf->Cell(25, 10, $valor, 1, 0, 'C');
        $pdf->Cell(100, 5, 'Sr(a). ' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->nome, 1, 0, 'L');
        $pdf->Cell(25, 5, intval(date('Y') - date('Y', strtotime($this->basecpfiv->getIdCpFivPaciente($valor)[0]->datapaciente))), 1, 1, 'C');

        $pdf->Cell(42, 5, '', 0, 0, 'C');
        $pdf->Cell(25, 5, '', 0, 0, 'C');
        $pdf->Cell(100, 5,  'Sr(a). ' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->nomeparceiro, 1, 0, 'L');
        $pdf->Cell(25, 5, intval(date('Y') - date('Y', strtotime($this->basecpfiv->getIdCpFivPaciente($valor)[0]->dataparceiropaciente))), 1, 1, 'C');

        $pdf->Ln(20);

        //CARACTERÍSTICAS DO CICLO
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(180, 7, 'CARACTERÍSTICAS DO CICLO', 0, 0, 'L', true);
        $pdf->Cell(9, 7, 'DATA: ' . date('d/m/Y', strtotime($this->basecpfiv->getIdCpFivPaciente($valor)[0]->data)), 0, 1, 'R', true);
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';

        $html .= '<tr>';
        $html .= '<td>Tratamento de PMA</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s1_i1 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Técnica de inseminação ovocitária</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s1_i2 . '</b></td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td >Sémen (origem)</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s1_i3 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td colspan="2" style="heigth=20px;">' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s1_i4 . '</td>';
        $html .= '</tr>';

        $html .= '<br><br>';

        $html .= '<tr>';
        $html .= '<td colspan="2">' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s1_i5 . '</td>';
        $html .= '</tr>';

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        //OBTENÇÃO DE OVÓCITOS
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(189, 7, 'OBTENÇÃO DE OVÓCITOS', 0, 1, 'L', true);
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';

        $html .= '<tr>';
        $html .= '<td>Data</td>';
        $html .= '<td><b>' . date('d/m/Y', strtotime($this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s2_i1)) . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Origem ovócitos</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s2_i2 . '</b></td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td>Nº ovócitos recuperados</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s2_i3 . '</b></td>';
        $html .= '</tr>';



        $html .= '<tr>';
        $html .= '<td>Nº ovócitos desvitrificados / sobrevivem</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s2_i4 . '</b></td>';
        $html .= '</tr>';

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');



        //OVÓCITOS RECUPERADOS
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(189, 7, 'OVÓCITOS RECUPERADOS', 0, 1, 'L', true);
        $pdf->Ln(3);

        $pdf->SetFillColor(153, 153, 153);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(189, 7, 'MICROINJECÇÃO INTRACITOPLASMÁTICA (ICSI)', 0, 1, 'L', true);

        $pdf->Ln(3);
        $pdf->SetFont('Times', '', 11);

        $html = '';
        $html .= '<table style="text-align:center" >';
        $pdf->SetTextColor(255, 255, 255);
        $html .= '<tr bgcolor="#999999" >';
        $html .= ' <th height="15">OVÓCITOS MADUROS</th>';
        $html .= ' <th>OVÓCITOS IMADUROS</th>';
        $html .= ' <th>FECUNDAÇÃO</th>';
        $html .= '</tr>';

        foreach ($this->basecpfivitem->getId($valor) as $cpfivitem) {
            $html .= '<tr style="color:#0092FC;">';
            $html .= ' <td border="1px">' . $cpfivitem->cpfiv_s3_i1_1 . '</td>';
            $html .=  ' <td border="1px">' . $cpfivitem->cpfiv_s3_i1_2 . '</td>';
            $html .=  ' <td border="1px">' . $cpfivitem->cpfiv_s3_i1_3 . '</td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');


        $pdf->Ln(3);
        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';


        $html .= '<tr>';
        $html .= '<td>TOTAL DE OVÓCITOS DESTINADOS A ICSI:</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s3_i2 . '</b></td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td>TOTAL DE OVÓCITOS DESTINADOS A FIV:</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s3_i3 . '</b></td>';
        $html .= '</tr>';



        $html .= '<tr>';
        $html .= '<td>TOTAL DE ZIGOTOS OBTIDOS:</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s3_i4 . '</b></td>';
        $html .= '</tr>';

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');


        //SÉMEN
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(189, 7, 'SÉMEN', 0, 1, 'L', true);
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';

        $html .= '<tr>';
        $html .= '<td>Origem</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i1 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Estado</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i2 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Procedência</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i3 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Tipo de inseminação</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i4 . '</b></td>';
        $html .= '</tr>';


        $html .= '</table>';


        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Ln(3);
        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(189, 7, 'O espermograma no dia punção apresentava os seguintes valores', 0, 1, 'L');

        $pdf->Ln(5);
        $pdf->SetFont('Times', '', 11);

        $html = '';
        $html .= '<table style="text-align:center" >';
        $pdf->SetTextColor(255, 255, 255);
        $html .= '<tr bgcolor="#999999" >';
        $html .= ' <th height="15"></th>';
        $html .= ' <th>PRE-CAPACITAÇÃO</th>';
        $html .= ' <th>PÓS-CAPACITAÇÃO</th>';
        $html .= '</tr>';

        $html .= '<tr style="color:#0092FC;">';
        $html .= ' <td border="1px">Volume ( ml.)</td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_1_1 . '</b></td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_1_2 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr style="color:#0092FC;">';
        $html .= ' <td border="1px">Concentração (milhões/ml)</td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_2_1 . '</b></td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_2_2 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr style="color:#0092FC;">';
        $html .= ' <td border="1px">Mobilidade progressiva (%)</td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_3_1 . '</b></td>';
        $html .=  ' <td border="1px"><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s4_i5_3_2 . '</b></td>';
        $html .= '</tr>';


        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');


        // DIAGNÓSTICO GENÉTICO PREIMPLANTAÇÃO (PGT-A)
        $pdf->Ln(5);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(189, 7, 'DIAGNÓSTICO GENÉTICO PREIMPLANTAÇÃO (PGT-A)', 0, 1, 'L', true);
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';

        $html .= '<tr>';
        $html .= '<td>Indicação</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s5_i1 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Dia da biópsia</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s5_i2 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Embriões informativos</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s5_i3 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Embriões normais/não afectos</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s5_i4 . '</b></td>';
        $html .= '</tr>';


        $html .= '</table>';


        $pdf->writeHTML($html, true, false, true, false, '');


        //RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA
        $pdf->SetFont('Times', 'B', 11);
        $pdf->SetFillColor(0, 146, 252);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(180, 7, ' RESUMO DA TRANSFERÊNCIA EMBRIONÁRIA', 0, 0, 'L', true);
        $pdf->Cell(9, 7, 'DATA: ' . date('d/m/Y', strtotime($this->basecpfiv->getIdCpFivPaciente($valor)[0]->data)), 0, 1, 'R', true);
        $pdf->Ln(3);

        $pdf->SetFont('Times', '', 11);
        $pdf->SetTextColor(0, 146, 252);
        $html = '';
        $html .= '<table>';

        $html .= '<tr>';
        $html .= '<td>Data da transferência</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s6_i1 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Motivo de não ter ocorrido transferência</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s6_i2 . '</b></td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td >Embriões em observação</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s6_i3 . '</b></td>';
        $html .= '</tr>';


        $html .= '<tr>';
        $html .= '<td >Embriões criopreservados</td>';
        $html .= '<td><b>' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s6_i4 . '</b></td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td colspan="2" style="heigth=20px;">' . $this->basecpfiv->getIdCpFivPaciente($valor)[0]->cpfiv_s6_i5 . '</td>';
        $html .= '</tr>';

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Ln((270) - $pdf->GetY());
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetY(237);
        $pdf->SetFont('Times', '', 10, '', true);
        $pdf->Cell(190, 5, 'Diretor(a) do Laboratório', 0, 1, 'C');
        $pdf->Cell(190, 5, '__________________________', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');
        $pdf->Cell(190, 5, '', 0, 1, 'C');



        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode(date('d/m/Y')), 0, 0, 'L');
        $pdf->SetX(110);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Output();
    }
}
