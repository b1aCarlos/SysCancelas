@extends('Layout.administrativo')
@section('body')
<div class="ui container segment containerPrincipal" id="containerToInformations">
    <button onclick="adicionarRaspberry()" class="ui blue right floated button" type="button" id="btn-adicionar-rasp">
        <font style="vertical-align: inherit;">
            <font style="vertical-align: inherit;">Novo</font>
        </font>
    </button>
    <h1>Configurações</h1>

    <div class="ui divider"></div>
    <br />
    <table class="ui green celled table" name="tabelaRasp" id="tabRasp" style="text-align: center;">
        <thead>
            <tr>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">ID</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nome</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">IP</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Tipo</font>
                    </font>
                </th>
                <th id="acoes_rasp">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Ações</font>
                    </font>
                </th>
            </tr>
        </thead>
    </table>
</div>
@include('Administrativo.modal-cadastrar-rasp')
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/config-raspberry.css') }}">
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('libs/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/dataTables.semanticui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/raspberry.js') }}"></script>
@endsection