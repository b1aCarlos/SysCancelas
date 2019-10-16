@extends('Layout.administrativo')

@section('body')
<div class="ui container containerPrincipal segment" id="containerToInformations">
    <div class="ui tablet only mobile only three column doubling grid">
        <div class="column">
            <h1 class="textoTopoOuvidoria"><i class="plus square icon"></i>&nbsp;Cadastro de condutores</h1>
        </div>
        <div class="column">
            <a href="javascript:history.back()" class="ui blue right floated button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Voltar</font></font></a>
        </div>
    </div>
    <div class="ui computer only two column doubling grid">
        <div class="column">
            <h1 class="textoTopoOuvidoria"><i class="plus square icon"></i>&nbsp;Cadastro de condutores</h1>
        </div>
        <div class="column">
            <a href="javascript:history.back()" class="ui blue right floated button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Voltar</font></font></a>
        </div>
    </div>
    <div class="ui divider"></div>        
    <div class="ui two column stackable grid">
        <div class="column">
            <h4 class="ui header">Possibilita a adição, edição e exclusão de condutores no sistema.</h4>
        </div>
        <div class="column">
            <div class="ui small icon input" style="float: right;">
                <input type="text" placeholder="Pesquisa" id="campo_pesquisa" name="campo_pesquisa" style="width: 300px;" autofocus>
                <i class="search icon"></i>
            </div>
        </div>
    </div>
    <div class="ui tablet only mobile only three column doubling grid">
        <div class="column">
            <h2>Dados do condutor</h2>
        </div>
        <div class="column" style="text-align: right;">
            <div class="ui toggle checkbox">
                <input type="checkbox" name="check-visitante" id="check-visitante">
                <label>Visitante</label>
            </div>
        </div>
    </div>
    <div class="ui computer only two column doubling grid">
        <div class="column">
            <h2>Dados do condutor</h2>
        </div>
        <div class="column" style="text-align: right;">
            <div class="ui toggle checkbox">
                <input type="checkbox" name="check-visitante" id="check-visitante">
                <label>Visitante</label>
            </div>
        </div>
    </div>
    <form class="ui form" id="cadastro_condutor" name="cadastro_condutor" method="POST">
        <div class="ui divider"></div>   
        <div class="ui three column doubling stackable grid">
            <div class="column">
                <div class="ui special cards">
                    <div class="card">
                        <div class="blurring dimmable image" >
                            <div class="ui dimmer">
                                <div class="content">
                                    <div class="center">
                                        <div class="ui inverted button btn-file">
                                            <span id="text-btn-file">Adicionar foto</span> 
                                            <input type="file" id="upload_imagem_pessoa">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <img src="{{ asset('img/image.png') }}" id="imagem_pessoa">
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="field">
                    <label>Identificação:</label>
                    <input type="text" name="identificacao_pessoa" id="identificacao_pessoa">
                </div>
                <div class="field">
                    <label>Nome:</label>
                    <input type="text" name="nome_pessoa" id="nome_pessoa">
                </div>
                <div class="field">
                    <label>Curso/Setor:</label>
                    <input type="text" name="curso_pessoa" id="curso_pessoa">
                </div>
                <div class="field">
                    <label>Telefone:</label>
                    <input type="text" name="telefone_pessoa" id="telefone_pessoa">
                </div> 
            </div>
            <div class="column">
                <div class="field">
                    <label>Número do cartão:</label>
                    <input type="text" id="numero_cartao" name="numero_cartao">
                </div>
                <div class="field">
                    <label>Tipo:</label>
                    <input type="text" name="tipo_pesssoa" id="tipo_pessoa">
                </div>
                
                <div class="field">
                    <label>CPF:</label>
                    <input type="text" name="cpf_pessoa" id="cpf_pessoa">
                </div>
                <div class="field">
                    <label>E-mail:</label>
                    <input type="text" name="email_pessoa" id="email_pessoa">
                </div>
            </div>
        </div>
        <div class="ui tablet only mobile only three column doubling grid">
            <div class="column">
                <h2 class="textoTopoOuvidoria">Veiculos cadatrados</h2>
            </div>
            <div class="column">
                <a href="javascript:history.back()" class="ui blue right floated button"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novo</font></font></a>
            </div>
        </div>
        <div class="ui computer only two column doubling grid">
            <div class="column">
                <h2 class="textoTopoOuvidoria">Veiculos cadatrados</h2>
            </div>
            <div class="column">
                <button type="button" class="ui blue right floated button" id="novo_cadastro_veiculo"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Novo</font></font></button>
            </div>
        </div>    
        <div class="ui divider"></div>  
        <div class="ui stackable blurring tree column grid" id="veiculos">
            <div class="five wide column classVeiculos" id="cardNCadastrado">
                <div class="ui link card">
                    <div class="image">
                        <img class="ui small rounded image" src="{{ asset('img/image.png') }}">
                    </div>
                    <div class="content ui bottom attached button" style="background-color: red; height: 60px !important;">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit; color: white; padding-top: 3px;">
                                Não cadastrado
                            </font>
                        </font>
                    </div>
                </div>
            </div>
        </div>
        <div id="butons" style="text-align: right !important;">
            <button class="ui red button" id="limpar_tela" name="limpar_tela">Limpar</button>
            <button class="ui button" type="submit" style="background-color: #006944 !important; color: white;" id="buttonSalvarForm">Salvar</button>
        </div>
    </form>
    
    {{-- Modal de cadatsro de veiculos --}}
    <div class="ui large modal" id="modalCadastroVeiculos">
        <i class="close icon"></i>
        <div class="header">
            <h2 class="textoTopoOuvidoria" style="color: #006944;"><i class="plus square icon"></i>&nbsp;Cadastro de veículo</h2>
        </div>
        <div class="content">
            <form class="ui form" id="formulario_veiculos">
                {{ csrf_field()}}
                {{method_field('POST')}}
                <div class="ui three column doubling stackable grid">
                    <div class="column">
                        <div class="ui special cards">
                            <div class="card">
                                <div class="blurring dimmable image" >
                                    <div class="ui dimmer">
                                        <div class="content">
                                            <div class="center">
                                                <div class="ui inverted button btn-file">
                                                    <span id="text-btn-file">Adicionar foto</span> 
                                                    <input type="file" id="upload_imagem_veiculo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ asset('img/image.png') }}" id="imagem_veiculo">
                                </div>
                            </div>
                        </div>
                        <span id="msg_erros" class="upload_imagem_veiculo"></span>
                    </div>
                    <div class="column">
                        <div class="field inputsFormVeiculo" id="d_tipo_veiculo" >
                            <label>Veiculo:</label>
                            <select multiple="tipo_veiculo" id="tipo_veiculo" name="tipo_veiculo" class="ui search dropdown">
                                <option value="">Selecione um veículo:</option>
                                <option id="carro" value="carro">Carro</option>
                                <option id="moto" value="moto">Moto</option>
                            </select>
                            <span id="msg_erros" class="tipo_veiculo"></span>
                        </div>
                        <div class="field inputsFormVeiculo" id="d_modelo">
                            <label>Modelo</label>
                            <input type="text" name="modelo" id="modelo">
                            <span id="msg_erros" class="modelo"></span>
                        </div>
                        {{--  <div class="field" id="d_cor" style="">
                            <label>Cor</label>
                            <input type="text" name="cor" id="cor">
                            <span id="msg_erros" class="cor"></span>
                        </div>  --}}
                        <div class="field" id="d_cor">
                            <label>Cor:</label>
                            <div class="ui fluid search selection dropdown">
                                <input type="hidden" name="cor">
                                <i class="dropdown icon"></i>
                                <div class="default text">Selecione a cor:</div>
                                <div class="menu">
                                    <div class="item" data-value="branco"><i class="stop icon" style="color:white"></i>Branco</div>
                                    <div class="item" data-value="preto"><i class="stop icon" style="color:black"></i>Preto</div>
                                    <div class="item" data-value="prata"><i class="stop icon" style="color:silver"></i>Prata</div>
                                    <div class="item" data-value="vermelho"><i class="stop icon" style="color:red"></i>Vermelho</div>
                                    <div class="item" data-value="azul"><i class="stop icon" style="color:blue"></i>Azul</div>
                                    <div class="item" data-value="verde"><i class="stop icon" style="color:green"></i>Verde</div>
                                    <div class="item" data-value="bege"><i class="stop icon" style="color:beige"></i>Bege</div>
                                    <div class="item" data-value="dourado"><i class="stop icon" style="color:
                                        #E4BF52"></i>Dourado</div>
                                        <div class="item" data-value="amarelo"><i class="stop icon" style="color:yellow"></i>Amarelo</div>
                                        <div class="item" data-value="laranja"><i class="stop icon" style="color:orange"></i>Laranja</div>
                                    </div>
                                </div>
                                <span id="msg_erros" class="cor"></span>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field inputsFormVeiculo" id="d_placa">
                                <label>Placa</label>
                                <input type="text" name="placa" id="placa">
                                <span id="msg_erros" class="placa"></span>
                            </div>
                            <div class="field inputsFormVeiculo" id="d_marca">
                                <label>Marca</label>
                                <input type="text" name="marca" id="marca" min="3" max="30">
                                <span id="msg_erros" class="marca"></span>
                            </div>
                            <div class="field" id="d_ano" style="">
                                <label>Ano</label>
                                <input type="text" name="ano" id="ano" min="4" max="5">
                                <span id="msg_erros" class="ano"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="actions">
                    <div class="ui red button" id="limpar_modal_veiculo">
                        Limpar
                    </div>
                    <button id="salvar_modal" type="submit" class="ui right button"  style="background-color: #006944 !important; color: white;">
                        Salvar
                    </button>
                </div>
            </form>
        </div>    
    </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/cadastro2.css') }}">
@endsection

@section('js')
<script src="{{ asset('js/cadastro-condutores.js') }}"></script>
<script src="{{ asset('libs/js/jquery.mask.js') }}"></script>
<script src="{{ asset('libs/js/sweetalert2.all.min.js') }}"></script>
@endsection