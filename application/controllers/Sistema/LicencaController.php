<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class LicencaController extends CI_Controller {

    //Instacia
    public function __construct() {
        parent:: __construct();
        $this->load->model('Sistema/LicencaModel', 'base');

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

    //Nova 
    public function nova() {
        $this->load->view('include/licenca/cabecalho');
        $this->load->view('include/licenca/menu');
        $this->load->view('Sistema/Licenca/Nova');
        $this->load->view('include/licenca/rodape');
    }

    public function email() {
        $this->load->view('include/licenca/cabecalho');
        $this->load->view('include/licenca/menu');
        $this->load->view('Sistema/Licenca/Email');
        $this->load->view('include/licenca/rodape');
    }

    //Licenca
    public function validar() {
        //*****Validar Licença*****
        $url = "http://localhost/sistemagestor/licenca/getlicenca";
        $client = curl_init($url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        $result = json_decode($response);
        if (!empty($result)) {
            foreach ($result as $dados) {
                foreach ($dados as $valor) {
                    if ((strval(trim($this->input->post("codigo"))) == strval(trim($valor->codigo))) && (strval(trim($valor->estado)) == "Activo")) {
                        $this->actualizarlicenca($valor);
                        if ($this->base->validarlicenca()) {
                            redirect($valor->url);
                        } else {
                            redirect('licenca/nova/3');
                        }
                    }
                }
            }

            redirect('licenca/nova/2');
        }
        redirect('licenca/nova/4');
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
        $this->base->actualizar($licenca['id'], $licenca);
    }

    //GETDADOS
    public function getdados() {

        $json = array();
        header('Content-Type: application/json; charset=utf');
        $dados = array();

        $atendimento = ((count($this->baseatendimento->listar()) != null) ? count($this->baseatendimento->listar()) : 0);
        $cliente = ((count($this->basecliente->listar()) != null) ? count($this->basecliente->listar()) : 0);
        $funcionario = ((count($this->basefuncionario->listar()) != null) ? count($this->basefuncionario->listar()) : 0);

        $receita = 0;
        $despesa = 0;
        $venda = 0;
        $compra = 0;
        $salario = 0;

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

        $dados[] = array("software" => "comercial",
            "atendimento" => $atendimento,
            "cliente" => $cliente,
            "funcionario" => $funcionario,
            "venda" => $venda,
            "compra" => $compra,
            "receita" => $receita,
            "despesa" => $despesa,
        );

        $json['dados'] = $dados;
        exit(json_encode($json, JSON_UNESCAPED_UNICODE));
    }

}
