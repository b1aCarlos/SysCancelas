//função principal
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#transito').addClass('active');
    $("#veiculos").hide();
    checkboxAusenciaVigia();
    carregarCondutor();
    ultimosTransitos();
    setInterval(carregarCondutor, 1000);
    setInterval(checkboxAusenciaVigia, 1000);
    setInterval(ultimosTransitos, 5000);
    $('#table_condutor_nome').removeAttr('display');
});

//carregar condutor
function carregarCondutor() {
    $.getJSON('/admin/transitos/ver', function (data) {
        if (data['arquivo_limpo'] == 1) {
            data.consultaUltimoCondutor.forEach(elementoCondutor => {
                $("#condutor_id").val(elementoCondutor.condutor_id);
                $("#nome_transito").val(elementoCondutor.condutor_nome);
                $("#img_transito_condutor").attr('src', 'http://bd.maracanau.ifce.edu.br/uploads/image/' + elementoCondutor.identificacao + '.jpg');
                $("#matricula_transito").val(elementoCondutor.identificacao);
                $("#tipo_pessoa_transito").val(elementoCondutor.tipo_pessoa);
                $("#curso_setor_transito").val(elementoCondutor.curso_setor);
                $("#telefone_transito").val(elementoCondutor.contato);
                $("#form_transito  #nome_transito, #matricula_transito, #tipo_pessoa_transito, #curso_setor_transito, #telefone_transito").each(function () {
                    $(this).attr("readonly", true);
                    $(this).attr("disabled", true);
                });
            });
        } else {
            data.dadosCondutor.forEach(elementoCondutor => {
                $("#condutor_id").val(elementoCondutor.condutor_id);
                $("#nome_transito").val(elementoCondutor.nome);
                $("#img_transito_condutor").attr('src', 'http://bd.maracanau.ifce.edu.br/uploads/image/' + elementoCondutor.identificacao + '.jpg');
                $("#matricula_transito").val(elementoCondutor.identificacao);
                $("#tipo_pessoa_transito").val(elementoCondutor.tipo);
                $("#curso_setor_transito").val(elementoCondutor.setor_curso);
                $("#telefone_transito").val(elementoCondutor.telefone);
                $("#form_transito  #nome_transito, #matricula_transito, #tipo_pessoa_transito, #curso_setor_transito, #telefone_transito").each(function () {
                    $(this).attr("readonly", true);
                    $(this).attr("disabled", true);
                });
            });
            
            $('#tipo_cancela').val(data.tipo_cancela);
            
            //verificação se a passagem é automática ou manual
            if ($("#checkbox_veiculos").is(':checked')) {
                clickVeiculo();
            } else {
                //passagem automática
                passagemAutomatica($("#condutor_id").val(), $("#tipo_cancela").val());
                $("#veiculos").empty();
            }
        }
    });
}

function passagemAutomatica(id_condutor, tipo_cancela) {
    $.ajax({
        type: "POST",
        url: "/admin/transitos/ver/cadastro-transito",
        data: { tipo_transito: "automatico", condutor_id: id_condutor, tipo_cancela: tipo_cancela },
        success: function (data) {
            console.log(data);
        }
    });
}

//Mostrando os ultimos condutores passado nas cancelas.
function ultimosTransitos() {
    $.getJSON('/admin/transitos/ver/ultimos-transitos', function (data) {
        data.forEach(ultimosTransitos => {
            html += '<tr><td>' + ultimosTransitos.condutor_nome + '</td></tr>';
        });
        $("#table_condutor_nome").html(html);
    });
    var html = "";
}

//função que verifica se o checkbox 
function checkboxAusenciaVigia() {
    if ($("#checkbox_veiculos").is(':checked')) {
        if ($("div#veiculos").length) {
            $.ajax({
                type: "POST",
                url: "/admin/condutores/veiculos/busca-veiculo",
                data: { id: $("#condutor_id").val() },
                success: function (data) {
                    //gera os cards dos veiculos
                    var html = "";
                    data.forEach(elementoVeiculo => {
                        $("#veiculo_id").val(elementoVeiculo.veiculo_id);
                        html += '<div class="four wide column" style="margin-left: 3%;" id="cardVeiculos' + elementoVeiculo.veiculo_id + '" onclick="clickVeiculo(' + elementoVeiculo.veiculo_id + ')"><input type="hidden" id="id_veiculo" value="' + elementoVeiculo.veiculo_id + '"><div class="ui link card centered auto_veiculo"><div class="image"><img class="ui small rounded image img_carro" id="veiculo1" src="' + /img/ + elementoVeiculo.img_veiculo + '"></div><div class="content ui attached button" style="text-align: center; background-color: gray; "><a class="header">' + elementoVeiculo.marca + '</a><div class="meta"><span style="color:black">' + elementoVeiculo.modelo + '</span></div></div></div></div>';
                    });
                    
                    html += '<div class="four wide column" style="margin-left: 3%;" id="cardVeiculosNaoCadastrado" onclick="clickVeiculoNaoCadastrado();"><div class="ui link card centered auto_veiculo" id="veiculo_nao_cadastrado"><div class="image"><img class="ui small rounded image img_carro" src="/img/image.png" ></div><div class="content ui bottom attached button" style="background-color: red; height: 60px !important;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit; color: white; padding-top: 3px;">Não cadastrado</font></font></div></div></div>';
                    
                    $("#veiculos").html(html);
                }
            });
            $('#veiculos').show();
        }
    } else {
        $('#veiculos').hide();
        
    }
    
}
function clickVeiculoNaoCadastrado() {
    if ($("div#cardVeiculosNaoCadastrado").length) {
        Swal.fire({
            title: 'Você tem certeza?',
            text: "Você não poderá reverter isso!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, autorizar!'
        }).then((result) => {
            if (result.value) {
                var veiculo_id = null;
                var condutor_id = $("#condutor_id").val();
                var tipo_cancela = $('#tipo_cancela').val();
                if ((veiculo_id != null || veiculo_id != "" ) && (condutor_id != null || condutor_id != "" ) && (tipo_cancela != null || tipo_cancela != "" )) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/transitos/ver/cadastro-transito",
                            data: {tipo_transito: "manual", veiculo_id: veiculo_id, condutor_id: condutor_id, tipo_cancela: tipo_cancela},
                            cache: false,
                            success: function (response) {
                                console.log(response);
                            }
                        });
                        Swal.fire(
                            'Transito autorizado!',
                            'O transito foi autorizado com sucesso.',
                            'success'
                            );
                        }
                }
            }
        });
    }
}

function clickVeiculo(veiculo_id) {
    if ($("div#veiculos").length) {
        $("#cardVeiculos"+veiculo_id).click(function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, autorizar!'
            }).then((result) => {
                var veiculo_id = $("#veiculo_id").val();
                var condutor_id = $("#condutor_id").val();
                var tipo_cancela = $('#tipo_cancela').val();
                if ((veiculo_id != null || veiculo_id != "" ) && (condutor_id != null || condutor_id != "" ) && (tipo_cancela != null || tipo_cancela != "" )) {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: "/admin/transitos/ver/cadastro-transito",
                            data: {tipo_transito: "manual", veiculo_id: veiculo_id, condutor_id: condutor_id, tipo_cancela: tipo_cancela},
                            cache: false,
                            success: function (response) {
                                console.log(response);
                            }
                        });
                        Swal.fire(
                            'Transito autorizado!',
                            'O transito foi autorizado com sucesso.',
                            'success'
                            );
                        }
                }
                });
            });
        }
    }


    
