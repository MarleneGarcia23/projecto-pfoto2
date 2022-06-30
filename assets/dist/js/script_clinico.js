/***********METODOS DA CLINICA***********/

function showhidenomepaciente() {
    console.log($('[name=ispaciente]').val() == '0');
    if ($('[name=ispaciente]').val() == '0') {
        $('[name=showhidenomepacienteparceiro]').hide();
        $('[name=showhidenomeparceiro]').show();
    } else {
        $('[name=showhidenomepacienteparceiro]').show();
        $('[name=showhidenomeparceiro]').hide();
    }
}



function clinica() {
    $('[name=peso]').focus();
    $('input[type=text]').focusout(function() {
        if ($(this).val().length == 0) {
            $(this).val(0);
            $(this).focus();
            $(this).select();
        }
    });
}


function calculoperiodomenstrual() {
    /*     $('#dia').keyup(
            function () {
                if (!($('#dia').val() != 0)) {
                    $('#dia').val(3);
                    alert('Dias Inválidos')
                }
            });


    $('#data1').click(
        function () {
            if (($('#dias').val() != 0)) {
                var dataExclusao = $('#data1').val();
                var arrDataExclusao = dataExclusao.split('/');

                var stringFormatada = arrDataExclusao[2] + '-' + arrDataExclusao[1] + '-' +
                    arrDataExclusao[0];
                var dataFormatada1 = new Date(stringFormatada);

                $('#data2').val((new Date(dataFormatada1.getTime() + (parseInt($('#dias').val()) * 24 * 60 * 60 * 1000)).getDate()) + '-'
                    + (new Date(dataFormatada1.getTime() + (parseInt($('#dias').val()) * 24 * 60 * 60 * 1000)).getMonth() + 1) + '-'
                    + (new Date(dataFormatada1.getTime() + (parseInt($('#dias').val()) * 24 * 60 * 60 * 1000)).getFullYear()));
            } else {
                        $('#dias').val(25);
                        alert('Dias Inválidos')
                    } 
        }); */




}


function getfichaclinica() {
    var dados = {
        valor: $('[name=idpaciente]').val()
    }
    $.post(base_url + 'clinico/getfichaclinica',
        dados,
        function(data) {
            var html = null;
            for (var i = 0; i < JSON.parse(data).length; i++) {
                var id = (JSON.parse(data)[i]['id']);
                var idpaciente = (JSON.parse(data)[i]['idpaciente']);
                var peso = (JSON.parse(data)[i]['peso']);
                var pa = (JSON.parse(data)[i]['pa']);
                var pulso = (JSON.parse(data)[i]['pulso']);
                var data1 = (JSON.parse(data)[i]['data1']);
                var data2 = (JSON.parse(data)[i]['data2']);
                html += '<tr>\n\
                                <td>' + data1 + '</td>\n\
                                <td>' + peso + '</td>\n\
                                <td>' + pa + '</td>\n\
                                <td>' + pulso + '</td>\n\
                                <td>' + data2 + '</td>\n\
                                <td>\n\
                                    <button class="btn btn-danger btn-sm" onClick="eliminarfichaclinica(' + id + ');">\n\
                                        <i class="glyphicon glyphicon-remove"></i>\n\
                                    </button>\n\
                                </td>\n\
                            </tr>';
            }

            $('[name=dadosfichaclinica').html(html);
        });
}

function guardarfichaclinica() {
    var idpaciente = $('[name=idpaciente]').val();
    var peso = $('[name=peso]').val();
    var pa = $('[name=pa]').val();
    var pulso = $('[name=pulso]').val();
    var data2 = $('[name=data2]').val();
    $.post(base_url + 'clinico/cadastrarfichaclinica', {
        idpaciente: $('[name=idpaciente').val(),
        idcardapio: $('[name=idcardapio').val(),
        peso: $('[name=peso').val(),
        pa: $('[name=pa').val(),
        pulso: $('[name=pulso').val(),
        data2: $('[name=data2').val(),
        salvar: 'salvar'
    }, function(data) {});
    location.href = base_url + 'clinico/fichaclinica/' + $('[name=idpaciente').val();
    //    this.getfichaclinica();
}

function eliminarfichaclinica(id) {
    $.post(base_url + 'clinico/eliminarfichaclinica/' + id, [], function(data) {});
    location.href = base_url + 'clinico/fichaclinica/' + $('[name=idpaciente').val();
}

