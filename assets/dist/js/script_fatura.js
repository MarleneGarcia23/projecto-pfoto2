/***********METODOS DA FATURA DE VENDA***********/
function faturavenda() {
    $('#form-itemvenda').on('submit', function() {

        //Validar Entrada
        var validar = 1;
        $("input[class*='itemvenda-id']").each(function() {
            if (parseInt($(this).val()) == parseInt($('[name=itemvenda-id]').val())) {
                validar = 0;
                var html = '<p class="text-red"><b>Item já Adicionado!</b></p>';
                $('#infostoque').html(html);
            }
        });

        if (($('[name=itemvenda-subtotal]').val() != 0) && (validar)) {

            if ((parseFloat($('[name=stoque]').val()) >= parseFloat($('[name=itemvenda-qtd]').val()))) {

                var id = $('[name=itemvenda-id]').val();
                var designacao = $('[name=itemvenda-designcacao]').val();
                var unidade = $('[name=itemvenda-unidade]').val();
                var preco = $('[name=itemvenda-preco]').val();
                var qtd = $('[name=itemvenda-qtd]').val();
                var imposto = $('[name=itemvenda-imposto]').val();
                var subtotal = $('[name=itemvenda-subtotal]').val();
                var html = '<tr>\n\
                <td><input type="text" class="hidden itemvenda-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm itemvenda-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm itemvenda-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemvenda-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemvenda-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemvenda-imposto" value="' + imposto + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemvenda-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_itemvenda(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
                $('#table-itemvenda tbody').prepend(html);
                $('[name=itemvenda-id]').val(0);
                $('[name=itemvenda-designacao]').val('').focus();
                $('[name=itemvenda-unidade]').val('AOA');
                $('[name=itemvenda-preco]').val('0.00');
                $('[name=itemvenda-imposto]').val('0.00');
                $('[name=itemvenda-qtd]').val('1.00');
                $('[name=itemvenda-subtotal]').val('0.00');

                //Stoque
                var stoque = parseFloat($('[name=stoque]').val());
                var html = '<p class="text-blue"><b>Stoque Actual: ' + stoque + '</b></p>\n\
                <p class="text-red"><b>Stoque Pôs-Venda : ' + (stoque - qtd) + '</b></p>';
                $('#infostoque').html(html);


                //Total
                itemvenda_total();
            } else {
                var html = '<p class="text-red"><b>Stoque Insuficiente!</b></p>';
                $('#infostoque').html(html);
            }

        }
        return false;
    });
}

function getitemvenda() {
    var dados = {
        valor: $('[name=itemvenda-designcacao]').val()
    }
    $.post(base_url + 'factura/getproduto',
        dados,
        function(data) {
            $('[name=itemvenda-id]').val((JSON.parse(data)[0]['id']));
            $('[name=itemvenda-preco]').val((JSON.parse(data)[0]['valor']));
            $('[name=itemvenda-imposto]').val((JSON.parse(data)[0]['imposto']));
        });
    $.post(base_url + 'produto/getstoque',
        dados,
        function(data) {
            $('[name=stoque]').val((JSON.parse(data)[0]['stoque']));
            var html = '<p class="text-blue"><b>Stoque Actual: ' + JSON.parse(data)[0]['stoque'] + '</b></p>';
            $('#infostoque').html(html);
        });
    calcular_itemvendadetalhe();
}

function calcular_itemvendadetalhe() {
    var preco = parseFloat($('[name=itemvenda-preco]').val());
    var qtd = parseFloat($('[name=itemvenda-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=itemvenda-subtotal]').val(resultado);
}

function remove_itemvenda(e) {
    e.parentNode.parentNode.remove();
    itemvenda_total();
}

function itemvenda_total() {

    var arraysubtotal = document.getElementsByClassName('itemvenda-subtotal');
    var arrayimposto = document.getElementsByClassName('itemvenda-imposto');


    var imposto = 0;
    var desconto = 0;
    var subtotal = 0;
    var total = 0;
    if ($('[name=desconto]').val() >= 0 && $('[name=desconto]').val().length != 0) {
        desconto = parseFloat($('[name=desconto]').val());
    }

    for (var i = 0; i < arraysubtotal.length; i++) {
        var value = parseFloat(arraysubtotal[i].value);
        subtotal += value;
    }

    for (var i = 0; i < arrayimposto.length; i++) {
        var value = parseFloat(arrayimposto[i].value);
        imposto += value;
    }
    total = (subtotal + imposto) - ((subtotal * desconto) / 100);
    $('[name=itemvenda-total]').val((subtotal.toFixed(2)));
    $('[name=subtotal]').val((subtotal.toFixed(2)));
    $('[name=imposto]').val((imposto.toFixed(2)));
    $('[name=total]').val((total.toFixed(2)));
}

function salvar_itemvenda() {
    var itemvenda_produto = new Array();
    $("input[class*='itemvenda-id']").each(function() {
        itemvenda_produto.push($(this).val());
    });
    var itemvenda_unidade = new Array();
    $("input[class*='itemvenda-unidade']").each(function() {
        itemvenda_unidade.push($(this).val());
    });
    var itemvenda_preco = new Array();
    $("input[class*='itemvenda-preco']").each(function() {
        itemvenda_preco.push($(this).val());
    });
    var itemvenda_qtd = new Array();
    $("input[class*='itemvenda-qtd']").each(function() {
        itemvenda_qtd.push($(this).val());
    });
    var itemvenda_imposto = new Array();
    $("input[class*='itemvenda-imposto']").each(function() {
        itemvenda_imposto.push($(this).val());
    });
    var itemvenda_subtotal = new Array();
    $("input[class*='itemvenda-subtotal']").each(function() {
        itemvenda_subtotal.push($(this).val());
    });

    var data = 'action=itemvenda_produto=' + itemvenda_produto;
    if ($('[name=total]').val() != 0) {
        $.ajax({
            url: base_url + 'factura/cadastrarvenda',
            type: 'POST',
            dataType: 'html', //JSON
            data: {
                cliente: $('[name=cliente]').val(),
                itemvenda_produto: itemvenda_produto,
                itemvenda_unidade: itemvenda_unidade,
                itemvenda_preco: itemvenda_preco,
                itemvenda_qtd: itemvenda_qtd,
                itemvenda_imposto: itemvenda_imposto,
                itemvenda_subtotal: itemvenda_subtotal,
                subtotal: $('[name=subtotal]').val(),
                imposto: $('[name=imposto]').val(),
                desconto: $('[name=desconto]').val(),
                total: $('[name=total]').val(),
                metpag: $('[name=metpag]').val(),
                salvar: 'salvar'
            },
            beforeSend: function(data) {
                //                console.log(data);
            },
            success: function(data) {
                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'factura/listarvenda/1';
                } else {
                    location.href = base_url + 'factura/listarvenda/2';

                }
            }
        });
    } else {
        alert("Preenha os dados Correctamente");
    }
    return false;
}


function imprimir_venda(id) {
    window.open(base_url + 'factura/imprimirvenda/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}


/***********METODOS DA FATURA DE COMPRA***********/
function faturacompra() {
    $('#form-itemcompra').on('submit', function() {
        if ($('[name=itemcompra-subtotal]').val() != 0) {
            var id = $('[name=itemcompra-id]').val();
            var designacao = $('[name=itemcompra-designcacao]').val();
            var unidade = $('[name=itemcompra-unidade]').val();
            var preco = $('[name=itemcompra-preco]').val();
            var qtd = $('[name=itemcompra-qtd]').val();
            var imposto = $('[name=itemcompra-imposto]').val();
            var subtotal = $('[name=itemcompra-subtotal]').val();
            var html = '<tr>\n\
                <td><input type="text" class="hidden itemcompra-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm itemcompra-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm itemcompra-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemcompra-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemcompra-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemcompra-imposto" value="' + imposto + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemcompra-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_itemcompra(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
            $('#table-itemcompra tbody').prepend(html);
            $('[name=itemcompra-id]').val(0);
            $('[name=itemcompra-designacao]').val('').focus();
            $('[name=itemcompra-unidade]').val('AOA');
            $('[name=itemcompra-preco]').val('0.00');
            $('[name=itemcompra-imposto]').val('0.00');
            $('[name=itemcompra-qtd]').val('1.00');
            $('[name=itemcompra-subtotal]').val('0.00');
            itemcompra_total();
        }
        return false;
    });
}

function getitemcompra() {
    var dados = {
        valor: $('[name=itemcompra-designcacao]').val()
    }
    $.post(base_url + 'factura/getproduto',
        dados,
        function(data) {
            $('[name=itemcompra-id]').val((JSON.parse(data)[0]['id']));
            $('[name=itemcompra-preco]').val((JSON.parse(data)[0]['preco1']));
        });
    calcular_itemcompradetalhe();
}

function calcular_itemcompradetalhe() {
    var preco = parseFloat($('[name=itemcompra-preco]').val());
    var qtd = parseFloat($('[name=itemcompra-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=itemcompra-subtotal]').val(resultado);
}

function remove_itemcompra(e) {
    e.parentNode.parentNode.remove();
    itemcompra_total();
}

function itemcompra_total() {

    var arraysubtotal = document.getElementsByClassName('itemcompra-subtotal');
    var arrayimposto = document.getElementsByClassName('itemcompra-imposto');


    var imposto = 0;
    var desconto = 0;
    var subtotal = 0;
    var total = 0;
    if ($('[name=desconto]').val() >= 0 && $('[name=desconto]').val().length != 0) {
        desconto = parseFloat($('[name=desconto]').val());
    }

    for (var i = 0; i < arraysubtotal.length; i++) {
        var value = parseFloat(arraysubtotal[i].value);
        subtotal += value;
    }

    for (var i = 0; i < arrayimposto.length; i++) {
        var value = parseFloat(arrayimposto[i].value);
        imposto += value;
    }
    total = (subtotal + imposto) - ((subtotal * desconto) / 100);
    $('[name=itemcompra-total]').val((subtotal.toFixed(2)));
    $('[name=subtotal]').val((subtotal.toFixed(2)));
    $('[name=imposto]').val((imposto.toFixed(2)));
    $('[name=total]').val((total.toFixed(2)));
}

function salvar_itemcompra() {
    var itemcompra_produto = new Array();
    $("input[class*='itemcompra-id']").each(function() {
        itemcompra_produto.push($(this).val());
    });
    var itemcompra_unidade = new Array();
    $("input[class*='itemcompra-unidade']").each(function() {
        itemcompra_unidade.push($(this).val());
    });
    var itemcompra_preco = new Array();
    $("input[class*='itemcompra-preco']").each(function() {
        itemcompra_preco.push($(this).val());
    });
    var itemcompra_qtd = new Array();
    $("input[class*='itemcompra-qtd']").each(function() {
        itemcompra_qtd.push($(this).val());
    });
    var itemcompra_imposto = new Array();
    $("input[class*='itemcompra-imposto']").each(function() {
        itemcompra_imposto.push($(this).val());
    });
    var itemcompra_subtotal = new Array();
    $("input[class*='itemcompra-subtotal']").each(function() {
        itemcompra_subtotal.push($(this).val());
    });

    var data = 'action=itemcompra_produto=' + itemcompra_produto;
    if ($('[name=total]').val() != 0) {
        $.ajax({
            url: base_url + 'factura/cadastrarcompra',
            type: 'POST',
            dataType: 'html', //JSON
            data: {
                fornecedor: $('[name=fornecedor]').val(),
                itemcompra_produto: itemcompra_produto,
                itemcompra_unidade: itemcompra_unidade,
                itemcompra_preco: itemcompra_preco,
                itemcompra_qtd: itemcompra_qtd,
                itemcompra_imposto: itemcompra_imposto,
                itemcompra_subtotal: itemcompra_subtotal,
                subtotal: $('[name=subtotal]').val(),
                imposto: $('[name=imposto]').val(),
                desconto: $('[name=desconto]').val(),
                total: $('[name=total]').val(),
                metpag: $('[name=metpag]').val(),
                salvar: 'salvar'
            },
            beforeSend: function(data) {
                //                console.log(data);
            },
            success: function(data) {
                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'factura/listarcompra/1';
                } else {
                    location.href = base_url + 'factura/listarcompra/2';

                }
            }
        });
    } else {
        alert("Preenha os dados Correctamente");
    }
    return false;
}


function imprimir_compra(id) {
    window.open(base_url + 'factura/imprimircompra/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimircompra/' + id;
}

/***********METODOS DA FATURA DE PAGAMENTO***********/
function faturapagamento() {
    $('input[type=text]').focusout(function() {
        if ($(this).val().length == 0) {
            $(this).val(1);
            $(this).focus();
            $(this).select();
        }
    });
    $('#dia').keyup(
        function() {
            if ($('#dia').val() != 0) {
                var time = new Date();
                $('#data2').val((new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getDate()) + '-' +
                    (new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getMonth() + 1) + '-' +
                    (new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getFullYear()));
            } else {
                var time = new Date();
                $('#data2').val((new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getDate()) + '-' +
                    (new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getMonth() + 1) + '-' +
                    (new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getFullYear()));
            }
        });

    $('#form-itempagamento').on('submit', function() {
        if ($('[name=itempagamento-subtotal]').val() != 0) {
            var id = $('[name=itempagamento-id]').val();
            var designacao = $('[name=itempagamento-designcacao]').val();
            var unidade = $('[name=itempagamento-unidade]').val();
            var preco = $('[name=itempagamento-preco]').val();
            var qtd = $('[name=itempagamento-qtd]').val();
            var imposto = $('[name=itempagamento-imposto]').val();
            var subtotal = $('[name=itempagamento-subtotal]').val();
            var html = '<tr>\n\
                <td><input type="text" class="hidden itempagamento-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm itempagamento-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm itempagamento-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itempagamento-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itempagamento-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itempagamento-imposto" value="' + imposto + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itempagamento-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_itempagamento(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
            $('#table-itempagamento tbody').prepend(html);
            $('[name=itempagamento-id]').val(0);
            $('[name=itempagamento-designacao]').val('').focus();
            $('[name=itempagamento-unidade]').val('AOA');
            $('[name=itempagamento-preco]').val('0');
            $('[name=itempagamento-imposto]').val('0');
            $('[name=itempagamento-qtd]').val('0');
            $('[name=itempagamento-subtotal]').val('0');
            itempagamento_total();
        }
        return false;
    });
}

function getitempagamento() {
    var dados = {
        valor: $('[name=itempagamento-designcacao]').val()
    }
    $.post(base_url + 'factura/getservico',
        dados,
        function(data) {
            $('[name=itempagamento-id]').val((JSON.parse(data)[0]['id']));
            $('[name=itempagamento-preco]').val((JSON.parse(data)[0]['valor']));
            $('[name=itempagamento-imposto]').val((JSON.parse(data)[0]['imposto']));
        });
    calcular_itempagamentodetalhe();
}

function calcular_itempagamentodetalhe() {
    var preco = parseFloat($('[name=itempagamento-preco]').val());
    var qtd = parseFloat($('[name=itempagamento-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=itempagamento-subtotal]').val(resultado);
}

function remove_itempagamento(e) {
    e.parentNode.parentNode.remove();
    itempagamento_total();
}

function itempagamento_total() {

    var arraysubtotal = document.getElementsByClassName('itempagamento-subtotal');
    var arrayimposto = document.getElementsByClassName('itempagamento-imposto');
    var imposto = 0;
    var valorpago = 0;
    var valordivida = 0;
    var desconto = 0;
    var subtotal = 0;
    var total = 0;
    if ($('[name=valorpago]').val() >= 0 && $('[name=valorpago]').val().length != 0) {
        valorpago = parseFloat($('[name=valorpago]').val());
    }
    if ($('[name=desconto]').val() >= 0 && $('[name=desconto]').val().length != 0) {
        desconto = parseFloat($('[name=desconto]').val());
    }

    for (var i = 0; i < arraysubtotal.length; i++) {
        var value = parseFloat(arraysubtotal[i].value);
        subtotal += value;
    }

    for (var i = 0; i < arrayimposto.length; i++) {
        var value = parseFloat(arrayimposto[i].value);
        imposto += value;
    }
    valordivida = (subtotal + imposto) - (valorpago + desconto);
    total = (valorpago + imposto);
    $('[name=itempagamento-total]').val((subtotal.toFixed(2)));
    $('[name=subtotal]').val((subtotal.toFixed(2)));
    $('[name=imposto]').val((imposto.toFixed(2)));
    if ((subtotal != 0) && (valorpago != 0)) {
        $('[name=valordivida]').val((valordivida.toFixed(2)));
        $('[name=total]').val((total.toFixed(2)));
    }
}

function salvar_itempagamento() {
    var itempagamento_servico = new Array();
    $("input[class*='itempagamento-id']").each(function() {
        itempagamento_servico.push($(this).val());
    });
    var itempagamento_unidade = new Array();
    $("input[class*='itempagamento-unidade']").each(function() {
        itempagamento_unidade.push($(this).val());
    });
    var itempagamento_preco = new Array();
    $("input[class*='itempagamento-preco']").each(function() {
        itempagamento_preco.push($(this).val());
    });
    var itempagamento_qtd = new Array();
    $("input[class*='itempagamento-qtd']").each(function() {
        itempagamento_qtd.push($(this).val());
    });
    var itempagamento_imposto = new Array();
    $("input[class*='itempagamento-imposto']").each(function() {
        itempagamento_imposto.push($(this).val());
    });
    var itempagamento_subtotal = new Array();
    $("input[class*='itempagamento-subtotal']").each(function() {
        itempagamento_subtotal.push($(this).val());
    });
    var data = 'action=itempagamento_servico=' + itempagamento_servico;
    if ($('[name=total]').val() != 0) {
        $.ajax({
            url: base_url + 'factura/cadastrarpagamento',
            type: 'POST',
            dataType: 'html', //JSON
            data: {
                paciente: $('[name=paciente]').val(),
                itempagamento_servico: itempagamento_servico,
                itempagamento_unidade: itempagamento_unidade,
                itempagamento_preco: itempagamento_preco,
                itempagamento_qtd: itempagamento_qtd,
                itempagamento_imposto: itempagamento_imposto,
                itempagamento_subtotal: itempagamento_subtotal,
                subtotal: $('[name=subtotal]').val(),
                valorpago: $('[name=valorpago]').val(),
                imposto: $('[name=imposto]').val(),
                desconto: $('[name=desconto]').val(),
                valordivida: $('[name=valordivida]').val(),
                total: $('[name=total]').val(),
                metpag: $('[name=metpag]').val(),
                nota: $('[name=nota]').val(),
                dia: parseInt($('#dia').val()),
                data2: $('#data2').val(),
                salvar: 'salvar'
            },
            beforeSend: function(data) {
                //                console.log(data);
            },
            success: function(data) {

                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'factura/listarpagamento/1';
                } else {
                    location.href = base_url + 'factura/listarpagamento/2';
                }
            }
        });
    } else {
        alert("Preenha os dados Correctamente");
    }
    return false;
}


function imprimir_pagamento(id) {
    window.open(base_url + 'factura/imprimirpagamento/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimirpagamento/' + id;
}



/***********METODOS DA FATURA DE PROFORMA***********/
function faturaproforma() {
    $('input[type=text]').focusout(function() {
        if ($(this).val().length == 0) {
            $(this).val(1);
            $(this).focus();
            $(this).select();
        }
    });
    $('#dia').keyup(
        function() {
            if ($('#dia').val() != 0) {
                var time = new Date();
                $('#data2').val((new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getDate()) + '-' +
                    (new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getMonth() + 1) + '-' +
                    (new Date(time.getTime() + (parseInt($('#dia').val()) * 24 * 60 * 60 * 1000)).getFullYear()));
            } else {
                var time = new Date();
                $('#data2').val((new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getDate()) + '-' +
                    (new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getMonth() + 1) + '-' +
                    (new Date(time.getTime() + (1 * 24 * 60 * 60 * 1000)).getFullYear()));
            }
        });

    $('#form-itemproforma').on('submit', function() {
        if ($('[name=itemproforma-subtotal]').val() != 0) {
            var id = $('[name=itemproforma-id]').val();
            var designacao = $('[name=itemproforma-designcacao]').val();
            var unidade = $('[name=itemproforma-unidade]').val();
            var preco = $('[name=itemproforma-preco]').val();
            var qtd = $('[name=itemproforma-qtd]').val();
            var imposto = $('[name=itemproforma-imposto]').val();
            var subtotal = $('[name=itemproforma-subtotal]').val();
            var html = '<tr>\n\
                <td><input type="text" class="hidden itemproforma-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm itemproforma-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm itemproforma-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemproforma-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemproforma-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemproforma-imposto" value="' + imposto + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm itemproforma-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_itemproforma(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
            $('#table-itemproforma tbody').prepend(html);
            $('[name=itemproforma-id]').val(0);
            $('[name=itemproforma-designacao]').val('').focus();
            $('[name=itemproforma-unidade]').val('AOA');
            $('[name=itemproforma-preco]').val('0');
            $('[name=itemproforma-imposto]').val('0');
            $('[name=itemproforma-qtd]').val('0');
            $('[name=itemproforma-subtotal]').val('0');
            itemproforma_total();
        }
        return false;
    });
}

function getitemproforma() {
    var dados = {
        valor: $('[name=itemproforma-designcacao]').val()
    }
    $.post(base_url + 'factura/getservico',
        dados,
        function(data) {
            $('[name=itemproforma-id]').val((JSON.parse(data)[0]['id']));
            $('[name=itemproforma-preco]').val((JSON.parse(data)[0]['valor']));
            $('[name=itemproforma-imposto]').val((JSON.parse(data)[0]['imposto']));
        });
    calcular_itemproformadetalhe();
}

function calcular_itemproformadetalhe() {
    var preco = parseFloat($('[name=itemproforma-preco]').val());
    var qtd = parseFloat($('[name=itemproforma-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=itemproforma-subtotal]').val(resultado);
}

function remove_itemproforma(e) {
    e.parentNode.parentNode.remove();
    itemproforma_total();
}

function itemproforma_total() {

    var arraysubtotal = document.getElementsByClassName('itemproforma-subtotal');
    var arrayimposto = document.getElementsByClassName('itemproforma-imposto');
    var imposto = 0;
    var valorpago = 0;
    var valordivida = 0;
    var desconto = 0;
    var subtotal = 0;
    var total = 0;
    /*     if ($('[name=valorpago]').val() >= 0 && $('[name=valorpago]').val().length != 0) {
            valorpago = parseFloat($('[name=valorpago]').val());
        } */
    if ($('[name=desconto]').val() >= 0 && $('[name=desconto]').val().length != 0) {
        desconto = parseFloat($('[name=desconto]').val());
    }

    for (var i = 0; i < arraysubtotal.length; i++) {
        var value = parseFloat(arraysubtotal[i].value);
        subtotal += value;
    }

    for (var i = 0; i < arrayimposto.length; i++) {
        var value = parseFloat(arrayimposto[i].value);
        imposto += value;
    }
    total = (subtotal + imposto) - (desconto);
    $('[name=itemproforma-total]').val((subtotal.toFixed(2)));
    $('[name=subtotal]').val((subtotal.toFixed(2)));
    $('[name=imposto]').val((imposto.toFixed(2)));
    $('[name=total]').val((total.toFixed(2)));
}

function salvar_itemproforma() {
    var itemproforma_servico = new Array();
    $("input[class*='itemproforma-id']").each(function() {
        itemproforma_servico.push($(this).val());
    });
    var itemproforma_unidade = new Array();
    $("input[class*='itemproforma-unidade']").each(function() {
        itemproforma_unidade.push($(this).val());
    });
    var itemproforma_preco = new Array();
    $("input[class*='itemproforma-preco']").each(function() {
        itemproforma_preco.push($(this).val());
    });
    var itemproforma_qtd = new Array();
    $("input[class*='itemproforma-qtd']").each(function() {
        itemproforma_qtd.push($(this).val());
    });
    var itemproforma_imposto = new Array();
    $("input[class*='itemproforma-imposto']").each(function() {
        itemproforma_imposto.push($(this).val());
    });
    var itemproforma_subtotal = new Array();
    $("input[class*='itemproforma-subtotal']").each(function() {
        itemproforma_subtotal.push($(this).val());
    });
    var data = 'action=itemproforma_servico=' + itemproforma_servico;
    if ($('[name=total]').val() != 0) {
        $.ajax({
            url: base_url + 'factura/cadastrarproforma',
            type: 'POST',
            dataType: 'html', //JSON
            data: {
                paciente: $('[name=paciente]').val(),
                itemproforma_servico: itemproforma_servico,
                itemproforma_unidade: itemproforma_unidade,
                itemproforma_preco: itemproforma_preco,
                itemproforma_qtd: itemproforma_qtd,
                itemproforma_imposto: itemproforma_imposto,
                itemproforma_subtotal: itemproforma_subtotal,
                subtotal: $('[name=subtotal]').val(),
                valorpago: $('[name=valorpago]').val(),
                imposto: $('[name=imposto]').val(),
                desconto: $('[name=desconto]').val(),
                valordivida: $('[name=valordivida]').val(),
                total: $('[name=total]').val(),
                nota: $('[name=nota]').val(),
                dia: parseInt($('#dia').val()),
                data2: $('#data2').val(),
                salvar: 'salvar'
            },
            beforeSend: function(data) {
                //                console.log(data);
            },
            success: function(data) {

                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'factura/listarproforma/1';
                } else {
                    location.href = base_url + 'factura/listarproforma/2';
                }
            }
        });
    }
    return false;
}


function imprimir_proforma(id) {
    window.open(base_url + 'factura/imprimirproforma/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimirproforma/' + id;
}