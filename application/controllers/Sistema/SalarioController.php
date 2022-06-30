<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class SalarioController extends CI_Controller {

//Funcao que instacia a classe
    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
        $this->load->model('Sistema/SalarioModel', 'base');
        $this->load->model('Sistema/SalarioSubDescModel', 'basesalario_sub_desc');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
        $this->load->model('Sistema/Sub_DescModel', 'basesub_desc');
        $this->load->model('Sistema/MesModel', 'basemes');
    }

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    public function mecanografico($valor) {
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

    public function getitem() {
        $dados = array();
        foreach ($this->basesub_desc->getLike(trim($this->input->post("valor"))) as $valor) {
            $dados[] = array("id" => $valor->id,
                "designacao" => $valor->designacao,
                "valor" => $valor->valor,
                "descricao" => $valor->descricao,
            );
        }
        exit(json_encode($dados));
    }

    public function getsalario() {
        $dados = array();
        foreach ($this->basefuncionario->getId(trim($this->input->post("valor"))) as $valor) {
            $dados[] = array("id" => $valor->idfuncionario,
                "salario" => $valor->salario,
                "irt" => $this->salarioimposto($valor->salario)["irt"],
                "ssocial" => $this->salarioimposto($valor->salario)["ssocial"],
            );
        }
        exit(json_encode($dados));
    }

    public function nova() {
        $dados['dados'] = array(
            "nfactura" => $this->mecanografico((count($this->base->nfatura()) == null) ? 1 : $this->base->nfatura()[0]->nfactura),
            "instituicao" => $this->baseinstituicao->getAll(),
            "funcionario" => $this->basefuncionario->getAll(),
            "subcidio" => $this->basesub_desc->getSubcidio(),
            "desconto" => $this->basesub_desc->getDesconto(),
            "mes" => $this->basemes->listar(),
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Salario/Nova', $dados);
        $this->load->view('include/rodape');
    }

    public function listar() {
        $dados['dados'] = array("salario" => $this->base->getSalario());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Salario/Listar', $dados);
        $this->load->view('include/rodape');
    }

    public function eliminar($valor) {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('salario/listar/1');
        } else {
            redirect('salario/listar/2');
        }
    }

    public function cadastrar() {
        if (isset($_POST['salvar'])) {
            try {

                $funcionario = $this->input->post('funcionario');
                $operador = $this->session->userdata('id');
                $mes = $this->input->post('mes');

                $subcidios = $this->input->post('subcidios');
                $descontos = $this->input->post('descontos');

                $subtotal = $this->input->post('subtotal');
                $salario = $this->input->post('salario');
                $irt = $this->input->post('irt');
                $ssocial = $this->input->post('ssocial');
                $subcidio = $this->input->post('subcidio');
                $desconto = $this->input->post('desconto');
                $total = $this->input->post('total');

                $salario = array(
                    "subtotal" => $subtotal,
                    "salario" => $salario,
                    "irt" => $irt,
                    "ssocial" => $ssocial,
                    "subcidio" => $subcidio,
                    "desconto" => $desconto,
                    "total" => $total,
                    "idmes" => $mes,
                    "data" => date('Y-m-d'),
                    "idoperador" => $operador,
                    "idfuncionario" => $funcionario,
                );

                if ($this->base->inserir($salario)) {
                    $idsalario = $this->db->insert_id();
                    if ($subcidios != null) {
                        for ($i = 0; $i < count($subcidios[0]); $i++) {
                            $sub_desc = array(
                                "idsubdesc" => $subcidios[0][$i],
                                "unidade" => $subcidios[1][$i],
                                "preco" => $subcidios[2][$i],
                                "qtd" => $subcidios[3][$i],
                                "subtotal" => $subcidios[4][$i],
                                "tipo" => 'subcidio',
                                "idsalario" => $idsalario,
                            );
                            $this->basesalario_sub_desc->inserir($sub_desc);
                        }
                    }
                    if ($descontos != null) {
                        for ($i = 0; $i < count($descontos[0]); $i++) {
                            $sub_desc = array(
                                "idsubdesc" => $descontos[0][$i],
                                "unidade" => $descontos[1][$i],
                                "preco" => $descontos[2][$i],
                                "qtd" => $descontos[3][$i],
                                "subtotal" => $descontos[4][$i],
                                "tipo" => 'desconto',
                                "idsalario" => $idsalario,
                            );
                            $this->basesalario_sub_desc->inserir($sub_desc);
                        }
                    }
                    exit(json_encode(array('valor' => 1)));
                }
                exit(json_encode(array('valor' => 0)));
            } catch (Exception $exc) {
                exit(json_encode(array('valor' => 0)));
            }
        }
        exit(json_encode(array('valor' => 0)));
    }

    public function imprimir($valor) {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Factura de Venda');
        $pdf->SetSubject('Factura de Venda');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/original.jpg", 10, 40, 189, 'JPG');

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 8, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130,10, '', 0, 0);
        $pdf->Cell(59, 7, 'FOLHA SALARIAL', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, date('d/m/Y', strtotime($this->base->getSalarioID($valor)[0]->datasalario)), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, 'Factura Nº', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, $this->mecanografico($this->base->getSalarioID($valor)[0]->idsalario), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 0);
        $pdf->Cell(25, 5, 'Referente à:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, ($this->base->getSalarioID($valor)[0]->mes), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 5, 'PARA', 0, 1);
        $pdf->SetFont('Times', 'I', 12, '', true);
        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, ($this->base->getSalarioID($valor)[0]->funcionario), 0, 1);

        $pdf->SetFillColor(222, 222, 222);

        // End Title
        //Subcidios
        $pdf->SetY($pdf->GetY() - 18);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(189, 1, 'SUBSÍDIOS', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(80, 5, 'Designação', 1, 0);
        $pdf->Cell(20, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preço Unitário', 1, 0);
        $pdf->Cell(24, 5, 'Quant.', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalhe($valor, 'subcidio') as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(80, 5, $item->designacao, 1, 0);
            $pdf->Cell(20, 5, $item->unidade, 1, 0);
            $pdf->Cell(30, 5, $item->preco . '.00 (AKZ)', 1, 0);
            $pdf->Cell(24, 5, $item->qtd, 1, 0, 'C');
            $pdf->Cell(30, 5, $item->subtotal . '.00 (AKZ)', 1, 1, 'R');
        }

        //Descontos
        $pdf->SetY($pdf->GetY());
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(10);
        $pdf->Cell(189, 1, 'DESCONTOS', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(80, 5, 'Designação', 1, 0);
        $pdf->Cell(20, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preço Unitário', 1, 0);
        $pdf->Cell(24, 5, 'Quant.', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalhe($valor, 'desconto') as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(80, 5, $item->designacao, 1, 0);
            $pdf->Cell(20, 5, $item->unidade, 1, 0);
            $pdf->Cell(30, 5, $item->preco . '.00 (AKZ)', 1, 0);
            $pdf->Cell(24, 5, $item->qtd, 1, 0, 'C');
            $pdf->Cell(30, 5, $item->subtotal . '.00 (AKZ)', 1, 1, 'R');
        }

//      Corpo-Total
        $pdf->Ln((200) - $pdf->GetY());
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());

        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Subtotal', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->subtotal) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Salário', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->salario) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'IRT', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->irt) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'S. Social', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->ssocial) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Subsídios', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->subcidio) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Desconto', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->desconto) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Total', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, ($this->base->getSalarioID($valor)[0]->total) . '.00(AKZ)', 1, 1, 'R');

        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(15);
        $pdf->write1DBarcode($this->base->getSalarioID($valor)[0]->idsalario, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

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
        $pdf->Cell(30, 5, "Operador: " . $this->base->getOperador($valor)[0]->operador, 0, 0, 'L');

        $pdf->Output();
    }

    public function salarioimposto($salario) {
        $irt = 0;
        $ssocial = ($salario * 0.03);
        $parcela = 0;
        $taxa = 0;
        $excesso = 0;

        if ($salario <= 34450)
            $irt = $taxa;
        else if ($salario >= 34451 && $salario <= 35000) {
            $parcela = 0;
            $taxa = 0;
            $excesso = 34450;
//            $irt = ((($salario - ($salario * 0.03))) - $parcela);
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 35001 && $salario <= 40000) {
            $parcela = 550;
            $taxa = 0.07;
            $excesso = 35000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 40001 && $salario <= 45000) {
            $parcela = 900;
            $taxa = 0.08;
            $excesso = 40000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 45001 && $salario <= 50000) {
            $parcela = 1300;
            $taxa = 0.09;
            $excesso = 45000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 50001 && $salario <= 70000) {
            $parcela = 1750;
            $taxa = 0.1;
            $excesso = 50000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 70001 && $salario <= 90000) {
            $parcela = 3750;
            $taxa = 0.11;
            $excesso = 70000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 90001 && $salario <= 110000) {
            $parcela = 5950;
            $taxa = 0.12;
            $excesso = 90000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 110001 && $salario <= 140000) {
            $parcela = 8350;
            $taxa = 0.13;
            $excesso = 110000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 140001 && $salario <= 170000) {
            $parcela = 12250;
            $taxa = 0.14;
            $excesso = 140000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 170001 && $salario <= 200000) {
            $parcela = 16450;
            $taxa = 0.15;
            $excesso = 170000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 200001 && $salario <= 230000) {
            $parcela = 20950;
            $taxa = 0.16;
            $excesso = 200000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        } else if ($salario >= 230001) {
            $parcela = 25750;
            $taxa = 0.17;
            $excesso = 230000;
            $irt = ((($salario - ($salario * 0.03)) - $excesso) * $taxa + $parcela);
        }
        return $dados = array("irt" => $irt, "ssocial" => $ssocial);
    }

}
