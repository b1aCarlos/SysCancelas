//Variaveis Globais
finalFiles = [];
detalhesFile = [];
counter = 0;
var typingTimer; //timer identifier
var doneTypingInterval = 100;
var contador = 1;

$(document).ready(function () {
    /*Configurações semantic ui (Layout)*/
    // Configuração do select tipo veiculo (modal)
    $('select#tipo_veiculo').dropdown({
        maxSelections: 1
    });
    
    //Ativa o menu e sub menu correspondente na navbar. 
    $('#cadastros').addClass('active');
    $('.cadastros').addClass('active');
    $('#cadastrarCondutor').addClass('active');
    
    //cards especiais (imagem do usuario com preview).
    $('.special.cards .image').dimmer({
        on: 'hover'
    });
    
    //cards especiais (imagem do veiculo com preview).
    $('.special.cards .image .imagemcardModal').dimmer({
        on: 'hover'
    });
    
    //função que gera as mascaras do inputs no modal de veiculos.
    mascaraFormulario();
    
    
});

$("#upload_imagem_veiculo").on('change', function (e) {

    $('.imgAChoose').html("");
    var fileNum = this.files.length,
        initial = 0;

    $.each(this.files, function (idx, elm) {
        finalFiles[counter] = elm;
        detalhesFile[counter] = "";
        detalhesFile[counter]['marca'] = "";
    });
    counter++;
});

var url = '/admin/cadastro/autocomplete/';
$("#campo_pesquisa").keyup(function () {
    url = '/admin/cadastro/autocomplete/' + $(this).val();
    $('.ui.search').search({
        apiSettings: {
            url: url
        },
        fields: {
            results: 'suggestions',
            title: 'nome',
            description: 'identificacao'
        },
        error: {
            source: 'Nenhum resultado encontrado.',
            noResults: 'Sua busca não retornou resultados.',
            serverError: 'Buscando...'
        },
        searchOnFocus: true,
        transition: "slide down",
        duration: 200,
        minCharacters: 1,
        maxResults: 10,
        cache: true,
        silent: true,
        selectFirstResult: true,
        fullTextSearch: true,
        searchDelay: 0,
        onSelect(result, response) {
            buscarDados(result.identificacao);
        }
    });
});

//Valida o que o usuario escreve na caixa de pesquisa.
$("#campo_pesquisa").on('keyup', function (e) {
    e.preventDefault();
    clearTimeout(typingTimer);
    
    if ($(this).val) {
        typingTimer = setTimeout(buscarDados, doneTypingInterval);
    }
    
    if ($(this).val() == "") {
        limparFormularioCadastro();
    }
});

//Função que busca a pessoa no banco central
function buscarDados() {
    var identificacao = $('#campo_pesquisa').val();
    
    //se a identificacao for maior que 5.
    if (identificacao.length > 5) {
        //envio de requisição POST.
        $.ajax({
            type: 'POST',
            url: "/admin/cadastro/condutor/ver",
            data: {
                '_token': $('input[name=_token]').val(),
                'identificacao': identificacao,
            },
            headers: {
                'X-CSRF-Token': $('meta[name=_token]').attr('content')
            },
            success: function (data) {
                if (data.length != 0) {
                    setor_curso = ((data[0].nome_curso == "" || data[0].nome_curso == null) ? data[0].nome_setor : data[0].nome_curso);
                    $("#telefone_pessoa").val(data[0].celular);
                    $("#cpf_pessoa").val(data[0].cpf);
                    $("#email_pessoa").val(data[0].email);
                    $("#nome_pessoa").val(formatacaoStrings(data[0].nome));
                    $('#identificacao_pessoa').val(data[0].pessoa_identificacao)
                    $("#numero_cartao").val(data[0].numero_cartao);
                    $("#curso_pessoa").val(formatacaoStrings(setor_curso));
                    $("#imagem_pessoa").attr("src", "http://bd.maracanau.ifce.edu.br/uploads/image/" + data[0].pessoa_identificacao + ".jpg");
                    $("#tipo_pessoa").val(formatacaoStrings(data[0].pessoa_tipo));
                    
                    $("#campo_pesquisa").val("");
                    
                } else if (data.length == 0) {
                    limparFormularioCadastro();
                }
            }
        });
    }
}



//Evento abrir o modal de cadastro de veiculos.
$("#novo_cadastro_veiculo").click(function () {
    var qCards = $("#veiculos .classVeiculos").length;
    
    if (qCards < 6) {
        $('.ui.modal').modal('show');
    } else {
        $("#msg_erros").hide();
        $('#modalCadastroVeiculos')
        .modal('hide', function () {
            $("#msg_erros").hide();
            $('.ui.modal').modal('hide')
        });
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'Excedido o limite de veiculos! (máximo 5 veiculos)'
        })
    }
});