function imprimirfichaclinica(id, tipo) {
    window.open(base_url + 'clinico/imprimirfichaclinica/' + id + '?tipo=' + tipo, 'FichaClinica', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}

function eliminarperiodomenstrual(id) {
    $.post(base_url + 'clinico/periodomenstrual/' + id, [], function(data) {});
    location.href = base_url + 'clinico/periodomenstrual/' + $('[name=idpaciente').val();
}

function imprimirperiodomenstrual(id) {
    window.open(base_url + 'clinico/imprimirperiodomenstrual/' + id, 'Periodo Menstrual', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}


function imprimirpedidoexame(id) {
    window.open(base_url + 'clinico/imprimirpedidoexame/' + id, 'Pedido Exame', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}

function imprimirreceita(id) {
    window.open(base_url + 'clinico/imprimirreceita/' + id, 'Receita', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}

function imprimirall(url) {
    window.open(url, 'Imprimir', 'width=900, height=650');
    //    location.href = base_url + 'factura/imprimirvenda/' + id;
}




/***********METODOS DO EXAME***********/

function contadorExame(checked, n) {
    if (checked) {
        ncontadorExame++;
    } else {
        ncontadorExame--;
    }
    $('[name=contadorExame]').html(n + ncontadorExame);
}

function dadosexame() {
    $('#form-itemexame').on('submit', function() {
        var grupo = $('[name=itemexame-grupo]').val();
        var designacao = $('[name=itemexame-designacao]').val();
        var valor = $('[name=itemexame-valor]').val();
        var html = '<tr>\n\
                    <td><input type="text" class="form-control input-sm itemexame-grupo" value="' + grupo + '" readonly></td>\n\
                    <td><input type="text" class="form-control input-sm itemexame-designacao" value="' + designacao + '" ></td>\n\
                    <td><input type="text" class="form-control input-sm itemexame-valor" value="' + valor + '" ></td>\n\
                    <td><button class="btn btn-default btn-sm" onClick="remove_itemexame(this);">\n\
                    <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
        $('#table-itemexame tbody').append(html);
        $('[name=itemexame-designacao]').val('').focus();
        $('[name=itemexame-valor]').val('');

        return false;
    });
    return false;
}

function remove_itemexame(e) {
    e.parentNode.parentNode.remove();
}


function salvar_itemexame() {
    var itemexame_grupo = new Array();
    $("input[class*='itemexame-grupo']").each(function() {
        itemexame_grupo.push($(this).val().split("-")[0]);
    });



    var itemexame_designacao = new Array();
    $("input[class*='itemexame-designacao']").each(function() {
        itemexame_designacao.push($(this).val());
    });

    var itemexame_valor = new Array();
    $("input[class*='itemexame-valor']").each(function() {
        itemexame_valor.push($(this).val());
    });
    if ($('[name=designacao-item]').val() != null && $('[name=designacao-item]').val().length > 0 && itemexame_grupo.length > 0) {
        $.ajax({
            url: base_url + 'exame/insupditem',
            type: 'POST',
            dataType: 'html',
            data: {
                idexame: $('[name=id]').val(),
                designacao: $('[name=designacao-item]').val(),
                itemexame_grupo: itemexame_grupo,
                itemexame_designacao: itemexame_designacao,
                itemexame_valor: itemexame_valor
            },
            beforeSend: function(data) {
                //console.log(data);
            },
            success: function(data) {
                var resultado = JSON.parse(data)['valor'];
                if (resultado == 1) {
                    location.href = base_url + 'exame/listar/1';
                } else {
                    location.href = base_url + 'exame/listar/2';
                }
            }
        });
    } else {
        alert("Preencha os dados correctamente!")
    }

    return false;
}


function cancelar_itemexame(id) {
    location.href = base_url + 'exame/listar/';
}

function imprimir_exame(id) {
    window.open(base_url + 'factura/imprimirexame/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimirexame/' + id;
}



/***********METODOS DO CPFIV***********/
function adicionarcpfiv(tabela) {
    var cpfiv_s3_i1_1 = $('[name=cpfiv_s3_i1_1_' + tabela + ']').val();
    var cpfiv_s3_i1_2 = $('[name=cpfiv_s3_i1_2_' + tabela + ']').val();
    var cpfiv_s3_i1_3 = $('[name=cpfiv_s3_i1_3_' + tabela + ']').val();
    var html = '<tr>\n\
                <td><input type="text" name="cpfiv_s3_i1_1[]" class="form-control" value="' + cpfiv_s3_i1_1 + '" ></td>\n\
                <td><input type="text" name="cpfiv_s3_i1_2[]" class="form-control" value="' + cpfiv_s3_i1_2 + '" ></td>\n\
                <td><input type="text" name="cpfiv_s3_i1_3[]" class="form-control" value="' + cpfiv_s3_i1_3 + '" ></td>\n\
                <td><button class="btn btn-default btn-sm" onClick="remove_itemcpfiv(this);">\n\
                <i class="glyphicon glyphicon-minus-sign"></i> Eliminar</button></td></tr>';
    $('#' + tabela + ' tbody').append(html);
    $('[name=cpfiv_s3_i1_1_' + tabela + ']').val('');
    $('[name=cpfiv_s3_i1_2_' + tabela + ']').val('');
    $('[name=cpfiv_s3_i1_3_' + tabela + ']').val('');

    return false;
}



function remove_itemcpfiv(e) {
    e.parentNode.parentNode.remove();
}


function imprimir_cpfiv(id) {
    window.open(base_url + 'factura/imprimircpfiv/' + id, 'Factura de Venda', 'width=600, height=600');
    //    location.href = base_url + 'factura/imprimircpfiv/' + id;
}