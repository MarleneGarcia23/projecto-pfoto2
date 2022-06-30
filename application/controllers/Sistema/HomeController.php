<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class HomeController extends CI_Controller {

    //Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        $this->load->model('Sistema/HomeModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/AtendimentoModel', 'baseatendimento');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
        $this->load->model('Sistema/PacienteModel', 'basepaciente');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
        $this->load->model('Sistema/SalarioModel', 'basesalario');
        $this->load->model('Sistema/FacturaModel', 'basefactura');
        $this->load->model('Sistema/VendaModel', 'basevenda');
        $this->load->model('Sistema/CompraModel', 'basecompra');
        $this->load->model('Sistema/MesModel', 'basemes');
    }

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    //Funcao inicial
    public function index() {
        if ($this->basehome->getModulo($this->session->userdata('id'), 'PAINEL') != null) {
            $atendimento = ((count($this->basefactura->getPagamentoPeriodo(date('Y-m-1'),date('Y-m-31'))) != null) ? count($this->basefactura->getPagamentoPeriodo(date('Y-m-1'),date('Y-m-31'))) : 0);
            $paciente = ((count($this->basepaciente->listar()) != null) ? count($this->basepaciente->listar()) : 0);
            $funcionario = ((count($this->basefuncionario->listar()) != null) ? count($this->basefuncionario->listar()) : 0);

            $receita = 0;
            $despesa = 0;
            $venda = 0;
            $compra = 0;
            $salario = 0;
            $referencia = 0;



			foreach ($this->basefactura->getPagamentoPeriodo(date('Y-m-1'),date('Y-m-31')) as $valor) {
                $venda += $valor->total;
            }
            //Total Vendas
            foreach ($this->basefactura->getVendaPeriodo(date('Y-m-1'),date('Y-m-31')) as $valor) {
//$venda += $valor->total;
            }
            //Total Compras
            foreach ($this->basefactura->getCompraPeriodo(date('Y-m-1'),date('Y-m-31')) as $valor) {
                $compra += $valor->total;
            }

            //Total Salarios
            foreach ($this->basesalario->getSalarioPeriodo(date('Y-m-1'),date('Y-m-31')) as $valor) {
                $salario += $valor->total;
            }

            $receita = $venda - ($compra + $salario);
            $despesa = ($compra + $salario);
            $referencia = 100000;

            $dados['dados'] = array(
                "instituicao" => $this->baseinstituicao->getAll(),
                "atendimento" => $atendimento,
                "paciente" => $paciente,
                "funcionario" => $funcionario,
                "receita" => $venda,
                "despesa" => $despesa,
                "venda" => $venda,
                "compra" => $compra,
                "referencia" => $referencia,
                "grafico1" => $this->grafico1(),
            );
            $this->load->view('include/cabecalho');
            $this->load->view('include/menu');
            $this->load->view('Sistema/Home', $dados);
            $this->load->view('include/rodape');
        } else {
            redirect('calendario/calendario');
        }
    }

    //Contadores
    public function contchat() {
        exit(json_encode($this->basehome->getContMensagem("mensagem", $this->session->userdata('id'))[0]->cont));
    }

    public function conttarefa() {
        exit(json_encode($this->basehome->getContTarefa("tarefa", $this->session->userdata('id'))[0]->cont));
    }

    public function contevento() {
        exit(json_encode($this->basehome->getContEvento("evento")[0]->cont));
    }

    public function realtime_receita() {
        $receita = 0;
        $despesa = 0;
        $venda = 0;
        $compra = 0;
        $salario = 0;
        $referencia = 0;



        //Total Vendas
        foreach ($this->basefactura->getVenda() as $valor) {
            $venda += $valor->total;
        }
        //Total Compras
        foreach ($this->basefactura->getCompra() as $valor) {
            $compra += $valor->total;
        }

        //Total Salarios
        foreach ($this->basesalario->listar() as $valor) {
            $salario += $valor->total;
        }


        $receita = $venda - ($compra + $salario);
        $despesa = ($compra + $salario);
        $referencia = 100000;
        $dados = array(strval(number_format(($receita * 100 / $referencia) / 10, 2)));
        exit(json_encode($dados[0]));
    }

    //Graficos
    public function grafico1() {
        $dados = array();
        $totalvenda = 0;
        $totalcompra = 0;

        for ($i = (((date('m') - 1) < 1) ? date('m') : (date('m') - 1)); $i <= (((date('m') + 1) > 12) ? date('m') : (date('m') + 1)); $i++) {
            foreach ($this->basefactura->getVendaGrafico1((($i < 10) ? '0' . $i : $i)) as $valor) {
                $totalvenda += $valor->total;
            }
            foreach ($this->basefactura->getCompraGrafico1((($i < 10) ? '0' . $i : $i)) as $valor) {
                $totalcompra += $valor->total;
            }
            $dados[] = array(
                "totalvenda" => $totalvenda,
                "totalcompra" => $totalcompra,
                "mes" => $this->basemes->getID($i)[0]->designacao,
            );
            $totalvenda = 0;
            $totalcompra = 0;
        }
        return $dados;
    }

}
