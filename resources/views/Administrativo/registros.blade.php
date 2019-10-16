@extends('Layout.administrativo')
@section('body')
<style>
    #tabRegistro_filter {
        display: none;
    }

    div.dt-buttons{
        margin-bottom: 10px;
        
    }
</style>
<div class="ui container segment containerPrincipal" id="containerToInformations">
    <h1 class="header"><i class="list icon active"></i> Registros de Trânsito</h1>
    <div class="ui divider"></div>
    <form class="ui form">
        <div class="field">
            <div class="field">
                <div class="three fields">
                    <div class="eight wide field">
                        <label>Tipo de registro:</label>
                        <select class="ui dropdown" id="registro_tipo">
                            <option value=""> Selecione o tipo do transito</option>
                            @foreach ($consultaTipoTransito as $tipo)
                            <option value="{{ $tipo->id_tipo_transito }}">{{ $tipo->descricao_tipo_transito }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="eight wide field">
                        <label>Data de Inicial</label>
                        <div class="ui calendar" id="rangestart">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" placeholder="Start">
                            </div>
                        </div>
                    </div>
                    <div class="eight wide field">
                        <label>Data de Termino</label>
                        <div class="ui calendar" id="rangeend">
                            <div class="ui input left icon">
                                <i class="calendar icon"></i>
                                <input type="text" placeholder="End">
                            </div>
                        </div>
                    </div>
                    <div class="eight wide field">
                        <label>Pesquisar:</label>
                        <span class="ui input">
                            <input id="search_dataTables" type="search" class="" placeholder=""
                                aria-controls="tabRegistro">
                        </span>
                        </span>
                    </div>
                </div>
            </div>
            <br />
        </div>
    </form>
    <table class="ui green celled table" name="tabelaRegistros" id="tabRegistro" style="text-align: center; margin-top: 2%;">
        <thead>
            <tr>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Data do Trânsito</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Condutor</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Identificação</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Curso/Setor</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">E/S</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Marca</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Tele</font>
                    </font>
                </th>
                <th>
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Ações</font>
                    </font>
                </th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('libs/js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/dataTables.semanticui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/dataTables.buttons.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/buttons.flash.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/registro-transito.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/calendar.min.js') }}"></script>


{{--  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  --}}
@endsection