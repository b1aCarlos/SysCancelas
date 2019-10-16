@extends('Layout.administrativo')
@section('body')
<div class="formulario-cancelas"> 
    <div class="ui container containerPrincipal" id="containerToInformations" style="">
        <h1 class="textoTopoOuvidoria"><i class="users icon"></i> &nbsp;&nbsp;Cancelas</h1>
        
        <form class="ui form segment" id="formProd" method="POST">
            {{ csrf_field()}}
            {{method_field('POST')}}
            <h2 class="ui dividing header">Entrada</h2>
            <div class="ui centered grid">
                <div class="row">
                    <div class="seven wide column">
                        <div class="required field somenteNumero">
                            <label>Cartão</label>
                            <input type="text" name="cartaoRFID" id="cartaoRFID" placeholder="Cartão RFID" autofocus>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('libs/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/semantic.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('libs/js/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/cancela_entrada.js') }}"></script>
@endsection
                            
                            