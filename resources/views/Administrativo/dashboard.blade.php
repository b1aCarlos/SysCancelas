@extends('Layout.administrativo')

@section('body')
<div class="ui container containerPrincipal" id="containerToInformations">
    <div class="ui four column stackable grid">
        <div class="four wide column">
            <div class="ui segment" style="background-color: #2DCC70; border-right: #2BB866 4rem solid;">
                <p class="textoQuantidadeAcesso" id="administrativo">0</p>
                <span class="quantidadeAcesso">Administrativos</span>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui segment" style="background-color: #22B8E7; border-right: #21A5CF 4rem solid;">
                <p class="textoQuantidadeAcesso" id="visitantes">0</p>
                <span class="quantidadeAcesso">Visitantes</span>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui segment" style="background-color: #F39C0F; border-right: #DE8B13 4rem solid;">
                <p class="textoQuantidadeAcesso" id="alunos">0</p>
                <span class="quantidadeAcesso">Alunos</span>
            </div>
        </div>
        <div class="four wide column">
            <div class="ui segment" style="background-color: #E74A3C; border-right: #CE4436 4rem solid;">
                <p class="textoQuantidadeAcesso" id="tercerizados">0</p>
                <span class="quantidadeAcesso">Tercerizados</span>
            </div>
        </div>
    </div>
    <div class="ui two column stackable grid">
        <div class="twelve wide column"> 
            <div class="ui segment" style="background-color: #F2F2F2;">
                <div id="grafico-vertical" style="height: 235px;">
                </div>
            </div>
        </div>
        <div class="four wide column" style="text-align: center;"> 
            <div class="ui column stackable grid">
                <div class="column row">
                    <div class="column">
                        <div class="ui segment" style="background-color: #F2F2F2;">
                            <p style="font-size: 1.5rem; margin-bottom: 0%;">Carros</p>                                    
                            <p id="carros" style="font-size: 3rem;">0</p>
                        </div>
                    </div>
                </div>
                <div class="column row">
                    <div class="column">
                        <div class="ui segment" style="background-color: #F2F2F2;">
                            <p style="font-size: 1.5rem; margin-bottom: 0%;">Motos</p>                                    
                            <p id="motos" style="font-size: 3rem;">0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ui two column stackable grid">
        <div class="eight wide column"> 
            <div class="ui segment" style="background-color: #F2F2F2;">
                <div id="grafico-horizontal" style="height: 300px;"></div>
            </div>
        </div>
        <div class="eight wide column"> 
            <div class="ui column stackable grid">
                <div class="column row">
                    <div class="column">
                        <div class="ui segment" style="background-color: #F2F2F2;">
                            <div id="donut" style="height: 150px; margin: 0% !important;"></div>
                        </div>
                    </div>
                </div>
                <div class="column row">
                    <div class="column">
                        <div class="ui segment" style="text-align: center;background-color: #F2F2F2;">
                            <p style="font-size: 1.5rem; margin-bottom: 0%;">Tempo de permanência médio</p>                                    
                            <p id="tempo_medio" style="font-size: 3rem;">00:00:00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('libs/charts/highcharts.js') }}"></script>
<script src="{{ asset('libs/charts/modules/exporting.js') }}"></script>
<script src="{{ asset('libs/charts/modules/export-data.js') }}"></script>
<script src="{{ asset('libs/js/moment.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
@endsection