<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/* Autor: Hilquias Chitazo 19/01/2019 17:12
 * Descrição: Construção da controller Sistema
 */

class ImprimirController extends CI_Controller {

    public function __construct() {
        parent:: __construct();
        $this->verificar_sessao();
        require_once APPPATH . 'third_party/fpdf/fpdf.php';
        $this->load->model('Sistema/FacturaModel', 'base');
        $this->load->model('Sistema/HomeModel', 'basehome');
        $this->load->model('Sistema/ServicoModel', 'baseservico');
        $this->load->model('Sistema/ProdutoModel', 'baseproduto');
        $this->load->model('Sistema/AtendimentoModel', 'baseatendimento');
        $this->load->model('Sistema/InstituicaoModel', 'baseinstituicao');
        $this->load->model('Sistema/FornecedorModel', 'basefornecedor');
    }

    public function verificar_sessao() {
        if ($this->session->userdata('logado') == false) {
            redirect('login');
        }
    }

    public function index() {
//        echo base_url()."assets/media/imagem/".$this->baseinstituicao->getAll()[0]->logotipo;
//        die;
        //A4, margem 10mm, verical (p) horizontal(l)
        $pdf = new FPDF('p', 'mm', 'A4');
        $pdf->AddPage();

        //Cabecalho
        $pdf->SetFont('Arial', 'B', 14);


        //        $pdf->Cell(width, heigth, text, border,end line(01 ), align)
//        $pdf->Image(file,x position, y position, whidth, heigth)
        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 10, 10, 50, 20);


        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 5, 'FACTURA', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(59, 5, '', 0, 1);

        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'Data', 0, 0);
        $pdf->Cell(34, 5, date('d-m-Y'), 0, 1);

        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(25, 5, 'Factura #', 0, 0);
        $pdf->Cell(34, 5, '00001', 0, 1);

        $pdf->Cell(130, 5, '', 0, 0);
        $pdf->Cell(25, 5,  utf8_decode('Código'), 0, 0);
        $pdf->Cell(34, 5, '1', 0, 1);

        $pdf->Cell(189, 0, '', 0, 1);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(189, 5, 'Sublime', 0, 1);
        $pdf->Cell(189, 5, 'Vila Pacifica', 0, 1);
        $pdf->Cell(189, 5, 'Luanda', 0, 1);
        $pdf->Cell(189, 5, 'Telefone 923-058-250', 0, 1);
        $pdf->Cell(189, 5, 'Email: sublime@gmail.com', 0, 1);
        $pdf->Cell(189, 5, 'Contribuinte Nº 123123', 0, 1);

        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->Cell(100, 5, 'Para', 0, 1);

        $pdf->Cell(10, 5, '', 0, 0);
        $pdf->Cell(90, 5, 'Hilquias Chitazo', 0, 1);

