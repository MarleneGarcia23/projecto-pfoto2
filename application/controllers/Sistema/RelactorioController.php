<?php

defined('BASEPATH') or exit('No direct script access allowed');
/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class RelactorioController extends CI_Controller
{

    //Funcao que instacia a classe
    public function __construct()
    {
        parent::__construct();
        $this->verificar_sessao();
        require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
        $this->load->model('Sistema/FacturaModel', 'basefactura');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/ServicoModel', 'baseservico');
        $this->load->model('Sistema/ProdutoModel', 'baseproduto');
        $this->load->model('Sistema/ClienteModel', 'basecliente');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/FornecedorModel', 'basefornecedor');
        $this->load->model('Sistema/VendaModel', 'basevenda');
        $this->load->model('Sistema/CompraModel', 'basecompra');
        $this->load->model('Sistema/SalarioModel', 'basesalario');
        $this->load->model('Sistema/SalarioSubDescModel', 'basesalario_sub_desc');
        $this->load->model('Sistema/FuncionarioModel', 'basefuncionario');
        $this->load->model('Sistema/Sub_DescModel', 'basesub_desc');
        $this->load->model('Sistema/MesModel', 'basemes');
    }

    public function verificar_sessao()
    {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
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
    //Diário
    public function relactoriopagamentoperiodo()
    {
        if ($this->input->post("tipo") != null) {
            switch ($this->input->post("tipo")) {
                case '1':
                    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
                    $pdf->SetAuthor('sistemahospitalar');
                    $pdf->SetTitle('Relactório de Pagamento');
                    $pdf->SetSubject('Relactório de Pagamento');
                    $pdf->AddPage();
                    /*     $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');
             */
                    $pdf->SetFont('Times', 'B', 16);
                    $pdf->Cell(194, 10, '', 0, 1);
                    $pdf->Cell(194, 10, '', 0, 0);
                    $pdf->Cell(70, 7, 'RELACTÓRIO PAGAMENTOS', 0, 1);
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
                    $pdf->Cell(277, 5, 'RELACTÓRIO DE PAGAMENTOS DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
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
                    $pdf->Cell(30, 5, 'Nº Factura', 1, 0);
                    $pdf->Cell(54, 5, 'Paciente', 1, 0);
                    $pdf->Cell(40, 5, 'Operador', 1, 0);
                    $pdf->Cell(18, 5, 'Data', 1, 0, 'C');
                    $pdf->Cell(20, 5, 'Subtotal', 1, 0, 'C');
                    $pdf->Cell(20, 5, 'Imposto', 1, 0, 'C');
                    $pdf->Cell(20, 5, 'Desconto', 1, 0, 'C');
                    $pdf->Cell(20, 5, 'Valor Pago', 1, 0, 'C');
                    $pdf->Cell(20, 5, 'Dívida', 1, 0, 'C');
                    $pdf->Cell(30, 5, 'Total', 1, 1, 'C');

                    $pdf->SetFont('Times', '', 8);
                    $cont = 1;

                    //Variaveis 
                    $subtotal = 0;
                    $valorpago = 0;
                    $imposto = 0;
                    $desconto = 0;
                    $divida = 0;
                    $total = 0;

                    //Pagamento
                    $datainicio = explode('-', $this->input->post("data"))[0];
                    $datafim = explode('-', $this->input->post("data"))[1];
                    foreach ($this->basefactura->getPagamentoPeriodo(
                        (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
                        (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
                    )
                        as $item) {
                        $pdf->Cell(5, 5, $cont++, 1, 0);
                        $pdf->Cell(30, 5, $this->mecanografico($item->idfactura), 1, 0);
                        $pdf->Cell(54, 5, $this->abreviarnome($item->paciente), 1, 0);
                        $pdf->Cell(40, 5, $this->abreviarnome($item->funcionario), 1, 0);
                        $pdf->Cell(18, 5, date('d/m/Y', strtotime($item->datafactura)), 1, 0, 'C');
                        $pdf->Cell(20, 5, number_format($item->subtotal, 2, ',', '.'), 1, 0, 'R');
                        $pdf->Cell(20, 5, number_format($item->imposto, 2, ',', '.'), 1, 0, 'R');
                        $pdf->Cell(20, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'R');
                        $pdf->Cell(20, 5, number_format($item->valorpago, 2, ',', '.'), 1, 0, 'R');
                        $pdf->Cell(20, 5, number_format($item->divida, 2, ',', '.'), 1, 0, 'R');
                        $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

                        $subtotal += $item->subtotal;
                        $valorpago += $item->valorpago;
                        $imposto += $item->imposto;
                        $desconto += $item->desconto;
                        $divida += $item->divida;
                        $total += $item->total;
                    }

                    //Corpo-Total
                    $pdf->Cell(277, 10, '', 0, 1);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->Cell(30, 5, 'Subtotal', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Cell(277, 10, '', 0, 1);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->Cell(30, 5, 'Valor Pago', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($valorpago, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(30, 5, 'Dívida', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($divida, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(30, 5, 'Imposto', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(30, 5, 'Desconto', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Cell(217, 5, '', 0, 0);
                    $pdf->SetFont('Times', 'B', 8);
                    $pdf->Cell(30, 5, 'Total', 1, 0);
                    $pdf->SetFont('Times', '', 8);
                    $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

                    $pdf->Ln((183) - $pdf->GetY());
                    $pdf->SetFont('Times', '', 10);
                    $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
                    $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
                    $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
                    $pdf->SetTextColor(50, 150, 255);
                    $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
                    $pdf->Output();
                    break;

                case '2':

                    //Variaveis 
                    $subtotal = 0;
                    $valorpago = 0;
                    $imposto = 0;
                    $desconto = 0;
                    $divida = 0;
                    $total = 0;

                    $html = "";
                    $html .= "<table border='1' >";
                    $html .= "<tr>";
                    $html .= "<th>#</th>";
                    $html .= "<th>Nº Factura</th>";
                    $html .= "<th>Paciente</th>";
                    $html .= "<th>Operador</th>";
                    $html .= "<th>Data</th>";
                    $html .= "<th>Subtotal</th>";
                    $html .= "<th>Imposto</th>";
                    $html .= "<th>Desconto</th>";
                    $html .= "<th>Valor Pago</th>";
                    $html .= "<th>Divida</th>";
                    $html .= "<th>Total</th>";
                    $html .= "</tr>";
                    $cont = 1;
                    $datainicio = explode('-', $this->input->post("data"))[0];
                    $datafim = explode('-', $this->input->post("data"))[1];
                    foreach ($this->basefactura->getPagamentoPeriodo(
                        (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
                        (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
                    )
                        as $item) {
                        $html .= "<tr>";
                        $html .= "<td>" . ($cont++) . "</td>";
                        $html .= "<td>" . $this->mecanografico($item->idfactura) . "</td>";
                        $html .= "<td>" . $this->abreviarnome($item->paciente) . "</td>";
                        $html .= "<td>" . $this->abreviarnome($item->funcionario) . "</td>";
                        $html .= "<td>" . date('d/m/Y', strtotime($item->datafactura)) . "</td>";
                        $html .= "<td style='text-align:right;'>" . number_format($item->subtotal, 2, ',', '.') . "</td>";
                        $html .= "<td style='text-align:right;'>" . number_format($item->imposto, 2, ',', '.') . "</td>";
                        $html .= "<td style='text-align:right;'>" . number_format($item->desconto, 2, ',', '.') . "</td>";
                        $html .= "<td style='text-align:right;'>" .  number_format($item->valorpago, 2, ',', '.') . "</td>";
                        $html .= "<td style='text-align:right;'>" . number_format($item->divida, 2, ',', '.') . "</td>";
                        $html .= "<td style='text-align:right;'><b>" . number_format($item->total, 2, ',', '.') . "</b></td>";
                        $html .= "</tr>";

                        $subtotal += $item->subtotal;
                        $valorpago += $item->valorpago;
                        $imposto += $item->imposto;
                        $desconto += $item->desconto;
                        $divida += $item->divida;
                        $total += $item->total;
                    }
                    $html .= "<tfoot>";
                    $html .= "<tr>";
                    $html .= "<td colspan='11' style='text-align:right;'></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>SUBTOTAL</b></td><td style='text-align:right;'><b>" . number_format($subtotal, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>VALOR PAGO</b></td><td style='text-align:right;'><b>" . number_format($valorpago, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>DÍVIDA</b></td><td style='text-align:right;'><b>" . number_format($divida, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>IMPOSTO</b></td><td><b>" . number_format($imposto, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>DESCONTO</b></td><td style='text-align:right;'><b>" . number_format($desconto, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "<tr>";
                    $html .= "<td colspan='10' style='text-align:right;'><b>TOTAL</b></td><td style='text-align:right;'><b>" . number_format($total, 2, ',', '.') . "</b></td>";
                    $html .= "</tr>";
                    $html .= "</tfoot>";
                    $html .= "  </table>";


                    $arquivo = "arquivo.xls";
                    header('Content-Type: application/xls');
                    header('Content-Disposition: attachment;filename="' . $arquivo . '"');
                    header('Cache-Control: max-age=0');
                    //Se for o IE9, isso talvez seja necessário
                    header('Cache-Control: max-age=1');
                    echo $html;

                    exit;
                    break;
            }
        }
    }

    //Pagamentos
    public function relactoriopagamento()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório de Pagamento');
        $pdf->SetSubject('Relactório de Pagamento');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(194, 10, '', 0, 0);
        $pdf->Cell(70, 7, 'RELACTÓRIO DE PAGAMENTO', 0, 1);
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
        $pdf->Cell(277, 5, 'RELACTÓRIO DE PAGAMENTO DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS DA PAGAMENTO', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(30, 5, 'Nº Factura', 1, 0);
        $pdf->Cell(50, 5, 'Cliente', 1, 0);
        $pdf->Cell(47, 5, 'Operador', 1, 0);
        $pdf->Cell(25, 5, 'Data', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(30, 5, 'Total', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;

        //Variaveis 
        $subtotal = 0;
        $valorpago = 0;
        $valordivida = 0;
        $imposto = 0;
        $desconto = 0;
        $total = 0;
        $paied_in_cash = 0;
        $paied_in_atm = 0;
        $paied_in_transfer = 0;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];
        foreach ($this->basefactura->getPagamentoPeriodo(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(30, 5, $this->mecanografico($item->idfactura), 1, 0);
            $pdf->Cell(50, 5, $this->abreviarnome($item->paciente), 1, 0);
            $pdf->Cell(47, 5, $this->abreviarnome($item->funcionario), 1, 0);
            $pdf->Cell(25, 5, date('d/m/Y', strtotime($item->datafactura)), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

            $subtotal += $item->subtotal;
            $valorpago += $item->valorpago;
            $valordivida += $item->valordivida;
            $imposto += $item->imposto;
            $desconto += (($item->subtotal * $item->desconto) / 100);
            $total += $item->total;

            if ($item->metpag == 'Dinheiro') {
                $paied_in_cash += $item->valorpago;
            } elseif ($item->metpag == 'Multicaixa') {
                $paied_in_atm += $item->valorpago;
            } elseif ($item->metpag == 'Tranferência') {
                $paied_in_transfer += $item->valorpago;
            }
        }

        //Corpo-Total
        $pdf->Cell(277, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Em Dinhero', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_cash, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Por Multic.', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_atm, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Por Transf.', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_transfer, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($valorpago, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Dívida', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($valordivida, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }

    //Proforma
    public function relactorioproforma()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório de Proforma');
        $pdf->SetSubject('Relactório de Proforma');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(194, 10, '', 0, 0);
        $pdf->Cell(70, 7, 'RELACTÓRIO DE PROFORMA', 0, 1);
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
        $pdf->Cell(277, 5, 'RELACTÓRIO DE PROFORMA DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS DA PROFORMA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(30, 5, 'Nº Factura', 1, 0);
        $pdf->Cell(50, 5, 'Cliente', 1, 0);
        $pdf->Cell(47, 5, 'Operador', 1, 0);
        $pdf->Cell(25, 5, 'Data', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(30, 5, 'Total', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;

        //Variaveis 
        $subtotal = 0;
        $valorpago = 0;
        $valordivida = 0;
        $imposto = 0;
        $desconto = 0;
        $total = 0;
        $paied_in_cash = 0;
        $paied_in_atm = 0;
        $paied_in_transfer = 0;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];
        foreach ($this->basefactura->getProformaPeriodo(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(30, 5, $this->mecanografico($item->idfactura), 1, 0);
            $pdf->Cell(50, 5, $this->abreviarnome($item->paciente), 1, 0);
            $pdf->Cell(47, 5, $this->abreviarnome($item->funcionario), 1, 0);
            $pdf->Cell(25, 5, date('d/m/Y', strtotime($item->datafactura)), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

            $subtotal += $item->subtotal;
            $valorpago += $item->valorpago;
            $valordivida += $item->valordivida;
            $imposto += $item->imposto;
            $desconto += (($item->subtotal * $item->desconto) / 100);
            $total += $item->total;

            if ($item->metpag == 'Dinheiro') {
                $paied_in_cash += $item->valorpago;
            } elseif ($item->metpag == 'Multicaixa') {
                $paied_in_atm += $item->valorpago;
            } elseif ($item->metpag == 'Tranferência') {
                $paied_in_transfer += $item->valorpago;
            }
        }

        //Corpo-Total
        $pdf->Cell(277, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Em Dinhero', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_cash, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Por Multic.', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_atm, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago Por Transf.', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($paied_in_transfer, 2, ',', '.'), 1, 1, 'R');
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Pago', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($valorpago, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Dívida', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($valordivida, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }

    public function relactoriosalario()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório Salarial');
        $pdf->SetSubject('Relactório Salarial');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(205, 10, '', 0, 0);
        $pdf->Cell(59, 7, 'RELACTÓRIO SALARIAL', 0, 1);
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
        $pdf->Cell(277, 5, 'RELACTÓRIO SALARIAL DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS SALARIAL', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(67, 5, 'Funcionário', 1, 0);
        $pdf->Cell(30, 5, 'Salario', 1, 0);
        $pdf->Cell(25, 5, 'Referênçia', 1, 0);
        $pdf->Cell(30, 5, 'IRT', 1, 0);
        $pdf->Cell(30, 5, 'S. Social', 1, 0);
        $pdf->Cell(30, 5, 'Subsídio', 1, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(30, 5, 'Total', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;

        //Variaveis 
        $subtotal = 0;
        $salario = 0;
        $irt = 0;
        $ssocial = 0;
        $imposto = 0;
        $subcidio = 0;
        $desconto = 0;
        $total = 0;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];
        foreach ($this->basesalario->getSalarioPeriodo(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(67, 5, $item->funcionario, 1, 0);
            $pdf->Cell(30, 5, number_format($item->salario, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(25, 5, $item->mes, 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->irt, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->ssocial, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->subcidio, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

            //            $subtotal += $item->total;
            $salario += $item->salario;
            $irt += $item->irt;
            $ssocial += $item->ssocial;
            $imposto += ($item->irt + $item->ssocial);
            $subcidio += $item->subcidio;
            $desconto += $item->desconto;
            $total += $item->total;
        }

        //Corpo-Total
        $pdf->Cell(277, 5, '', 0, 1);
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total Salário', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($salario, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total IRT', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($irt, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total S.Social', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($ssocial, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total Imposto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total Subsídio', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($subcidio, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total Desconto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }

    //Compra
    public function relactoriocompra()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório de Compra');
        $pdf->SetSubject('Relactório de Compra');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(205, 10, '', 0, 0);
        $pdf->Cell(59, 7, 'RELACTÓRIO DE COMPRA', 0, 1);
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
        $pdf->Cell(277, 5, 'RELACTÓRIO DE COMPRA DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS DA COMPRA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(30, 5, 'Nº Factura', 1, 0);
        $pdf->Cell(50, 5, 'Fornecedor', 1, 0);
        $pdf->Cell(47, 5, 'Operador', 1, 0);
        $pdf->Cell(25, 5, 'Data', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(30, 5, 'Total', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;

        //Variaveis 
        $subtotal = 0;
        $imposto = 0;
        $desconto = 0;
        $total = 0;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];
        foreach ($this->basefactura->getCompraPeriodo(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(30, 5, $this->mecanografico($item->idfactura), 1, 0);
            $pdf->Cell(50, 5, $this->abreviarnome($item->fornecedor), 1, 0);
            $pdf->Cell(47, 5, $this->abreviarnome($item->funcionario), 1, 0);
            $pdf->Cell(25, 5, date('d/m/Y', strtotime($item->datafactura)), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

            $subtotal += $item->subtotal;
            $imposto += $item->imposto;
            $desconto += (($item->subtotal * $item->desconto) / 100);
            $total += $item->total;
        }

        //Corpo-Total
        $pdf->Cell(277, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }

    //Vendas
    public function relactoriovenda()
    {
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetAuthor('sistemahospitalar');
        $pdf->SetTitle('Relactório de Venda');
        $pdf->SetSubject('Relactório de Venda');
        $pdf->AddPage();
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 20, 20, 22, 'JPG');

        $pdf->SetFont('Times', 'B', 16);
        $pdf->Cell(194, 10, '', 0, 1);
        $pdf->Cell(205, 10, '', 0, 0);
        $pdf->Cell(59, 7, 'RELACTÓRIO DE VENDA', 0, 1);
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
        $pdf->Cell(277, 5, 'RELACTÓRIO DE VENDA DE ' . trim(explode('-', $this->input->post("data"))[0]) . ' Á ' .
            trim(explode('-', $this->input->post("data"))[1]), 0, 1, 'C');
        $pdf->SetFillColor(222, 222, 222);
        // End Title
        $pdf->SetY($pdf->GetY() - 30);
        $pdf->setX(19.9);
        $pdf->SetFont('Times', 'B', 14);
        $pdf->Ln(40);
        $pdf->Cell(277, 1, ' DADOS DA VENDA', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Ln(9);
        $pdf->SetFont('Times', 'B', 12);

        $pdf->Cell(5, 5, '#', 1, 0);
        $pdf->Cell(30, 5, 'Nº Factura', 1, 0);
        $pdf->Cell(50, 5, 'Cliente', 1, 0);
        $pdf->Cell(47, 5, 'Operador', 1, 0);
        $pdf->Cell(25, 5, 'Data', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(30, 5, 'Total', 1, 1);

        $pdf->SetFont('Times', '', 10);
        $cont = 1;

        //Variaveis 
        $subtotal = 0;
        $imposto = 0;
        $desconto = 0;
        $total = 0;

        $datainicio = explode('-', $this->input->post("data"))[0];
        $datafim = explode('-', $this->input->post("data"))[1];
        foreach ($this->basefactura->getVendaPeriodo(
            (trim(explode('/', $datainicio)[2]) . '-' . trim(explode('/', $datainicio)[1]) . '-' . trim(explode('/', $datainicio)[0])),
            (trim(explode('/', $datafim)[2]) . '-' . trim(explode('/', $datafim)[1]) . '-' . trim(explode('/', $datafim)[0]))
        )
            as $item) {
            $pdf->Cell(5, 5, $cont++, 1, 0);
            $pdf->Cell(30, 5, $this->mecanografico($item->idfactura), 1, 0);
            $pdf->Cell(50, 5, $this->abreviarnome($item->cliente), 1, 0);
            $pdf->Cell(47, 5, $this->abreviarnome($item->funcionario), 1, 0);
            $pdf->Cell(25, 5, date('d/m/Y', strtotime($item->datafactura)), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->subtotal, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->imposto, 2, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 5, number_format($item->desconto, 2, ',', '.'), 1, 0, 'C');
            $pdf->Cell(30, 5, number_format($item->total, 2, ',', '.'), 1, 1, 'R');

            $subtotal += $item->subtotal;
            $imposto += $item->imposto;
            $desconto += (($item->subtotal * $item->desconto) / 100);
            $total += $item->total;
        }

        //Corpo-Total
        $pdf->Cell(277, 5, '', 0, 1);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($subtotal, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($imposto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($desconto, 2, ',', '.'), 1, 1, 'R');

        $pdf->Cell(217, 5, '', 0, 0);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(30, 5, number_format($total, 2, ',', '.'), 1, 1, 'R');

        $pdf->Ln((183) - $pdf->GetY());
        $pdf->SetFont('Times', '', 10);
        $pdf->Line(10, $pdf->getY(), 287, $pdf->getY());
        $pdf->Cell(170, 5, utf8_decode("Processado por computador"), 0, 0, 'L');
        $pdf->Cell(33, 5, "Mais informações:", 0, 0, 'L');
        $pdf->SetTextColor(50, 150, 255);
        $pdf->Cell(100, 5, "conexaosublime.com ", 0, 1, 'L');
        $pdf->Output();
    }
}
