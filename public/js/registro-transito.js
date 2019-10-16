//Chamando o TOKEN Via ajax
var table = null;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//função principal
$(document).ready(function () {
    calendario();
    listarDados();

    //-----------------------------------------------------------------------------------//
    //Gerando tabela de REGISTRO e adicionado as funções e botão de PDF,EXCEL E PRINT   //
    //---------------------------------------------------------------------------------//

    table = $('#tabRegistro').DataTable({
        "bServerSide": true,
        "bDestroy": true,
        order: [[4, "desc"]],

        processing: true,
        dom: 'Bfrtip',
        ajax: "/admin/registros/ver",
        //Fazendo a listagem dos seguintes dados
        columns: [
            {
                'data': 'dataDoTransito',
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html(moment().format('L'));
                }
            },
            { data: 'nome', },
            { data: 'identificacao' },
            { data: 'curos_setor' },
            { data: 'descricao_tipo_transito' },
            { data: 'marca' },
            { data: 'telefone' },

            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        buttons: [

            //Adicionando BOTÃO DE PRINT
            {
                init: function (api, node, config) {
                    $(node).removeClass('dt-button')
                },
                extend: 'print', className: 'ui primary button',
                customize: function (win) {
                    $(win.document.body).find('table').css('text-align', 'center');
                    $(win.document.body)
                        // .css( 'margin', '150 0 0 0' )
                        .prepend(
                            '<img src="https://ifce.edu.br/maracanau/menu/uploads/marcas-campus-maracanau/logo_ifce_maracanau_horizontal_cor.jpg" style="margin: 0 auto; text-align: center; display: block;" />'
                        );

                },
                title: '',
                orientation: '',
                //Determinando quais colunas sairar quando o PRINT for gerado
                exportOptions: {
                    columns: [':visible']
                }
            },
            //Adicionando BOTÃO DE EXCEL
            {
                init: function (api, node, config) {
                    $(node).removeClass('dt-button')
                },
                extend: 'excel', className: 'ui primary button',
                //Determinando quais colunas sairar quando o EXCEL for gerado
                exportOptions: {
                    // columns: [0, 1, 2, 3, 4]
                }
            },
            //Adicionando BOTÃO DE COLVIS selecionar quais colunas sairão da ação que for executada
            {

                init: function (api, node, config) {
                    $(node).removeClass('dt-button')
                },
                text: 'Selecionar columns',
                extend: 'colvis', className: 'ui primary button',

            },


        ],
        columnDefs: [{
            targets: [5, 7],
            visible: false
        }],

        //Traduzindo a Tabela para o PORTUGUÊS
        "bJQueryUI": true,
        "oLanguage": {
            "lengthChange": false,
            "pageLength": 10,
            "sProcessing": "Processando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Não foram encontrados resultados",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "",
            "sInfoPostFix": "",
            "sSearch": "Pesquisar: ",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primeiro",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        }

    });
    $('#search_dataTables').keyup(function () {
        table.search($(this).val()).draw();
    });
    carregarTipoRegistro();

});
//Função que inicia o DataTable
function listarDados() {
    moment.locale('pt-br');
    //Passando o TOKEN para a tabela
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //Alert da pesquisa da tabela
    $('button').click(function () {
        var data = table.$('input, select').serialize();
        alert(
            "The following data would have been submitted to the server: \n\n" +
            data.substr(0, 120) + '...'
        );
        return false;
    });
}

//Função reecarregar a tabela
function recarregarTable() {
    $('#tabRegistro').DataTable().ajax.reload();

}
function carregarTipoRegistro() {
    $("#registro_tipo").change(function () {
        var valorTipoTranstio = $(this).val();
        table.destroy();
        table = $('#tabRegistro').DataTable({
            order: [[4, "desc"]],
            processing: true,
            serverSide: true,
            dom: 'Bfrtip',
            ajax: {
                url: "/admin/registros/tipo-registro",
                data: {
                    "valorTipoTranstio": valorTipoTranstio
                },
                cache: true,
                type: "POST"
            },
            //Fazendo a listagem dos seguintes dados
            columns: [
                {
                    'data': 'dataDoTransito',
                    "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                        $(nTd).html(moment().subtract(10, 'days').calendar());
                    }
                },
                { data: 'nome', },
                { data: 'identificacao', },
                { data: 'curos_setor', },
                { data: 'descricao_tipo_transito', },
                { data: 'marca', },

                { data: 'telefone', },

                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
            buttons: [
                //Adicionando BOTÃO DE EXCEL
                {
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    },
                    extend: 'excel', className: 'ui primary button',
                    //Determinando quais colunas sairar quando o EXCEL for gerado
                    exportOptions: {
                        // columns: [0, 1, 2, 3, 4]
                    }
                },
                //Adicionando BOTÃO DE PRINT
                {
                    extend: 'print', className: 'ui primary button',
                    customize: function (win) {
                        $(win.document.body).find('table').css('text-align', 'center');
                        $(win.document.body)
                            // .css( 'margin', '150 0 0 0' )
                            .prepend(
                                '<img src="https://ifce.edu.br/maracanau/menu/uploads/marcas-campus-maracanau/logo_ifce_maracanau_horizontal_cor.jpg" style="margin: 0 auto; text-align: center; display: block;" />'
                            );

                    },
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    },
                    title: '',
                    orientation: '',
                    //Determinando quais colunas sairar quando o PRINT for gerado
                    exportOptions: {
                        columns: [':visible']
                    }
                },
                //Adicionando BOTÃO DE COLVIS selecionar quais colunas sairão da ação que for executada
                {
                    init: function (api, node, config) {
                        $(node).removeClass('dt-button')
                    },
                    extend: 'colvis', className: 'ui primary button',

                },


            ],
            columnDefs: [{
                targets: [5, 7],
                visible: false
            }],

            //Traduzindo a Tabela para o PORTUGUÊS
            "bJQueryUI": true,
            "oLanguage": {
                "lengthChange": false,
                "pageLength": 10,
                "sProcessing": "Processando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "Não foram encontrados resultados",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando de 0 até 0 de 0 registros",
                "sInfoFiltered": "",
                "sInfoPostFix": "",
                "sSearch": "Pesquisar: ",
                "sUrl": "",
                "oPaginate": {
                    "sFirst": "Primeiro",
                    "sPrevious": "Anterior",
                    "sNext": "Próximo",
                    "sLast": "Último"
                }
            }

        });
    });
};

function calendario() {
    $('#rangestart').calendar({
        type: 'date',
        endCalendar: $('#rangeend'),
        onChange: function (date, text) {
            var newValue = text;
            var dataFormatada = moment().format('DD-MM-YYYY');


        },
    });
    $('#rangeend').calendar({
        type: 'date',
        startCalendar: $('#rangestart'),
        onChange: function (date, text) {
            var newValue = text;
            ab = moment().format('DD-MM-YYYY');


        },
    });
    $('#registro').addClass('active');
}
/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var min = parseInt($('#min').val(), 10);
        var max = parseInt($('#max').val(), 10);
        var age = parseFloat(data[3]) || 0; // use data for the age column

        if ((isNaN(min) && isNaN(max)) ||
            (isNaN(min) && age <= max) ||
            (min <= age && isNaN(max)) ||
            (min <= age && age <= max)) {
            return true;
        }
        return false;
    }
);

$(document).ready(function () {
    var table = $('#example').DataTable();

    // Event listener to the two range filtering inputs to redraw on input
    $('#min, #max').keyup(function () {
        table.draw();
    });
});
// function dadosDoCondutor() {
//     $("#modal-DadosDoCondutor").show();

// }