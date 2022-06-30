<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Description of incricao_model
 *
 * @author Hilquias Chitazo
 */
class FacturaModel extends CI_Model
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
    }

    //funcao que insere 
    public function inserir($dados)
    {
        if ($this->db->insert('factura', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que lista 
    public function listar()
    {
        return $this->db->query("SELECT * FROM factura")->result();
    }

    //funcao que lista 
    public function listarmax()
    {
        return $this->db->query("SELECT * FROM factura ")->result();
    }

    //funcao que lista 
    public function nfatura()
    {
        return $this->db->query("SELECT id as nfactura FROM factura ORDER BY id DESC LIMIT 1;")->result();
    }

    //função actualizar
    public function actualizar($id, $dados)
    {
        $this->db->where('id', $id);
        if ($this->db->update('factura', $dados)) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao que elimina 
    public function eliminar($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('factura')) {
            return TRUE;
        }
        return FALSE;
    }

    //funcao  GetId
    public function getId($id)
    {
        $this->db->select("*");
        $this->db->from("factura");
        $this->db->where("id = $id");
        return $this->db->get()->result();
    }

    //funcao GetAll
    public function getAll()
    {
        $this->db->select("*");
        $this->db->from("factura");
        $this->db->where("");
        return $this->db->get()->result();
    }

    //funcao GetLike
    public function getLike($valor)
    {
        $this->db->select("*");
        $this->db->from("factura");
        $this->db->where("designacao LIKE '%$valor%' ");
        return $this->db->get()->result();
    }

    //METODOS DA VENDA
    public function getVenda()
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), cliente.nome'cliente', pessoa.nome'funcionario', "
                . "factura.id'idfactura', factura.total'total',factura.data'datafactura',factura.data "
                . "FROM cliente, pessoa, factura, venda "
                . "WHERE pessoa.id=factura.idfuncionario AND cliente.id=factura.idcliente "
                . "AND factura.id=venda.idfactura ORDER BY factura.id DESC"
        )->result();

        return $this->db->get()->result();
    }

    public function getVendaPeriodo($inicio, $fim)
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), factura.id'idfactura', cliente.nome'cliente', "
                . "pessoa.nome'funcionario', factura.data'datafactura', factura.imposto, "
                . "factura.desconto, factura.subtotal, factura.total'total' "
                . "FROM cliente, pessoa, factura, venda "
                . "WHERE pessoa.id=factura.idfuncionario AND cliente.id=factura.idcliente "
                . "AND factura.id=venda.idfactura AND (factura.data >= '$inicio' AND factura.data <= '$fim');"
        )->result();
        return $this->db->get()->result();
    }

    public function getVendaID($valor)
    {
        return $this->db->query(
            "SELECT factura.id'idfactura',cliente.nome'cliente', pessoa.nome'funcionario', 
        factura.subtotal'subtotal',factura.imposto'imposto',factura.desconto'desconto',
        factura.total'total',factura.data'data' 
        FROM cliente, pessoa, factura , venda
        WHERE pessoa.id=factura.idfuncionario 
        AND cliente.id=factura.idcliente
        AND factura.id=$valor AND factura.id=venda.idfactura"
        )->result();
        return $this->db->get()->result();
    }

    public function getDetalheVenda($valor)
    {
        return $this->db->query(
            "SELECT produto.designacao'produto',venda.*
            FROM venda, produto
            WHERE produto.id=venda.idproduto
            AND venda.idfactura=$valor"
        )->result();
        return $this->db->get()->result();
    }

    public function getVendaGrafico1($idmes)
    {
        return $this->db->query(
            "SELECT DISTINCT(venda.idfactura), factura.total ,mes.designacao'mes', factura.data
                        FROM factura, venda, mes
                        WHERE venda.idfactura=factura.id AND mes.id=$idmes AND factura.data LIKE '" . date('Y') . "-$idmes-%' 
                        ORDER BY factura.data ASC"
        )->result();

        return $this->db->get()->result();
    }

    //METODOS DA COMPRA
    public function getCompra()
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id),fornecedor.designacao'fornecedor', pessoa.nome'funcionario', "
                . "factura.id'idfactura', factura.total'total',factura.data'datafactura' "
                . "FROM fornecedor, pessoa, factura, compra "
                . "WHERE pessoa.id=factura.idfuncionario AND fornecedor.id=factura.idfornecedor "
                . "AND factura.id=compra.idfactura ORDER BY factura.id DESC"
        )->result();

        return $this->db->get()->result();
    }

    public function getCompraPeriodo($inicio, $fim)
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), factura.id'idfactura', fornecedor.designacao'fornecedor', "
                . "pessoa.nome'funcionario', factura.data'datafactura', factura.imposto, "
                . "factura.desconto, factura.subtotal, factura.total'total' "
                . "FROM fornecedor, pessoa, factura, compra "
                . "WHERE pessoa.id=factura.idfuncionario AND fornecedor.id=factura.idfornecedor "
                . "AND factura.id=compra.idfactura AND (factura.data >= '$inicio' AND factura.data <= '$fim');"
        )->result();
        return $this->db->get()->result();
    }

    public function getCompraID($valor)
    {
        return $this->db->query(
            "SELECT factura.id'idfactura',fornecedor.designacao'fornecedor', pessoa.nome'funcionario', 
        factura.subtotal'subtotal',factura.imposto'imposto',factura.desconto'desconto',
        factura.total'total',factura.data'data' 
        FROM fornecedor, pessoa, factura, compra 
        WHERE pessoa.id=factura.idfuncionario 
        AND fornecedor.id=factura.idfornecedor
        AND factura.id=$valor AND factura.id=compra.idfactura"
        )->result();
        return $this->db->get()->result();
    }

    public function getDetalheCompra($valor)
    {
        return $this->db->query(
            "SELECT produto.designacao'produto',compra.*
            FROM compra, produto
            WHERE produto.id=compra.idproduto
            AND compra.idfactura=$valor"
        )->result();
        return $this->db->get()->result();
    }

    public function getCompraGrafico1($idmes)
    {
        return $this->db->query(
            "SELECT DISTINCT(compra.idfactura), factura.total ,mes.designacao'mes', factura.data
                        FROM factura, compra, mes
                        WHERE compra.idfactura=factura.id AND mes.id=$idmes AND factura.data LIKE '" . date('Y') . "-$idmes-%' 
                        ORDER BY factura.data ASC"
        )->result();
        return $this->db->get()->result();
    }

    //METODOS DA PAGAMENTO

    public function getPagamento()
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), paciente.nome'paciente', pessoa.nome'funcionario', "
                . "factura.id'idfactura', factura.valorpago, factura.divida, factura.valordivida, factura.subtotal,factura.total'total',factura.data'datafactura', factura.metpag "
                . "FROM paciente, pessoa, factura, pagamento "
                . "WHERE pessoa.id=factura.idfuncionario AND paciente.id=factura.idpaciente "
                . "AND factura.id=pagamento.idfactura ORDER BY factura.id DESC"
        )->result();
        //
        //        return $this->db->query(
        //                        "SELECT DISTINCT(factura.id), cliente.nome'cliente', pessoa.nome'funcionario', "
        //                        . "factura.id'idfactura', factura.total'total',factura.data'datafactura' "
        //                        . "FROM cliente, pessoa, factura, pagamento "
        //                        . "WHERE pessoa.id=factura.idfuncionario AND cliente.id=factura.idcliente "
        //                        . "AND factura.id=pagamento.idfactura ")->result();
    }

    public function getPagamentoPeriodo($inicio, $fim)
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), factura.id'idfactura', paciente.nome'paciente', "
                . "pessoa.nome'funcionario', factura.data'datafactura', factura.imposto, "
                . "factura.desconto, factura.subtotal, factura.valorpago,factura.divida, factura.valordivida, factura.total'total', factura.metpag'metpag'"
                . "FROM paciente, pessoa, factura, pagamento "
                . "WHERE pessoa.id=factura.idfuncionario AND paciente.id=factura.idpaciente "
                . "AND factura.id=pagamento.idfactura AND (factura.data >= '$inicio' AND factura.data <= '$fim');"
        )->result();
        return $this->db->get()->result();
    }

    public function getPagamentoID($valor)
    {
        return $this->db->query(
            "SELECT factura.id'idfactura',paciente.nome'paciente',paciente.telefone'pacientetelefone', pessoa.nome'funcionario', 
        factura.subtotal'subtotal',factura.imposto'imposto',factura.desconto'desconto',
        factura.valorpago, factura.divida,factura.valordivida, factura.total'total',factura.data'data', factura.metpag, factura.nota   
        FROM paciente, pessoa, factura , pagamento
        WHERE pessoa.id=factura.idfuncionario 
        AND paciente.id=factura.idpaciente
        AND factura.id=$valor AND factura.id=pagamento.idfactura"
        )->result();
        return $this->db->get()->result();
    }

    public function getDetalhePagamento($valor)
    {
        return $this->db->query(
            "SELECT servico.designacao'servico',pagamento.*
            FROM pagamento, servico
            WHERE servico.id=pagamento.idservico
            AND pagamento.idfactura=$valor"
        )->result();
        return $this->db->get()->result();
    }

    public function getPagamentoGrafico1($idmes)
    {
        return $this->db->query(
            "SELECT DISTINCT(pagamento.idfactura), factura.total ,mes.designacao'mes'
                        FROM factura, pagamento, mes
                        WHERE pagamento.idfactura=factura.id AND mes.id=$idmes AND factura.data LIKE '" . date('Y') . "-$idmes-%' 
                        ORDER BY factura.data ASC"
        )->result();

        return $this->db->get()->result();
    }

    //METODOS DA PROFORMA

    public function getProforma()
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), paciente.nome'paciente', pessoa.nome'funcionario', "
                . "factura.id'idfactura', factura.valorpago, factura.divida, factura.valordivida, factura.subtotal,factura.total'total',factura.data'datafactura', factura.metpag "
                . "FROM paciente, pessoa, factura, proforma "
                . "WHERE pessoa.id=factura.idfuncionario AND paciente.id=factura.idpaciente "
                . "AND factura.id=proforma.idfactura ORDER BY factura.id DESC"
        )->result();
        //
        //        return $this->db->query(
        //                        "SELECT DISTINCT(factura.id), cliente.nome'cliente', pessoa.nome'funcionario', "
        //                        . "factura.id'idfactura', factura.total'total',factura.data'datafactura' "
        //                        . "FROM cliente, pessoa, factura, proforma "
        //                        . "WHERE pessoa.id=factura.idfuncionario AND cliente.id=factura.idcliente "
        //                        . "AND factura.id=proforma.idfactura ")->result();
    }

    public function getProformaPeriodo($inicio, $fim)
    {
        return $this->db->query(
            "SELECT DISTINCT(factura.id), factura.id'idfactura', paciente.nome'paciente', "
                . "pessoa.nome'funcionario', factura.data'datafactura', factura.imposto, "
                . "factura.desconto, factura.subtotal, factura.valorpago,factura.divida, factura.valordivida, factura.total'total', factura.metpag'metpag'"
                . "FROM paciente, pessoa, factura, proforma "
                . "WHERE pessoa.id=factura.idfuncionario AND paciente.id=factura.idpaciente "
                . "AND factura.id=proforma.idfactura AND (factura.data >= '$inicio' AND factura.data <= '$fim');"
        )->result();
        return $this->db->get()->result();
    }

    public function getProformaID($valor)
    {
        return $this->db->query(
            "SELECT factura.id'idfactura',paciente.nome'paciente',paciente.telefone'pacientetelefone', pessoa.nome'funcionario', 
            factura.subtotal'subtotal',factura.imposto'imposto',factura.desconto'desconto',
            factura.valorpago, factura.divida,factura.valordivida, factura.total'total',factura.data'data', factura.metpag,factura.nota   
            FROM paciente, pessoa, factura , proforma
            WHERE pessoa.id=factura.idfuncionario 
            AND paciente.id=factura.idpaciente
            AND factura.id=$valor AND factura.id=proforma.idfactura"
        )->result();
        return $this->db->get()->result();
    }

    public function getDetalheProforma($valor)
    {
        return $this->db->query(
            "SELECT servico.designacao'servico',proforma.*
                FROM proforma, servico
                WHERE servico.id=proforma.idservico
                AND proforma.idfactura=$valor"
        )->result();
        return $this->db->get()->result();
    }

    public function getProformaGrafico1($idmes)
    {
        return $this->db->query(
            "SELECT DISTINCT(proforma.idfactura), factura.total ,mes.designacao'mes'
                            FROM factura, proforma, mes
                            WHERE proforma.idfactura=factura.id AND mes.id=$idmes AND factura.data LIKE '" . date('Y') . "-$idmes-%' 
                            ORDER BY factura.data ASC"
        )->result();

        return $this->db->get()->result();
    }
}