//Evento que valida o formulário de gerar um card.
$("#salvar_modal").click(function (e) {
    e.preventDefault();
    var marca = $("#marca").val();
    var placa = $("#placa").val();
    var modelo = $("#modelo").val();
    var tipo_veiculo = $("#tipo_veiculo").val();
    var imagem_veiculo = $("#upload_imagem_veiculo").val();
    var cor = $("#cor").val();
    var ano = $("#ano").val();

    // var teste = [];
    // teste['marca'] = marca;
    var countAux = counter -1;
    detalhesFile[countAux]['marca'] = marca; 
    
    //validação da imagem do veiculo
    if ((imagem_veiculo == '' || imagem_veiculo == null)) {
        if ($(".upload_imagem_veiculo").val('')) {
            $(".upload_imagem_veiculo").html("Você tem que inserir uma imagem para o cadastro do veiculo.");
        }
    } else {
        $(".upload_imagem_veiculo").text('');
    }
    
    //envio de requisição POST (validação).
    $.ajax({
        type: 'POST',
        url: "/admin/cadastro/condutor/validacao",
        data: {
            '_token': $('input[name=_token]').val(),
            'marca': marca,
            'placa': placa,
            'modelo': modelo,
            'cor': cor,
            'ano': ano,
            'tipo_veiculo': tipo_veiculo
        },
        headers: {
            'X-CSRF-Token': $('meta[name=_token]').attr('content')
        },
        success: function (data) {
            if (data.length == 0) {
                $("#msg_erros").hide();
                veiculosCards();
                $('#modalCadastroVeiculos')
                .modal('hide', function () {
                    $("#msg_erros").hide();
                    $('.ui.modal').modal('hide');
                });
            } else {
                //validação do formulário de gerar cards dos veiculos.
                $.each(data.erros, function (key, value) {
                    $(".field").removeClass("inputsFormVeiculo");
                    $("." + key).html(value);
                    $("#d_" + key).addClass('error');
                    
                    $("#d_" + key).click(function () {
                        $(this).removeClass('error');
                        $('.' + key).text('');
                        $("#d_placa").addClass("inputsFormVeiculo");
                        $("#d_marca").addClass("inputsFormVeiculo");
                        $("#d_tipo_veiculo").addClass("inputsFormVeiculo");
                        $("#d_modelo").addClass("inputsFormVeiculo");
                    });
                });
            }
        },
        statusCode: {
            // caso der erro de requisição.
            500: function () {
            }
        }
    });
    
});

//Função de gerar card dos veiculos.
function veiculosCards() {
    //dados do formulário do modal de Veiculos.
    var imagem = $("#imagem_veiculo").attr('src');
    var marca = $("#marca").val();
    var placa = $("#placa").val();
    var modelo = $("#modelo").val();
    var tipo_veiculo = $("#tipo_veiculo").val();
    var classe = "cardV_" + contador;
    
    //chamando função de criar os cards.
    criarCardVeiculos(classe, placa, tipo_veiculo, imagem, marca, modelo);
    
    contador++;
    
    //limpar o formulario do modal.
    $('#imagem_veiculo').attr('src', '/img/image.png');
    $('#formulario_veiculos')[0].reset();
    $('#tipo_veiculo').val("");
}

//Função de criar card do veiculo.
function criarCardVeiculos(classe, placa, tipo_veiculo, imagem, marca, modelo) {
    var card = $("#veiculos").prepend('<div class="five wide column classVeiculos" id="' + classe + '" style=""><input type="hidden" name="placa" value="' + placa + '"><input type="hidden" name="tipo_veiculo" value="' + tipo_veiculo + '"><div class="ui link card" id="cardCustomer"><div class="image"><img class="ui small rounded image" style="height: 240.46px;object-fit: cover; width: 290px;max-width: 100%;" src="' + imagem + '"></div> <div class="content ui attached button" style="text-align: center; background-color: gray;"><a class="header">' + marca + '</a><div class="meta"><span style="color:black">' + modelo + '</span></div></div></div><div style="text-align: center;"><button class="ui red icon button" type="button" onclick="removeCardVeiculos(1)" id="btnRemoveCardVeiculos"><i class="trash icon"></i></button></div></div>');
    
    return card;
}



