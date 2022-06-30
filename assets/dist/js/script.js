var ncontadorExame = 0;
$(function() {

    //Tempo Estático
    setTimeout(function() {
        $('[name=mensagem]').hide();
    }, 3000);
    //Tempo Dinámico
    setInterval(function() {
        contchat();
        conttarefa();
        contevento();
    }, 3000);
    switch (modulo) {
        case 'PACIENTE':
            $('[name=showhidenomepacienteparceiro]').hide();
            $('[name=showhidenomeparceiro]').show();
            break;
        case 'CLINICO':
            clinica();
            calculoperiodomenstrual();
            break;
        case 'ESTATISTICA':
            //            setInterval(function () {
            //                window.location.reload(1);
            //            }, 5000);
            break;
        case 'SALARIO':
            getsalario();
            item_subcidio();
            item_desconto();
            break;
        case 'FACTURA':
            faturaproforma();
            faturapagamento();
            faturavenda();
            faturacompra();
            break;
        case 'EXAME':
            dadosexame();
            break;
        default:

            break;
    }

});

/***********METODOS GERAIS***********/
function contchat() {
    $.post(base_url + 'home/contchat', {}, function(data) {
        $('[name=contchat]').html(JSON.parse(data));
    });
}

function conttarefa() {
    $.post(base_url + 'home/conttarefa', {}, function(data) {
        $('[name=conttarefa]').html(JSON.parse(data));
    });
}

function contevento() {
    $.post(base_url + 'home/contevento', {}, function(data) {
        $('[name=contevento]').html(JSON.parse(data));
    });
}

/***********METODOS DO ARQUIVO***********/
$("#arquivo").on('change', function() {

    if (typeof(FileReader) != "undefined") {

        var imagem = $("#imagem");
        imagem.empty();

        var reader = new FileReader();
        reader.onload = function(e) {
            $("<img/>", {
                "src": e.target.result,
                "class": "thumb-image",
                "style": "border:2px solid #EAEAEA; height: 105px; width:153px;"
            }).appendTo(imagem);
        }
        imagem.show();
        reader.readAsDataURL($(this)[0].files[0]);
    } else {
        alert("Este navegador nao suporta FileReader.");
    }
});