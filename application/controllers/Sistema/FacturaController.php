<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class FacturaController extends CI_Controller
{

    //Funcao que instacia a classe
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        require_once APPPATH . 'third_party/fpdf/fpdf.php';
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
        $this->load->model('Sistema/FacturaModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/FacturaClinicoModel', 'basefacturaclinico');
        $this->load->model('Sistema/ServicoModel', 'baseservico');
        $this->load->model('Sistema/ProdutoModel', 'baseproduto');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
        $this->load->model('Sistema/PacienteModel', 'basepaciente');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/FornecedorModel', 'basefornecedor');
        $this->load->model('Sistema/ProformaModel', 'baseproforma');
        $this->load->model('Sistema/PagamentoModel', 'basepagamento');
        $this->load->model('Sistema/VendaModel', 'basevenda');
        $this->load->model('Sistema/CompraModel', 'basecompra');
        $this->load->model('Sistema/StoqueModel', 'basestoque');
        $this->load->model('Sistema/MesModel', 'basemes');
    }

    public function verificar_sessao()
    {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
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

    public function getservico()
    {
        $dados = array();
        foreach ($this->baseservico->getLike(trim($this->input->post("valor"))) as $valor) {
            $dados[] = array(
                "id" => $valor->id,
                "designacao" => $valor->designacao,
                "descricao" => $valor->descricao,
                "valor" => $valor->valor,
                "imposto" => $valor->imposto,
                "imagem" => $valor->imagem,
            );
        }
        exit(json_encode($dados));
    }

    public function getproduto()
    {
        $dados = array();
        foreach ($this->baseproduto->getLike(trim($this->input->post("valor"))) as $valor) {
            $dados[] = array(
                "id" => $valor->id,
                "designacao" => $valor->designacao,
                "descricao" => $valor->descricao,
                "imposto" => $valor->imposto,
                "preco1" => $valor->preco1,
                "valor" => $valor->preco2,
                "imagem" => $valor->imagem,
            );
        }
        exit(json_encode($dados));
    }

    public function getstoque()
    {
        $dados = array();
        foreach ($this->basestoque->getLikeStoque(trim($this->input->post("valor"))) as $valor) {
            $dados[] = array(
                "idproduto" => $valor->idproduto,
                "stoque" => $valor->stoque,
                "qtdvenda" => $valor->qtdvenda,
                "qtdcompra" => $valor->qtdcompra,
                "data" => $valor->data,
            );
        }
        exit(json_encode($dados));
    }

    public function pagardivida($idfaturaalfa = null)
    {
        if ($this->input->post('valor') > 0) {
            $factura = array(
                "subtotal" => $this->base->getId($idfaturaalfa)[0]->subtotal,
                "imposto" => $this->base->getId($idfaturaalfa)[0]->imposto,
                "desconto" => $this->base->getId($idfaturaalfa)[0]->desconto,
                "valorpago" => $this->input->post("valor"),
                "valordivida" => ($this->base->getId($idfaturaalfa)[0]->valordivida - $this->input->post("valor")),
                "divida" => ($this->base->getId($idfaturaalfa)[0]->valordivida - $this->input->post("valor")),
                "total" => $this->input->post("valor"),
                "data" => $this->input->post("data"),
                "metpag" => $this->input->post("metpag"),
                "idpaciente" => $this->base->getId($idfaturaalfa)[0]->idpaciente,
                "idfuncionario" => $this->base->getId($idfaturaalfa)[0]->idfuncionario,
            );

            if ($this->base->inserir($factura)) {
                $idfactura = $this->db->insert_id();

                $facturaclinico = array(
                    "data1" => $this->basefacturaclinico->getIdFactura($idfaturaalfa)[0]->data1,
                    "dia" => $this->basefacturaclinico->getIdFactura($idfaturaalfa)[0]->dia,
                    "data2" => $this->basefacturaclinico->getIdFactura($idfaturaalfa)[0]->data2,
                    "idfactura" => $idfactura,
                );
                $this->basefacturaclinico->inserir($facturaclinico);


                foreach ($this->basepagamento->getIdFactura($idfaturaalfa) as $itempag) {
                    $pagamento = array(
                        "idservico" => $itempag->idservico,
                        "unidade" => $itempag->unidade,
                        "preco" => $itempag->preco,
                        "qtd" => $itempag->qtd,
                        "imposto" => $itempag->imposto,
                        "subtotal" => $itempag->subtotal,
                        "idfactura" => $idfactura,
                    );
                    $this->basepagamento->inserir($pagamento);
                }
            }
            //bastidores

            $factura = array(
                "id" => $idfaturaalfa,
                "divida" => 0,
            );
            $this->base->actualizar($factura['id'], $factura);

            redirect('factura/listarpagamento/1');
        }
        redirect('factura/listarpagamento/2');
    }

    //METODOS STOQUE
    public function stoque()
    {
        $dados['dados'] = array("stoque" => $this->basestoque->getStoque());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/ListarStoque', $dados);
        $this->load->view('include/rodape');
    }

    //METODOS DE VENDAS
    public function facturavenda()
    {
        $dados['dados'] = array(
            "nfactura" => $this->mecanografico((count($this->base->nfatura()) == null) ? 1 : $this->base->nfatura()[0]->nfactura),
            "produto" => $this->baseproduto->listar(),
            "instituicao" => $this->baseinstituicao->getAll(),
            "cliente" => $this->basecliente->listar()
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/FacturaVenda', $dados);
        $this->load->view('include/rodape');
    }

    public function listarvenda()
    {
        $dados['dados'] = array("facturavenda" => $this->base->getVenda());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/ListarVenda', $dados);
        $this->load->view('include/rodape');
    }

    public function cadastrarvenda()
    {
        if (isset($_POST['salvar'])) {
            try {

                $itemvenda_produto = $this->input->post('itemvenda_produto');
                $itemvenda_unidade = $this->input->post('itemvenda_unidade');
                $itemvenda_preco = $this->input->post('itemvenda_preco');
                $itemvenda_qtd = $this->input->post('itemvenda_qtd');
                $itemvenda_imposto = $this->input->post('itemvenda_imposto');
                $itemvenda_subtotal = $this->input->post('itemvenda_subtotal');
                $subtotal = $this->input->post('subtotal');
                $imposto = $this->input->post('imposto');
                $desconto = $this->input->post('desconto');
                $total = $this->input->post('total');
                $cliente = $this->input->post('cliente');
                $metpag = $this->input->post('metpag');
                $funcionario = $this->session->userdata('id');
                $factura = array(
                    "subtotal" => $subtotal,
                    "imposto" => $imposto,
                    "desconto" => $desconto,
                    "total" => $total,
                    "data" => date('Y-m-d'),
                    "metpag" => $metpag,
                    "idcliente" => $cliente,
                    "idfuncionario" => $funcionario,
                );

                if ($this->base->inserir($factura)) {
                    $idfactura = $this->db->insert_id();
                    for ($i = 0; $i < count($itemvenda_produto); $i++) {
                        //Venda
                        $venda = array(
                            "idproduto" => $itemvenda_produto[$i],
                            "unidade" => $itemvenda_unidade[$i],
                            "preco" => $itemvenda_preco[$i],
                            "qtd" => $itemvenda_qtd[$i],
                            "imposto" => $itemvenda_imposto[$i],
                            "subtotal" => $itemvenda_subtotal[$i],
                            "idfactura" => $idfactura,
                        );
                        $this->basevenda->inserir($venda);
                        //Stoque
                        $this->basestoque->insertupdate($itemvenda_produto[$i], $itemvenda_qtd[$i], 'venda');
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

    //Eliminar
    public function eliminarvenda($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('factura/listarvenda/1');
        } else {
            redirect('factura/listarvenda/2');
        }
    }

    public function imprimirvenda($valor)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Factura de Venda');
        $pdf->SetSubject('Factura de Venda');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        //$pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 8, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'FACTURA DE VENDA', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, date('d/m/Y', strtotime($this->base->getVendaID($valor)[0]->data)), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, 'Documento Nº', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, $this->mecanografico($this->base->getVendaID($valor)[0]->idfactura), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 5, 'PARA', 0, 1);
        $pdf->SetFont('Times', 'I', 12, '', true);
        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, ($this->base->getVendaID($valor)[0]->cliente), 0, 1);

        $pdf->SetFillColor(222, 222, 222);

        // End Title

        $pdf->SetY($pdf->GetY() - 18);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(189, 1, ' DADOS DA VENDA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(50, 5, 'Designação', 1, 0);
        $pdf->Cell(20, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preço Unitário', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(24, 5, 'Quant.', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalheVenda($valor) as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(50, 5, $item->produto, 1, 0);
            $pdf->Cell(20, 5, $item->unidade, 1, 0);
            $pdf->Cell(30, 5, number_format($item->preco, 2, ',', '.') . ' (AKZ)', 1, 0);
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.') . ' (AKZ)', 1, 0);
            $pdf->Cell(24, 5, $item->qtd, 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');
        }

        //Corpo-Total
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Subtotal', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getVendaID($valor)[0]->subtotal, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Imposto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getVendaID($valor)[0]->imposto, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Desconto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getVendaID($valor)[0]->desconto, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Total', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getVendaID($valor)[0]->total, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(15);
        $pdf->write1DBarcode($this->base->getVendaID($valor)[0]->idfactura, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

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
        $pdf->Cell(30, 5, "Operador: " . $this->base->getVendaID($valor)[0]->funcionario, 0, 0, 'L');

        $pdf->Output();
    }

    //METODOS DE COMPRA
    public function facturacompra()
    {
        $dados['dados'] = array(
            "nfactura" => $this->base->nfatura(),
            "produto" => $this->baseproduto->listar(),
            "instituicao" => $this->baseinstituicao->getAll(),
            "fornecedor" => $this->basefornecedor->listar(),
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/FacturaCompra', $dados);
        $this->load->view('include/rodape');
    }

    public function listarcompra()
    {
        $dados['dados'] = array("facturacompra" => $this->base->getCompra());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/ListarCompra', $dados);
        $this->load->view('include/rodape');
    }

    public function cadastrarcompra()
    {
        if (isset($_POST['salvar'])) {
            try {

                $itemcompra_produto = $this->input->post('itemcompra_produto');
                $itemcompra_unidade = $this->input->post('itemcompra_unidade');
                $itemcompra_preco = $this->input->post('itemcompra_preco');
                $itemcompra_qtd = $this->input->post('itemcompra_qtd');
                $itemcompra_imposto = $this->input->post('itemcompra_imposto');
                $itemcompra_subtotal = $this->input->post('itemcompra_subtotal');
                $subtotal = $this->input->post('subtotal');
                $imposto = $this->input->post('imposto');
                $desconto = $this->input->post('desconto');
                $total = $this->input->post('total');
                $metpag = $this->input->post('metpag');
                $fornecedor = $this->input->post('fornecedor');
                $funcionario = $this->session->userdata('id');
                $factura = array(
                    "subtotal" => $subtotal,
                    "imposto" => $imposto,
                    "desconto" => $desconto,
                    "total" => $total,
                    "data" => date('Y-m-d'),
                    "metpag" => $metpag,
                    "idfornecedor" => $fornecedor,
                    "idfuncionario" => $funcionario,
                );

                if ($this->base->inserir($factura)) {
                    $idfactura = $this->db->insert_id();
                    for ($i = 0; $i < count($itemcompra_produto); $i++) {
                        $compra = array(
                            "idproduto" => $itemcompra_produto[$i],
                            "unidade" => $itemcompra_unidade[$i],
                            "preco" => $itemcompra_preco[$i],
                            "qtd" => $itemcompra_qtd[$i],
                            "imposto" => $itemcompra_imposto[$i],
                            "subtotal" => $itemcompra_subtotal[$i],
                            "idfactura" => $idfactura,
                        );
                        $this->basecompra->inserir($compra);

                        //Stoque
                        $this->basestoque->insertupdate($itemcompra_produto[$i], $itemcompra_qtd[$i], 'compra');
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

    //Eliminar
    public function eliminarcompra($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('factura/listarcompra/1');
        } else {
            redirect('factura/listarcompra/2');
        }
    }

    public function imprimircompra($valor)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Factura de Compra');
        $pdf->SetSubject('Factura de Compra');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        //$pdf->Image(base_url() . "assets/media/imagem/original.png", 10, 40, 189, 'JPG');

        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 8, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'FACTURA DE COMPRA', 0, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nome), 0, 0);
        $pdf->Cell(25, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, date('d/m/Y', strtotime($this->base->getCompraID($valor)[0]->data)), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, ($this->baseinstituicao->getAll()[0]->nomemunicipio) . ', ANGOLA', 0, 0);
        $pdf->Cell(25, 5, 'Documento Nº', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(34, 5, $this->mecanografico($this->base->getCompraID($valor)[0]->idfactura), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(130, 5, 'Telefone: ' . ($this->baseinstituicao->getAll()[0]->telefone), 0, 1);
        $pdf->Cell(130, 5, 'Email: ' . mb_strtolower($this->baseinstituicao->getAll()[0]->email), 0, 1);
        $pdf->Cell(130, 5, 'C. Postal: ' . ($this->baseinstituicao->getAll()[0]->cpostal), 0, 1);
        $pdf->Cell(130, 5, 'Contribuinte Nº ' . ($this->baseinstituicao->getAll()[0]->nif), 0, 1);

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 5, 'DE', 0, 1);
        $pdf->SetFont('Times', 'I', 12, '', true);
        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, ($this->base->getCompraID($valor)[0]->fornecedor), 0, 1);

        $pdf->SetFillColor(222, 222, 222);

        // End Title

        $pdf->SetY($pdf->GetY() - 18);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(189, 1, ' DADOS DA COMPRA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(50, 5, 'Designação', 1, 0);
        $pdf->Cell(20, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preço Unitário', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(24, 5, 'Quant.', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalheCompra($valor) as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(50, 5, $item->produto, 1, 0);
            $pdf->Cell(20, 5, $item->unidade, 1, 0);
            $pdf->Cell(30, 5, number_format($item->preco, 2, ',', '.') . ' (AKZ)', 1, 0);
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.') . ' (AKZ)', 1, 0);
            $pdf->Cell(24, 5, $item->qtd, 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');
        }

        //Corpo-Total
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Subtotal', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getCompraID($valor)[0]->subtotal, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Imposto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getCompraID($valor)[0]->imposto, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Desconto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getCompraID($valor)[0]->desconto, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Total', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getCompraID($valor)[0]->total, 2, ',', '.') . ' (AKZ)', 1, 1, 'R');

        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(15);
        $pdf->write1DBarcode($this->base->getCompraID($valor)[0]->idfactura, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

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
        $pdf->Cell(30, 5, "Operador: " . $this->base->getCompraID($valor)[0]->funcionario, 0, 0, 'L');

        $pdf->Output();
    }

    //METODOS DE PAGAMENTO
    public function facturapagamento($valor = null)
    {
        $dados['dados'] = array(
            "nfactura" => $this->mecanografico((count($this->base->nfatura()) == null) ? 1 : $this->base->nfatura()[0]->nfactura),
            "servico" => $this->baseservico->listar(),
            "instituicao" => $this->baseinstituicao->getAll(),
            "paciente" => $this->basepaciente->getId($valor),
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/FacturaPagamento', $dados);
        $this->load->view('include/rodape');
    }

    public function listarpagamento()
    {
        $dados['dados'] = array("facturapagamento" => $this->base->getPagamento());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/ListarPagamento', $dados);
        $this->load->view('include/rodape');
    }

    public function cadastrarpagamento()
    {
        if (isset($_POST['salvar'])) {
            try {

                $itempagamento_servico = $this->input->post('itempagamento_servico');
                $itempagamento_unidade = $this->input->post('itempagamento_unidade');
                $itempagamento_preco = $this->input->post('itempagamento_preco');
                $itempagamento_qtd = $this->input->post('itempagamento_qtd');
                $itempagamento_imposto = $this->input->post('itempagamento_imposto');
                $itempagamento_subtotal = $this->input->post('itempagamento_subtotal');
                $subtotal = $this->input->post('subtotal');
                $imposto = $this->input->post('imposto');
                $desconto = $this->input->post('desconto');
                $total = $this->input->post('total');
                $valorpago = $this->input->post('valorpago');
                $valordivida = $this->input->post('valordivida');
                $metpag = $this->input->post('metpag');
                $nota = $this->input->post('nota');
                $dia = $this->input->post('dia');
                $data2 = $this->input->post('data2');
                $paciente = $this->input->post('paciente');
                $funcionario = $this->session->userdata('id');
                date_default_timezone_set('Africa/Luanda');
                $factura = array(
                    "subtotal" => $subtotal,
                    "imposto" => $imposto,
                    "desconto" => $desconto,
                    "valorpago" => $valorpago,
                    "divida" => $valordivida,
                    "valordivida" => $valordivida,
                    "total" => $total,
                    "data" => date('Y-m-d H:m:s'),
                    "metpag" => $metpag,
                    "nota" => $nota,
                    "idpaciente" => $paciente,
                    "idfuncionario" => $funcionario,
                );



                if ($this->base->inserir($factura)) {
                    $idfactura = $this->db->insert_id();
                    $facturaclinico = array(
                        "data1" => date('Y-m-d'),
                        "dia" => $dia,
                        "data2" => date('Y-m-d', strtotime($data2)),
                        "idfactura" => $idfactura,
                    );
                    $this->basefacturaclinico->inserir($facturaclinico);

                    for ($i = 0; $i < count($itempagamento_servico); $i++) {
                        $pagamento = array(
                            "idservico" => $itempagamento_servico[$i],
                            "unidade" => $itempagamento_unidade[$i],
                            "preco" => $itempagamento_preco[$i],
                            "qtd" => $itempagamento_qtd[$i],
                            "imposto" => $itempagamento_imposto[$i],
                            "subtotal" => $itempagamento_subtotal[$i],
                            "idfactura" => $idfactura,
                        );
                        $this->basepagamento->inserir($pagamento);
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

    //Eliminar
    public function eliminarpagamento($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('factura/listarpagamento/1');
        } else {
            redirect('factura/listarpagamento/2');
        }
    }

    public function imprimirpagamento($valor)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Factura de Pagamento');
        $pdf->SetSubject('Factura de Pagamento');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'FACTURA ', 0, 1);
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

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 10, '', 0, 0);
        $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
        $pdf->SetFont('Times', 'I', 12, '', true);
        $pdf->Cell(109, 5, '', 0, 0);
        $pdf->Cell(80, 5, ($this->base->getPagamentoID($valor)[0]->paciente), 0, 1);
        $pdf->Cell(109, 5, '', 0, 0);
        $pdf->Cell(80, 5, ($this->base->getPagamentoID($valor)[0]->pacientetelefone), 0, 1);
        $pdf->Cell(189, 10, '', 0, 1);

        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(34, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(55, 5, date('d/m/Y H:m:s', strtotime($this->base->getPagamentoID($valor)[0]->data)), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(34, 5, 'Documento Nº', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(55, 5, $this->mecanografico($this->base->getPagamentoID($valor)[0]->idfactura), 0, 1);

        //Clínico
        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(222, 222, 222);
        $pdf->Cell(10, 5, 'Nª', 0, 0, 'C', true);
        $pdf->Cell(40, 5, 'Data do Inicio', 0, 0, 'C', true);
        $pdf->Cell(20, 5, 'Dias', 0, 0, 'C', true);
        $pdf->Cell(40, 5, 'Data do Término', 0, 0, 'C', true);
        $pdf->Cell(54, 5, 'Forma de Pagamento', 0, 0, 'C', true);
        $pdf->Cell(30, 5, 'Valor', 0, 1, 'C', true);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(10, 5, $this->basefacturaclinico->getIdFactura($valor)[0]->id, 0, 0, 'C');
        $pdf->Cell(40, 5, date('d-m-Y', strtotime($this->basefacturaclinico->getIdFactura($valor)[0]->data1)), 0, 0, 'C');
        $pdf->Cell(20, 5, $this->basefacturaclinico->getIdFactura($valor)[0]->dia, 0, 0, 'C');
        $pdf->Cell(40, 5, date('d-m-Y', strtotime($this->basefacturaclinico->getIdFactura($valor)[0]->data2)), 0, 0, 'C');
        $pdf->Cell(54, 5, $this->base->getPagamentoID($valor)[0]->metpag, 0, 0, 'C');
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->subtotal, 2, ',', '.') . ' (AKZ)', 0, 1, 'C');


        // End Title

        $pdf->SetFillColor(222, 222, 222);
        $pdf->SetY($pdf->GetY() - 33);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(189, 1, ' DADOS DO PAGAMENTO', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 0, 0);
        $pdf->Cell(50, 5, 'Designação', 0, 0);
        $pdf->Cell(20, 5, 'Unidade', 0, 0);
        $pdf->Cell(30, 5, 'Valor', 0, 0);
        $pdf->Cell(30, 5, 'Imposto', 0, 0);
        $pdf->Cell(24, 5, 'Quant.', 0, 0, 'C');
        $pdf->Cell(30, 5, 'Subtotal', 0, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalhePagamento($valor) as $item) {
            $pdf->Cell(5, 5, $cont++, 0, 0);
            (strlen($item->servico) > 20) ?  $pdf->SetFont('Times', '', 7) :  $pdf->SetFont('Times', '', 10);
            $pdf->Cell(50, 5, $item->servico, 0, 0);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(20, 5, $item->unidade, 0, 0);
            $pdf->Cell(30, 5, number_format($item->preco, 2, ',', '.') . ' (AKZ)', 0, 0);
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.') . ' (AKZ)', 0, 0);
            $pdf->Cell(24, 5, $item->qtd, 0, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.') . ' (AKZ)', 0, 1, 'R');
        }
        $pdf->Cell(189, (5 * (8 - $cont)), '', 0, 1);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(189, 5, 'COORDENADAS BANCÁRIAS: ', 0, 1);
        //Corpo-Total
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(135, 5, 'BANCO BAI, Nº CONTA: 152342010 10 001', 0, 0);
        $pdf->Cell(24, 5, 'Subtotal', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, 'IBAM: AO06 0040 0000 5234 2010 1016 5', 0, 0);
        $pdf->Cell(24, 5, 'Pago', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->valorpago, 2, ',', '.'), 1, 1, 'R');


        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Imposto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Desconto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Dívida', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->valordivida, 2, ',', '.'), 1, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Total', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getPagamentoID($valor)[0]->total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln(9);
		$pdf->SetFont('Times', 'B', 10);
		$pdf->Cell(20, 5, 'TERMOS E CONDIÇÕES:', 0, 1);
		$pdf->SetFont('Times', '', 10);
		$pdf->MultiCell(150, 5, $this->base->getPagamentoID($valor)[0]->nota, 0, 1);

        $pdf->Cell(190, 5, '', 0, 1);
        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(20);
        $pdf->Cell(190, 5, 'Assinatura', 0, 1);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->SetX(20);
        $pdf->Cell(190, 5, '_____________________________', 0, 1);

        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(170);
        $pdf->write1DBarcode($this->base->getPagamentoID($valor)[0]->idfactura, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Cell(30, 5, "Operador: " . $this->base->getPagamentoID($valor)[0]->funcionario, 0, 0, 'L');
        $pdf->Output();
    }


    //METODOS DE PROFORMA
    public function facturaproforma($valor = null)
    {
        $dados['dados'] = array(
            "nfactura" => $this->mecanografico((count($this->base->nfatura()) == null) ? 1 : $this->base->nfatura()[0]->nfactura),
            "servico" => $this->baseservico->listar(),
            "instituicao" => $this->baseinstituicao->getAll(),
            "paciente" => $this->basepaciente->getId($valor),
        );
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/FacturaProforma', $dados);
        $this->load->view('include/rodape');
    }

    public function listarproforma()
    {
        $dados['dados'] = array("facturaproforma" => $this->base->getProforma());
        $this->load->view('include/cabecalho');
        $this->load->view('include/menu');
        $this->load->view('Sistema/Factura/ListarProforma', $dados);
        $this->load->view('include/rodape');
    }

    public function cadastrarproforma()
    {
        if (isset($_POST['salvar'])) {
            try {

                $itemproforma_servico = $this->input->post('itemproforma_servico');
                $itemproforma_unidade = $this->input->post('itemproforma_unidade');
                $itemproforma_preco = $this->input->post('itemproforma_preco');
                $itemproforma_qtd = $this->input->post('itemproforma_qtd');
                $itemproforma_imposto = $this->input->post('itemproforma_imposto');
                $itemproforma_subtotal = $this->input->post('itemproforma_subtotal');
                $subtotal = $this->input->post('subtotal');
                $imposto = $this->input->post('imposto');
                $desconto = $this->input->post('desconto');
                $total = $this->input->post('total');
                $valorpago = $this->input->post('valorpago');
                $valordivida = $this->input->post('valordivida');
                $metpag = $this->input->post('metpag');
                $nota = $this->input->post('nota');
                $dia = $this->input->post('dia');
                $data2 = $this->input->post('data2');
                $paciente = $this->input->post('paciente');
                $funcionario = $this->session->userdata('id');
                date_default_timezone_set('Africa/Luanda');
                $factura = array(
                    "subtotal" => $subtotal,
                    "imposto" => $imposto,
                    "desconto" => $desconto,
                    "valorpago" => $valorpago,
                    "divida" => $valordivida,
                    "valordivida" => $valordivida,
                    "total" => $total,
                    "data" => date('Y-m-d H:m:s'),
                    "metpag" => $metpag,
                    "nota" => $nota,
                    "idpaciente" => $paciente,
                    "idfuncionario" => $funcionario,
                );



                if ($this->base->inserir($factura)) {
                    $idfactura = $this->db->insert_id();
                    $facturaclinico = array(
                        "data1" => date('Y-m-d'),
                        "dia" => $dia,
                        "data2" => date('Y-m-d', strtotime($data2)),
                        "idfactura" => $idfactura,
                    );
                    $this->basefacturaclinico->inserir($facturaclinico);

                    for ($i = 0; $i < count($itemproforma_servico); $i++) {
                        $proforma = array(
                            "idservico" => $itemproforma_servico[$i],
                            "unidade" => $itemproforma_unidade[$i],
                            "preco" => $itemproforma_preco[$i],
                            "qtd" => $itemproforma_qtd[$i],
                            "imposto" => $itemproforma_imposto[$i],
                            "subtotal" => $itemproforma_subtotal[$i],
                            "idfactura" => $idfactura,
                        );
                        $this->baseproforma->inserir($proforma);
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

    //Eliminar
    public function eliminarproforma($valor)
    {
        if ($this->base->eliminar($valor) == TRUE) {
            redirect('factura/listarproforma/1');
        } else {
            redirect('factura/listarproforma/2');
        }
    }

    public function imprimirproforma($valor)
    {
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf->SetAuthor('Sublime');
        $pdf->SetTitle('Factura de Proforma');
        $pdf->SetSubject('Factura de Proforma');
        $pdf->AddPage();
        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 7, 'FACTURA PROFORMA', 0, 1);
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

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 10, '', 0, 0);
        $pdf->Cell(89, 5, 'EXMO.(a) Sr.(a).', 0, 1);
        $pdf->SetFont('Times', 'I', 12, '', true);
        $pdf->Cell(109, 5, '', 0, 0);
        $pdf->Cell(80, 5, ($this->base->getProformaID($valor)[0]->paciente), 0, 1);
        $pdf->Cell(109, 5, '', 0, 0);
        $pdf->Cell(80, 5, ($this->base->getProformaID($valor)[0]->pacientetelefone), 0, 1);
        $pdf->Cell(189, 10, '', 0, 1);

        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(34, 5, 'Data:', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(55, 5, date('d/m/Y H:m:s', strtotime($this->base->getProformaID($valor)[0]->data)), 0, 1);
        $pdf->SetFont('Times', 'B', 12, '', true);
        $pdf->Cell(100, 5, '', 0, 0);
        $pdf->Cell(34, 5, 'Documento Nº', 0, 0);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->Cell(55, 5,'FACPRO'. $this->base->getProformaID($valor)[0]->idfactura, 0, 1);

        //Clínico
        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(222, 222, 222);
        $pdf->Cell(10, 5, 'Nª', 0, 0, 'C', true);
        $pdf->Cell(40, 5, 'Data do Inicio', 0, 0, 'C', true);
        $pdf->Cell(20, 5, 'Dias', 0, 0, 'C', true);
        $pdf->Cell(40, 5, 'Data do Término', 0, 0, 'C', true);
        $pdf->Cell(54, 5, 'Forma de Proforma', 0, 0, 'C', true);
        $pdf->Cell(30, 5, 'Valor', 0, 1, 'C', true);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(10, 5, $this->basefacturaclinico->getIdFactura($valor)[0]->id, 0, 0, 'C');
        $pdf->Cell(40, 5, date('d-m-Y', strtotime($this->basefacturaclinico->getIdFactura($valor)[0]->data1)), 0, 0, 'C');
        $pdf->Cell(20, 5, $this->basefacturaclinico->getIdFactura($valor)[0]->dia, 0, 0, 'C');
        $pdf->Cell(40, 5, date('d-m-Y', strtotime($this->basefacturaclinico->getIdFactura($valor)[0]->data2)), 0, 0, 'C');
        $pdf->Cell(54, 5, $this->base->getProformaID($valor)[0]->metpag, 0, 0, 'C');
        $pdf->Cell(30, 5, number_format($this->base->getProformaID($valor)[0]->subtotal, 2, ',', '.') . ' (AKZ)', 0, 1, 'C');


        // End Title

        $pdf->SetFillColor(222, 222, 222);
        $pdf->SetY($pdf->GetY() - 33);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(189, 1, ' DADOS DO PROFORMA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 0, 0);
        $pdf->Cell(50, 5, 'Designação', 0, 0);
        $pdf->Cell(20, 5, 'Unidade', 0, 0);
        $pdf->Cell(30, 5, 'Valor', 0, 0);
        $pdf->Cell(30, 5, 'Imposto', 0, 0);
        $pdf->Cell(24, 5, 'Quant.', 0, 0, 'C');
        $pdf->Cell(30, 5, 'Subtotal', 0, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;
        foreach ($this->base->getDetalheProforma($valor) as $item) {
            $pdf->Cell(5, 5, $cont++, 0, 0);
            (strlen($item->servico) > 20) ?  $pdf->SetFont('Times', '', 7) :  $pdf->SetFont('Times', '', 10);
            $pdf->Cell(50, 5, $item->servico, 0, 0);
            $pdf->SetFont('Times', '', 10);
            $pdf->Cell(20, 5, $item->unidade, 0, 0);
            $pdf->Cell(30, 5, number_format($item->preco, 2, ',', '.') . ' (AKZ)', 0, 0);
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.') . ' (AKZ)', 0, 0);
            $pdf->Cell(24, 5, $item->qtd, 0, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.') . ' (AKZ)', 0, 1, 'R');
        }
        $pdf->Cell(189, (5 * (8 - $cont)), '', 0, 1);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(189, 5, 'COORDENADAS BANCÁRIAS: ', 0, 1);
        //Corpo-Total
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(135, 5, 'BANCO BAI, Nº CONTA: 152342010 10 001', 0, 0);
        $pdf->Cell(24, 5, 'Subtotal', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getProformaID($valor)[0]->subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, 'IBAM: AO06 0040 0000 5234 2010 1016 5', 0, 0);
        $pdf->Cell(24, 5, 'Imposto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getProformaID($valor)[0]->imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Desconto', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getProformaID($valor)[0]->desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(135, 5, '', 0, 0);
        $pdf->Cell(24, 5, 'Total', 1, 0);
        //        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(30, 5, number_format($this->base->getProformaID($valor)[0]->total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln(9);
		$pdf->SetFont('Times', 'B', 10);
		$pdf->Cell(20, 5, 'TERMOS E CONDIÇÕES:', 0, 1);
		$pdf->SetFont('Times', '', 10);
		$pdf->MultiCell(150, 5, $this->base->getProformaID($valor)[0]->nota, 0, 1);

        
        $pdf->Cell(190, 5, '', 0, 1);
        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(20);
        $pdf->Cell(190, 5, 'Assinatura', 0, 1);
        $pdf->SetFont('Times', '', 12, '', true);
        $pdf->SetX(20);
        $pdf->Cell(190, 5, '_____________________________', 0, 1);

        $pdf->Ln((253) - $pdf->GetY());
        $pdf->SetX(170);
        $pdf->write1DBarcode($this->base->getProformaID($valor)[0]->idfactura, 'C128', '', '', '', 12, 0.39, $this->style, 'N');

        $pdf->SetFont('Times', '', 10);
        $pdf->Line(19, $pdf->getY(), 193, $pdf->getY());
        $pdf->SetX(18);
        $pdf->Cell(30, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->SetX(84);
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com", 0, 1, 'L');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetX(18);
        $pdf->Cell(30, 5, "Operador: " . $this->base->getProformaID($valor)[0]->funcionario, 0, 0, 'L');
        $pdf->Output();
    }
}
