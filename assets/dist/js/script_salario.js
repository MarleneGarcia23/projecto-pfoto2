/***********METODOS DO SALARIO***********/
function getsalario() {
    var dados = {
        valor: $('[name=funcionario]').val()
    }
    $.post(base_url + 'salario/getsalario',
        dados,
        function(data) {
            $('[name=salario]').val((JSON.parse(data)[0]['salario']));
            $('[name=irt]').val((JSON.parse(data)[0]['irt']));
            $('[name=ssocial]').val((JSON.parse(data)[0]['ssocial']));
        });
    salario_total();
}

function salario_total() {

    var arraysubcidio = document.getElementsByClassName('subcidio-subtotal');
    var arraydesconto = document.getElementsByClassName('desconto-subtotal');
    var salario = parseFloat($('[name=salario]').val());
    var irt = parseFloat($('[name=irt]').val());
    var ssocial = parseFloat($('[name=ssocial]').val());

    var totalsubcidio = 0;
    var totaldesconto = 0;
    var subtotal = 0;
    var total = 0;

    for (var i = 0; i < arraysubcidio.length; i++) {
        var value = parseFloat(arraysubcidio[i].value);
        totalsubcidio += value;
    }

    for (var i = 0; i < arraydesconto.length; i++) {
        var value = parseFloat(arraydesconto[i].value);
        totaldesconto += value;
    }

    totalsubcidio = totalsubcidio.toFixed(2);
    totaldesconto = totaldesconto.toFixed(2);

    subtotal = totalsubcidio - totaldesconto;
    total = (salario + subtotal) - (irt + ssocial);

    $('[name=subtotal]').val((subtotal.toFixed(2)));
    $('[name=subcidio]').val(totalsubcidio);
    $('[name=desconto]').val(totaldesconto);
    $('[name=total]').val((total.toFixed(2)));
}

//SUBCIDIO
function item_subcidio() {
    $('#form-subcidio').on('submit', function() {
        if ($('[name=subcidio-subtotal]').val() != 0) {
            var id = $('[name=subcidio-id]').val();
            var designacao = $('[name=subcidio-designcacao]').val();
            var unidade = $('[name=subcidio-unidade]').val();
            var preco = $('[name=subcidio-preco]').val();
            var qtd = $('[name=subcidio-qtd]').val();
            var subtotal = $('[name=subcidio-subtotal]').val();
            var html = '<tr>\n\
                <td><input type="text" class="hidden subcidio-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm subcidio-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm subcidio-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm subcidio-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm subcidio-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm subcidio-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_subcidio(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
            $('#table-subcidio tbody').prepend(html);
            $('[name=subcidio-id]').val(0);
            $('[name=subcidio-designacao]').val('').focus();
            $('[name=subcidio-unidade]').val('AOA');
            $('[name=subcidio-preco]').val('0.00');
            $('[name=subcidio-qtd]').val('1.00');
            $('[name=subcidio-subtotal]').val('0.00');
            salario_total();
        }
        return false;
    });
}

function getsubcidio() {
    var dados = {
        valor: $('[name=subcidio-designcacao]').val()
    }
    $.post(base_url + 'salario/getitem',
        dados,
        function(data) {
            $('[name=subcidio-id]').val((JSON.parse(data)[0]['id']));
            $('[name=subcidio-preco]').val((JSON.parse(data)[0]['valor']));
        });
    calcular_subcidiodetalhe();
}

