<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class EstatisticaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/EstatisticaModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/AtendimentoModel', 'baseatendimento');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
        $this->load->model('Sistema/SalarioModel', 'basesalario');
        $this->load->model('Sistema/FacturaModel', 'basefactura');
        $this->load->model('Sistema/VendaModel', 'basevenda');
        $this->load->model('Sistema/CompraModel', 'basecompra');
        $this->load->model('Sistema/MesModel', 'basemes');
    }

    //Verificar sessão
    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    public function grafico() {
//        var_dump(exec("getmac"));
        $datainicio = (((date('m') - 1) < 1) ? date('Y-m-1') : date('Y') . '-' . (date('m') - 1) . '-1');
        $datafim = (((date('m') + 1) > 12) ? date('Y-m-1') : date('Y') . '-' . (date('m') + 1) . '-1');

        if (isset($_POST['data'])) {
            $dinicio = explode('-', $this->input->post("data"))[0];
            $dfim = explode('-', $this->input->post("data"))[1];
            $datainicio = (trim(explode('/', $dinicio)[2]) . '-' . trim(explode('/', $dinicio)[1]) . '-' . trim(explode('/', $dinicio)[0]));
            $datafim = (trim(explode('/', $dfim)[2]) . '-' . trim(explode('/', $dfim)[1]) . '-' . trim(explode('/', $dfim)[0]));
       
        }
        
        
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Estatistica/Grafico', $this->dados($datainicio, $datafim));
        $this->load->view('include/rodape');
    }

    public function listagem() {
        //$dados['dados'] = array("correio" => $this->base->getEstatistica());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Estatistica/Listagem');
        $this->load->view('include/rodape');
    }

    public function dados($datainicio, $datafim) {
        $atendimento = ((count($this->baseatendimento->listar()) != null) ? count($this->baseatendimento->listar()) : 0);
        $cliente = ((count($this->basecliente->listar()) != null) ? count($this->basecliente->listar()) : 0);
        $funcionario = ((count($this->basefuncionario->listar()) != null) ? count($this->basefuncionario->listar()) : 0);

        $receita = 0;
        $despesa = 0;
        $venda = 0;
        $compra = 0;
        $salario = 0;
        $referencia = 0;



        //Total Vendas
        foreach ($this->basefactura->getVendaPeriodo($datainicio, $datafim) as $valor) {
            $venda += $valor->total;
        }
        //Total Compras
        foreach ($this->basefactura->getCompraPeriodo($datainicio, $datafim) as $valor) {
            $compra += $valor->total;
        }

        //Total Salarios
        foreach ($this->basesalario->getSalarioPeriodo($datainicio, $datafim) as $valor) {
            $salario += $valor->total;
        }

        $receita = $venda - ($compra + $salario);
        $despesa = ($compra + $salario);
        $referencia = 100000;
        $realtime = ((($receita * 100) / $referencia));

        $dados['dados'] = array(
            "instituicao" => $this->baseinstituicao->getAll(),
            "atendimento" => $atendimento,
            "cliente" => $cliente,
            "funcionario" => $funcionario,
            "receita" => $receita,
            "despesa" => $despesa,
            "venda" => $venda,
            "compra" => $compra,
            "referencia" => $referencia,
            "grafico" => $this->dadosgrafico(explode('-', $datainicio)[1], explode('-', $datafim)[1], explode('-', $datainicio)[0]),
            "realtime" =>'0.'.ceil($realtime),
        );
        return $dados;
    }

    //Graficos
    public function dadosgrafico($mesinicio, $mesfim, $ano) {
        $dados = array();
        $totalvenda = 0;
        $totalcompra = 0;

        for ($i = $mesinicio; $i <= $mesfim; $i++) {
            foreach ($this->basefactura->getVendaGrafico1((($i < 10) ? '0' . $i : $i)) as $valor) {
                $totalvenda += $valor->total;
            }
            foreach ($this->basefactura->getCompraGrafico1((($i < 10) ? '0' . $i : $i)) as $valor) {
                $totalcompra += $valor->total;
            }
            $dados[] = array(
                "totalvenda" => $totalvenda,
                "totalcompra" => $totalcompra,
                "totalreceita" => ($totalvenda - $totalcompra),
                "mes" => $this->basemes->getID($i)[0]->designacao,
                "mesid" => $this->basemes->getID($i)[0]->id,
                "ano" => $ano,
            );
            $totalvenda = 0;
            $totalcompra = 0;
        }
        return $dados;
    }

}
