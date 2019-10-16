@extends('Layout.administrativo')

@section('body')
<div class="ui container containerPrincipal segment" id="containerToInformations">
    <div class="ui two column stackable grid">
        <div class="column">
            <h1 class="textoTopoOuvidoria">Cadastros</h1>
        </div>
        <div class="column">
            <a href="{{ route('view.cadastro.condutor') }}" class="ui blue right floated button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novo</font></font></a>
        </div>
    </div>
    <div class="ui divider"></div>        
    <form class="ui form">
        <h4 class="ui header">Possibilita a adição, edição e exclusão de condutores no sistema.</h4>
        <table class="ui celled center aligned green table" id="tabela-condutores">
            <thead>
                <tr>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Nome</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Matrícula</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Setor/Curso</font></font></th>
                    <th><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Ações</font></font></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </form>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('libs/js/jquery.min.js') }}"></script>
<script src="{{ asset('libs/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('libs/js/semantic.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('libs/js/dataTables.semanticui.min.js') }}" ></script>
<script type="text/javascript" src="{{ asset('js/cadastro-condutor-listagem.js') }}" ></script>
<script src="{{ asset('libs/js/sweetalert2.all.min.js') }}"></script>
{{--  <script src="{{ asset('libs/js/Portuguese-Brasil.lang.js') }}"></script>  --}}

@endsection