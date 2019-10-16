@extends('Layout.administrativo')
@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/camera.css') }}" /> --}}
@endsection
@section('body')
<div class="ui container containerPrincipal" id="containerToInformations" style="">
    <div class="ui three column stackable grid">
        <div class="one wide column"></div>
        <div class="seven wide column">
            <h2 class="ui header">Cancela de entrada</h2>
            <div class="ui divider"></div>
            <div class="status_entrada" id="status_entrada"></div>
            <h4 class="ui header">Mensagem ao condutor:</h4>
            <button  value="1" id="emitirSomEntrada_porfavor" data-cancela_tipo = '0' class="ui fluid button btn_entrada" style="margin-bottom: 5px;">Por favor, identifique-se!</button>
            <button  value="2" id="emitirSomEntrada-sistena"  data-cancela_tipo = '0' class="ui fluid button btn_entrada"  style="margin-bottom: 5px;">O sistema não está funcionando.</button> 
            <button  value="3" id="emitirSomEntrada-cartao"   data-cancela_tipo = '0' class="ui fluid button btn_entrada"  style="margin-bottom: 10px;">Seu cartão não está funcionando.</button>
            <div class="ui fluid" id="myImg2" style="cursor: nwse-resize;"  placeholder="First name">
                    {{--  <img class="image" style="padding: 0%;" width="100%" src="http://admin:gI6TBRMT@10.50.0.110/video/mjpg.cgi?profileid=3">  --}}
            </div>
            
            <div class="ui modal" id="myImg2modal">
                <div class="image content">
                    {{--  <img class="image" style="padding: 0%;" width="100%" src="http://admin:gI6TBRMT@10.50.0.110/video/mjpg.cgi?profileid=3">  --}}
                </div>
            </div>
        </div>
        <div class="seven wide column">
            <h2 class="ui header">Cancela de saída</h2>
            <div class="ui divider"></div>
            <div class="status_saida" id="status_saida"></div>
            <h4 class="ui header">Mensagem ao condutor:</h4>
            <button value="4" class="ui fluid button btn_entrada" id="emitirSomSaida-porfavor" data-cancela_tipo = '1' style="margin-bottom: 5px;">Por favor, identifique-se!</button>
            <button value="5" class="ui fluid button btn_entrada" id="emitirSomSaida-sistena"  data-cancela_tipo = '1' style="margin-bottom: 5px;">O sistema não está funcionando.</button> 
            <button value="6" class="ui fluid button btn_entrada" id="emitirSomSaida-cartao"   data-cancela_tipo = '1'style="margin-bottom: 10px;">Seu cartão não está funcionando.</button>
            <div class="ui fluid centered" id="myImg">
                <img id="myImg"  class="ui fluid image">
            </div> 
            <div class="ui modal" id="cam2">
                <div class="image content">
                    {{--  <img class="image" width="100%" src="http://admin:5OE1zAL7@10.50.0.111/video/mjpg.cgi?profileid=3">  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('libs/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/semantic.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('libs/js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/camera.js') }} "></script>
@endsection