function calcular_subcidiodetalhe() {
    var preco = parseFloat($('[name=subcidio-preco]').val());
    var qtd = parseFloat($('[name=subcidio-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=subcidio-subtotal]').val(resultado);
}

function remove_subcidio(e) {
    e.parentNode.parentNode.remove();
    salario_total();
}

//DESCONTO
function item_desconto() {
    $('#form-desconto').on('submit', function() {
        if ($('[name=desconto-subtotal]').val() != 0) {
            var id = $('[name=desconto-id]').val();
            var designacao = $('[name=desconto-designcacao]').val();
            var unidade = $('[name=desconto-unidade]').val();
            var preco = $('[name=desconto-preco]').val();
            var qtd = $('[name=desconto-qtd]').val();
            var subtotal = $('[name=desconto-subtotal]').val();
            var html = '<tr>\n\
                <td><input type="text" class="hidden desconto-id" value="' + id + '">\n\
                <input type="text" class="form-control input-sm desconto-designacao" value="' + designacao + '" readonly></td>\n\
                <td><input type="text" class="form-control input-sm desconto-unidade" value="' + unidade + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm desconto-preco" value="' + preco + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm desconto-qtd" value="' + qtd + '" readonly></td>\n\
                <td><input type="number" step="any" class="form-control input-sm desconto-subtotal" value="' + subtotal + '" readonly></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_desconto(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
            $('#table-desconto tbody').prepend(html);
            $('[name=desconto-id]').val(0);
            $('[name=desconto-designacao]').val('').focus();
            $('[name=desconto-unidade]').val('AOA');
            $('[name=desconto-preco]').val('0.00');
            $('[name=desconto-qtd]').val('1.00');
            $('[name=desconto-subtotal]').val('0.00');
            salario_total();
        }
        return false;
    });
}

function getdesconto() {
    var dados = {
        valor: $('[name=desconto-designcacao]').val()
    }
    $.post(base_url + 'salario/getitem',
        dados,
        function(data) {
            $('[name=desconto-id]').val((JSON.parse(data)[0]['id']));
            $('[name=desconto-preco]').val((JSON.parse(data)[0]['valor']));
        });
    calcular_descontodetalhe();
}

function calcular_descontodetalhe() {
    var preco = parseFloat($('[name=desconto-preco]').val());
    var qtd = parseFloat($('[name=desconto-qtd]').val());
    var resultado = preco * qtd;
    resultado = resultado.toFixed(2);
    $('[name=desconto-subtotal]').val(resultado);
}

function remove_desconto(e) {
    e.parentNode.parentNode.remove();
    salario_total();
}


function salvar_salario() {
    //Dados do Subcídio
    var subcidio_id = new Array();
    $("input[class*='subcidio-id']").each(function() {
        subcidio_id.push($(this).val());
    });
    var subcidio_unidade = new Array();
    $("input[class*='subcidio-unidade']").each(function() {
        subcidio_unidade.push($(this).val());
    });
    var subcidio_preco = new Array();
    $("input[class*='subcidio-preco']").each(function() {
        subcidio_preco.push($(this).val());
    });
    var subcidio_qtd = new Array();
    $("input[class*='subcidio-qtd']").each(function() {
        subcidio_qtd.push($(this).val());
    });
    var subcidio_subtotal = new Array();
    $("input[class*='subcidio-subtotal']").each(function() {
        subcidio_subtotal.push($(this).val());
    });

    //Dados do Desconto
    var desconto_id = new Array();
    $("input[class*='desconto-id']").each(function() {
        desconto_id.push($(this).val());
    });
    var desconto_unidade = new Array();
    $("input[class*='desconto-unidade']").each(function() {
        desconto_unidade.push($(this).val());
    });
    var desconto_preco = new Array();
    $("input[class*='desconto-preco']").each(function() {
        desconto_preco.push($(this).val());
    });
    var desconto_qtd = new Array();
    $("input[class*='desconto-qtd']").each(function() {
        desconto_qtd.push($(this).val());
    });
    var desconto_subtotal = new Array();
    $("input[class*='desconto-subtotal']").each(function() {
        desconto_subtotal.push($(this).val());
    });

    var subcidios = [subcidio_id, subcidio_unidade, subcidio_preco, subcidio_qtd, subcidio_subtotal];
    var descontos = [desconto_id, desconto_unidade, desconto_preco, desconto_qtd, desconto_subtotal];

    if ($('[name=salario]').val() != 0 && $('[name=total]').val() != 0) {
        $.ajax({
            url: base_url + 'salario/cadastrar',
            type: 'POST',
            dataType: 'html', //JSON
            data: {
                funcionario: $('[name=funcionario]').val(),
                mes: $('[name=mes]').val(),
                subcidios: subcidios,
                descontos: descontos,
                subtotal: $('[name=subtotal]').val(),
                salario: $('[name=salario]').val(),
                irt: $('[name=irt]').val(),
                ssocial: $('[name=ssocial]').val(),
                subcidio: $('[name=subcidio]').val(),
                desconto: $('[name=desconto]').val(),
                total: $('[name=total]').val(),
                salvar: 'salvar'
            },
            beforeSend: function(data) {
                //                console.log(data);
            },
            success: function(data) {
                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'salario/listar/1';
                } else {
                    location.href = base_url + 'salario/listar/2';

                }
            }
        });
    }
    return false;
}


function imprimir(id) {
    window.open(base_url + 'salario/imprimir/' + id, 'Salário', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}