//Função de enviar os dados para inserção no banco de dados
$("#cadastro_condutor").submit(function (e) {
    e.preventDefault();
    var checado = $("#check-visitante").prop("checked");
    var formData = new FormData(this);
    
    console.log(detalhesFile.length);
    for (var i = 0; i < finalFiles.length; i++) {
        formData.append('uploadFile[]', finalFiles[i]);
        formData.append('detalhesFile[]', detalhesFile[i]);
    }
    
    formData.append('imagem_pessoa', $("#identificacao_pessoa").val());
    console.log(finalFiles);
    
    if (!checado) {
        formData.append('tabela_pesssoa', 0);
    } else {
        formData.append('tabela_pesssoa', 1);
    }
    
    $.ajax({
        url: '/admin/cadastro/condutor/cadastrar/validacao',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            console.log(data);
            if (Object.keys(data) == 'sucesso') {
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Condutor cadastrado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                });
                limparFormularioCadastro();
            } else if(Object.keys(data) == 'condutor_cadastrado') {
                Swal.fire({
                    type: 'info',
                    title: data['condutor_cadastrado'],
                    showConfirmButton: false,
                    timer: 1300
                });
            } else if (Object.keys(data) == 'erro') {
                Swal.fire({
                    type: 'error',
                    title: data['erro'],
                    showConfirmButton: false,
                    timer: 1300
                });
            }
            else {
                $.each(data.campos_vazios, function (key, value) {
                    $(".field").removeClass("inputsFormVeiculo");
                    $("." + key).html(value);
                    $("#d_" + key).addClass('error');
                    
                    $("#d_" + key).click(function () {
                        $(this).removeClass('error');
                        $('.' + key).text('');
                    });
                });
            }
        }
    });
});

//Função que formata as strings vindo do banco central.
function formatacaoStrings(texto) {
    var palavras = texto.toLowerCase().split(" ");
    for (var a = 0; a < palavras.length; a++) {
        var w = palavras[a];
        palavras[a] = w[0].toUpperCase() + w.slice(1);
    }
    return palavras.join(" ");
}

//Função de limpar o formulário
function limparFormularioCadastro() {
    $("#cadastro_condutor")[0].reset();
    $('#cadastro_condutor input[type=text]').each(function () {
        $(this).removeAttr("readonly");
    });
    $("#imagem_pessoa").attr("src", "/img/image.png");
}

//Evento onclick de limpar o formulario de cadastro de veiculos
$("#limpar_modal_veiculo").click(function () {
    //limpar o formulario do modal.
    $('#imagem_veiculo').attr('src', '/img/image.png');
    $('#tipo_veiculo').val("");
    $("#formulario_veiculos")[0].reset();
    $("#msg_erros").hide();
});

//Evento do butão limpar formulário
$("#limpar_tela").click(function (e) {
    e.preventDefault();
    $("#campo_pesquisa").val("");
    limparFormularioCadastro();
    $("#vecuilos").html('<div class="five wide column classVeiculos" id="cardNCadastrado"> <div class="ui link card"> <div class="image"> <img class="ui small rounded image" src="img/image.png"> </div><div class="content ui bottom attached button" style="background-color: red; height: 60px !important;"> <font style="vertical-align: inherit;"> <font style="vertical-align: inherit; color: white; padding-top: 3px;"> Não cadastrado </font> </font> </div></div></div>');
});

//Função utiliza o maskInput do Jquery e faz a validação de alguns campos.
function mascaraFormulario() {
    //validação de cpf's.
    $('#cpf_pessoa').mask('000.000.000-00', {
        reverse: true
    });
    $('#cpf_visitante').mask('000.000.000-00', {
        reverse: true
    });
    //validação de telefones.
    $('#telefone_visitante').mask('(00) 00000-0000');
    $('#telefone_pessoa').mask('(00) 00000-0000');
    //validação de placa de carro.
    $("#placa").mask('AAA-9999');
}

//Eventos de preview de imagens.
$("#upload_imagem_pessoa").change(function () {
    const file = $(this)[0].files[0]
    console.log(file);
    const fileReader = new FileReader()
    
    fileReader.onloadend = function () {
        $("#imagem_pessoa").attr('  src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
});

$("#upload_imagem_veiculo").change(function () {
    $(".upload_imagem_veiculo").text('');
    const file = $(this)[0].files[0]
    const fileReader = new FileReader()
    
    fileReader.onloadend = function () {
        $("#imagem_veiculo").attr('src', fileReader.result)
    }
    fileReader.readAsDataURL(file)
});



//Função de remover o card do veiculo quando clicado no botão.
function removeCardVeiculos(id) {
    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você não poderá reverter isso!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete!',
        cancelButtonText: 'Cancelar!',
    }).then((result) => {
        if (result.value == true) {
            for (var i = 0; i < finalFiles.length; ++i) {
                if (i == (id - 1)) {
                    finalFiles.splice(i, 1);
                }
            }
            Swal.fire(
                'Deletado!',
                'O veiculo foi excluído',
                'success'
                );
                $("#cardV_" + id).remove();
            }
        });
    }
    