//        $pdf->Cell(10, 5, '', 0, 0);
//        $pdf->Cell(90, 5, 'Diverso', 0, 1);
//        $pdf->Cell(10, 5, '', 0, 0);
//        $pdf->Cell(90, 5, 'Endereco', 0, 1);
//
//        $pdf->Cell(10, 5, '', 0, 0);
//        $pdf->Cell(90, 5, 'Telefone', 0, 1);
        //Corpo
        $pdf->Cell(189, 10, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 12);

        $pdf->Cell(69, 5, 'Designacao', 1, 0);
        $pdf->Cell(30, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preco', 1, 0);
        $pdf->Cell(30, 5, 'Quantidade', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1);


        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(69, 5, 'Designacao', 1, 0);
        $pdf->Cell(30, 5, 'Unidade', 1, 0);
        $pdf->Cell(30, 5, 'Preco', 1, 0);
        $pdf->Cell(30, 5, 'Quantidade', 1, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 1, 'R');

        //Corpo-Total
        $pdf->Cell(129, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(26, 5, '0', 1, 1, 'R');

        $pdf->Cell(129, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Imposto', 1, 0);
        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(26, 5, '0', 1, 1, 'R');

        $pdf->Cell(129, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Desconto', 1, 0);
        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(26, 5, '0', 1, 1, 'R');

        $pdf->Cell(129, 5, '', 0, 0);
        $pdf->Cell(30, 5, 'Total', 1, 0);
        $pdf->Cell(4, 5, '$', 1, 0);
        $pdf->Cell(26, 5, '0', 1, 1, 'R');

        //Exibir PDF
        $pdf->Output();
    }

}

//        //A4, margem 10mm, verical (p) horizontal(l)
//        $pdf = new FPDF('p', 'mm', 'A4');
//
//        //Adicionar PDF
//        $pdf->AddPage();
//        
//        //Fonte do Texto
//        $pdf->SetFont('Arial', 'B', 14);
//        
//        Conteudo
//        $pdf->Cell(width, heigth, text, border,end line(01 ), align)
//        $pdf->Image(file,x position, y position, whidth, heigth)
//        
//        //Exibir PDF
//        $pdf->Output();





//$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
//
//        $pdf->SetAuthor('Texugo');
//        $pdf->SetTitle('Recibo de Hilquias');
//        $pdf->SetSubject('Recibo Texugo');
//        $pdf->SetFont('helvetica', '', 11, '', true);
//
//        $pdf->setBarcode(date('Y-m-d H:i:s'));
//        $pdf->AddPage();
//
//        $filepath = base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo;
//        $rre = str_replace(getcwd() . DIRECTORY_SEPARATOR, '', $filepath);
//        $pdf->Image($rre, 20, 8, 22, 'JPG');
//        $filepath1 = base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo;
//        $rre1 = str_replace(getcwd() . DIRECTORY_SEPARATOR, '', $filepath1);
//        $pdf->Image($rre1, 115, 61, 22, 'PNG');
//
//        // Title
//        $pdf->SetFillColor(210, 210, 255);
//        $pdf->SetFont('helvetica', 'B', 35);
//        $pdf->Cell(320, 0, 'D.A.C', 0, 0, 'C');
//
//        $pdf->SetFont('helvetica', 'B', 14);
//        $pdf->SetTextColor(50, 100, 255);
//        $pdf->SetY(15);
//        $pdf->SetX(70.2);
//        $pdf->Cell(30, 1, 'UNIVERSIDADE AGOSTINHO NETO', 0, 0, 'C');
//        $pdf->SetFont('helvetica', 'B', 12);
//        $pdf->SetTextColor(0, 0, 0);
//        $pdf->Ln(6);
//        $pdf->SetX(57.3);
//        $pdf->Cell(30, 1, ' EXAMES DE ACESSO  | ' . date("Y") . ' ', 0, 0, 'C');
//        $pdf->Ln(3);
//        $pdf->SetFont('helvetica', '', 12);
//        $pdf->SetY($pdf->getY() + 3);
//        $pdf->SetX($pdf->getX() + 29);
//        $pdf->Cell(33, 1, 'Recibo Nº 1', 0, 0, 'C');
//        $pdf->SetX($pdf->getX() - 20);
//        $pdf->Ln(3);
//        $y = $pdf->getY();
//        $pdf->Line(43, $y + 3, 190, $y + 3);
//        // End Title
//
//        $pdf->SetFont('helvetica', 'B', 16);
//        $pdf->SetTextColor(0, 0, 0);
//        $pdf->Ln(20);
//        $pdf->SetX(65);
//        $pdf->SetTextColor(255, 0, 0);
//        $pdf->Cell(125, 6, 'ATENÇÃO  ', 0, 0, 'C');
//        $pdf->SetFont('helvetica', 'B', 14);
//        $pdf->Ln(6);
//        $y = $pdf->getY();
//        $pdf->SetTextColor(0, 0, 0);
//        $pdf->SetY($y + 4);
//        $pdf->SetX(64);
//        $pdf->MultiCell(130, 6, 'É obrigatório trazer consigo no dia do seu exame:', 0, 1, 0, 'J');
//        $pdf->Ln(7);
//        $pdf->SetX(80);
//        $pdf->Cell(100, 6, '> Original do documento de identificação  ', 0, 0, 'L');
//        $pdf->Ln(6);
//        $pdf->SetX(80);
//        $pdf->Cell(100, 6, '> Este recibo  ', 0, 0, 'L');
//        $pdf->setX(18);
//
//        $filepath2 = base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo;
//        $tipo = "jpeg";
//
//        $rre2 = str_replace(getcwd() . DIRECTORY_SEPARATOR, '', $filepath2);
//        $pdf->SetY($pdf->GetY() - 18);
//        $pdf->setX(19.9);
//        $pdf->MultiCell(30.2, 35.1, '', 1, 1, 0, 'J');
//        $pdf->Image($rre2, 20, 55, 30, 35, $tipo);
//        $pdf->SetFont('helvetica', 'B', 14);
//        $pdf->Ln(50);
//        $pdf->SetX(18);
//        $pdf->Cell(172, 1, ' DADOS DO CANDIDATO', 0, 0, 'L', true);
//        $pdf->SetFont('helvetica', '', 12);
//        $pdf->Ln(3);
//        $y = $pdf->getY();
//        $pdf->Line(18, $y + 3, 190, $y + 3);
//        $pdf->Ln(6);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Nome Completo', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, 'Hilquias', 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Doc. de Identificação Nº', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, '121121', 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Gênero', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//
//        $pdf->Cell(121, 5, strtoupper("masculino"), 0, 0, 'L');
//
//        $pdf->SetFont('helvetica', 'B', 14);
//        $pdf->SetTextColor(0, 0, 0);
//        $pdf->Ln(15);
//
//        $pdf->SetX(18);
//        $pdf->Cell(172, 1, ' DADOS DA INSCRIÇÃO', 0, 0, 'L', true);
//        $opcao = 0;
//        $pdf->SetFont('helvetica', '', 12);
//        $pdf->Ln(3);
//        $y = $pdf->getY();
//        $pdf->Line(18, $y + 3, 190, $y + 3);
//        $operador = NULL;
//        $taxaActualizacao = FALSE;
//
//
//        $pdf->Ln(7);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Unidade Orgânica', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, 'Hilquias', 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Curso da ' . $opcao . 'ª Opção', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, 'hilquais', 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Período', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, 'Manhã', 0, 0, 'L');
//
//
//        $pdf->Ln(15);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 14);
//        $pdf->Cell(172, 1, ' DADOS DO ATENDIMENTO', 0, 0, 'L', true);
//        $pdf->SetFont('helvetica', '', 12);
//        $pdf->Ln(3);
//        $y = $pdf->getY();
//        $pdf->Line(18, $y + 3, 190, $y + 3);
//        $pdf->Ln(6);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Nome do Operador', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, "Hilquias Chitazo", 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Posto', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//
//        $posto = 123;
//
//
//        $pdf->Cell(121, 5, strtoupper($posto), 0, 0, 'L');
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Valor Pago', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $emolumento = 4444;
//        $pdf->Cell(121, 5, $emolumento . ' AKZ', 0, 0, 'L');
//        if ($taxaActualizacao) {
//            $pdf->Ln(5.01);
//            $pdf->SetX(18);
//            $pdf->SetFont('helvetica', 'B', 10);
//            $pdf->Cell(52, 5, 'Taxa de Actualização', 1, 0, 'R');
//            $pdf->SetX(72);
//            $pdf->SetFont('helvetica', '', 10);
//            $taxa_renovacao = 123;
//            $pdf->Cell(121, 5, $taxa_renovacao . ' AKZ', 0, 0, 'L');
//        }
//        $pdf->Ln(5.01);
//        $pdf->SetX(18);
//        $pdf->SetFont('helvetica', 'B', 10);
//        $pdf->Cell(52, 5, 'Data de Atendimento', 1, 0, 'R');
//        $pdf->SetX(72);
//        $pdf->SetFont('helvetica', '', 10);
//        $pdf->Cell(121, 5, date('d-m-Y'), 0, 0, 'L');
//
//        if ($opcao == 1)
//            $pdf->Ln(30);
//        else
//            $pdf->Ln(22);
//
//        $pdf->SetX(15);
//        $pdf->write1DBarcode('1234', 'C128', '', '', '', 18, 0.39, $this->style, 'N');
//
//        if ($opcao == 1):
//            $y = $pdf->getY();
//            $const = 24;
//            $pdf->Line(19, $y + $const, 193, $y + $const);
//            $pdf->Ln(25);
//            $pdf->SetX(18);
//            $pdf->Cell(30, 5, utf8_decode("* Processado por computador *"), 0, 0, 'L');
//            $pdf->SetX(103);
//            $pdf->Cell(30, 5, "Mais informações:", 0, 0, 'L');
//            $pdf->SetTextColor(50, 150, 255);
//            $pdf->Cell(100, 5, "www.acessouan.com | www.uan.ao ", 0, 0, 'L');
//        else:
//            $y = $pdf->getY();
//            $const = 10;
//            $pdf->Line(19, $y + $const, 190, $y + $const);
//            $pdf->Ln(11);
//            $pdf->SetX(18);
//            $pdf->Cell(30, 5, utf8_decode("* Processado por computador *"), 0, 0, 'L');
//            $pdf->SetX(100);
//            $pdf->Cell(30, 5, "Mais informações:", 0, 0, 'L');
//            $pdf->SetTextColor(50, 150, 255);
//            $pdf->Cell(100, 5, "www.acessouan.com | www.uan.ao ", 0, 0, 'L');
//        endif;
//        $pdf->Output();
//
//
//        die;
//        $pdf = new FPDF('p', 'mm', 'A4');
//        $pdf->AddPage();
//
//        //Cabecalho
//        $pdf->SetFont('Arial', 'B', 14);
//        $pdf->Image(base_url() . "assets/media/imagem/" . $this->baseinstituicao->getAll()[0]->logotipo, 10, 10, 50, 20);
//        $pdf->Cell(130, 5, '', 0, 0);
//        $pdf->Cell(59, 5, 'FACTURA', 0, 1);
//
//        $pdf->SetFont('Arial', '', 12);
//        $pdf->Cell(130, 5, '', 0, 0);
//        $pdf->Cell(59, 5, '', 0, 1);
//
//        $pdf->Cell(130, 5, '', 0, 0);
//        $pdf->Cell(25, 5, 'Data', 0, 0);
//        $pdf->Cell(34, 5, date('d-m-Y'), 0, 1);
//
//        $pdf->Cell(130, 5, '', 0, 0);
//        $pdf->Cell(25, 5, 'Factura #', 0, 0);
//        $pdf->Cell(34, 5, '00001', 0, 1);
//
//        $pdf->Cell(130, 5, '', 0, 0);
//        $pdf->Cell(25, 5, utf8_decode('Código'), 0, 0);
//        $pdf->Cell(34, 5, '1', 0, 1);
//
//        $pdf->Cell(189, 0, '', 0, 1);
//
//        $pdf->SetFont('Arial', '', 12);
//        $pdf->Cell(189, 5, 'Sublime', 0, 1);
//        $pdf->Cell(189, 5, 'Vila Pacifica', 0, 1);
//        $pdf->Cell(189, 5, 'Luanda', 0, 1);
//        $pdf->Cell(189, 5, 'Telefone 923-058-250', 0, 1);
//        $pdf->Cell(189, 5, 'Email: sublime@gmail.com', 0, 1);
//        $pdf->Cell(189, 5, 'Contribuinte Nº 123123', 0, 1);
//
//        $pdf->Cell(189, 10, '', 0, 1);
//        $pdf->Cell(100, 5, 'Para', 0, 1);
//
//        $pdf->Cell(10, 5, '', 0, 0);
//        $pdf->Cell(90, 5, 'Hilquias Chitazo', 0, 1);
//        //Corpo
//        $pdf->Cell(189, 10, '', 0, 1);
//        $pdf->SetFont('Arial', 'B', 12);
//
//        $pdf->Cell(69, 5, 'Designacao', 1, 0);
//        $pdf->Cell(30, 5, 'Unidade', 1, 0);
//        $pdf->Cell(30, 5, 'Preco', 1, 0);
//        $pdf->Cell(30, 5, 'Quantidade', 1, 0);
//        $pdf->Cell(30, 5, 'Subtotal', 1, 1);
//
//
//        $pdf->SetFont('Arial', '', 12);
//        $pdf->Cell(69, 5, 'Designacao', 1, 0);
//        $pdf->Cell(30, 5, 'Unidade', 1, 0);
//        $pdf->Cell(30, 5, 'Preco', 1, 0);
//        $pdf->Cell(30, 5, 'Quantidade', 1, 0);
//        $pdf->Cell(30, 5, 'Subtotal', 1, 1, 'R');
//
//        //Corpo-Total
//        $pdf->Cell(129, 5, '', 0, 0);
//        $pdf->Cell(30, 5, 'Subtotal', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
//        $pdf->Cell(26, 5, '0', 1, 1, 'R');
//
//        $pdf->Cell(129, 5, '', 0, 0);
//        $pdf->Cell(30, 5, 'Imposto', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
//        $pdf->Cell(26, 5, '0', 1, 1, 'R');
//
//        $pdf->Cell(129, 5, '', 0, 0);
//        $pdf->Cell(30, 5, 'Desconto', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
//        $pdf->Cell(26, 5, '0', 1, 1, 'R');
//
//        $pdf->Cell(129, 5, '', 0, 0);
//        $pdf->Cell(30, 5, 'Total', 1, 0);
//        $pdf->Cell(4, 5, '$', 1, 0);
//        $pdf->Cell(26, 5, '0', 1, 1, 'R');
//        $pdf->Output();