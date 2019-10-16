<?php

use App\Raspberry;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/****************** Rotas do LOGIN *******************/
//Rota de login
Route::get('/', function () {
    return view('Login.login');
})->name('login');

//Rota para resetar senha (Esqueceu sua senha)
Route::get('/password/reset', function () {
    return view('forgot-password');
})->name('reset-password');

/****************** Rotas das CANCELAS *******************/
Route::group(['prefix' => 'cancela'], function () {
    //Rota para a cencela ENTRADA (okay)
    Route::get('/entrada', function () {
        return view('Cancelas.entrada');
    })->name('cancela.entrada');
    
    //Rota para a cencela ENTRADA
    Route::get('/saida', function () {
        return view('Cancelas.saida');
    })->name('cancela.saida');
});

/****************** Rotas do ADMINISTRATIVO *******************/
Route::group(['prefix' => 'admin'], function () {
    //Visulizar view página inicial
    Route::get('/', 'DashboardControlador@index')->name('view.inicial');

    //Dados do Dashboard
    Route::get('/ver', 'DashboardControlador@indexJson');
    
    //Visualizar cadastro Listagem
    Route::get('/cadastros/condutor', 'CadastroCondutor@indexListagem')->name('view.cadastros.condutores');
    Route::post('/cadastros/condutor/excluir', 'CadastroCondutor@destroy')->name('view.cadastros.excluir');
    
    //Visualizar cadastro Condutores
    Route::get('/cadastro/condutor', 'CadastrarCondutores@index')->name('view.cadastro.condutor');
    Route::any('/cadastro/condutor/ver', 'CadastrarCondutores@buscarDadosCondutor')->name('cadastro.condutor.ver');
    Route::any('/cadastro/autocomplete/{data}', 'CadastrarCondutores@buscaButton')->name('cadastro.condutor.button');
    Route::any('/cadastro/condutor/teste', function()
    {
        return view("Administrativo.teste");
    })->name('cadastro.condutor.ver');
    
    Route::post('/cadastro/condutor/cadastrar/validacao', 'CadastrarCondutores@validacaoForm');
    
    //validação do form veiculos
    Route::any('/cadastro/condutor/validacao', 'CadastrarCondutores@validacaoFormVeiculos')->name('cadastro.condutor.validacao');

    // Route::get('/camera/ver/botoes', 'CameraControlador@retornoSom');
    //*****************************************************************************
    Route::get('/camera', 'CameraControlador@indexSons');
    Route::get('/camera/ver', 'CameraControlador@pingRasp');
    Route::get('/camera/ver/cancela', 'CameraControlador@indexJson');
    Route::any('/camera/cancelas', 'CameraControlador@verificarcancela');
    Route::get('/camera/emitir-som-entrada', 'CameraControlador@emitirSonsEntrada')->name('emitirsom');
    Route::get('/camera/emitir-som-saida', 'CameraControlador@emitirSonsSaida')->name('emitirsom');


    //*****************************************************************************

    
    //Visualizar transitos
    Route::get('/transitos', 'TransitoControlador@index')->name('view.transitos');
    Route::get('/transitos/ver', 'TransitoControlador@indexJson');
    // Route::get('/transitos/ver', 'TransitoControlador@indexJson');
    Route::get('/transitos/ver/ultimos-transitos', 'TransitoControlador@ultimosTransitos');
    Route::any('/transitos/ver/cadastro-transito', 'TransitoControlador@transito')->name('Cadastro.Transito');
    Route::get('/transitos/ver/emitir-som', 'TransitoControlador@emitirMensagem')->name('emitirsom');
    Route::any('/transitos/cancelas', 'TransitoControlador@verificarCondutor')->name('transito');
    //trazer informações do veiculo do condutor
    
    Route::post('/condutores/veiculos/busca-veiculo', 'TransitoControlador@buscaVeiculo');
    

    //Visualizar registros
    Route::get('/registros', 'RegistroControlador@index')->name('view.registros');
    //Trazendo dados do select -  Registro
    Route::get('/registros/ver', 'RegistroControlador@indexJson')->name('buscandoDados');
    //Trazendo todos os dados referente ao valor selecionado
    Route::any('/registros/tipo-registro', 'RegistroControlador@carregarTipoRegistro')->name('consultaTipoDeTranstio');
    Route::any('/registros/consultaDatas', 'RegistroControlador@consultaPorData')->name('consultaPorDataDeTransito');



    
    //View de Ajuda
    Route::get('/ajuda', function () {
        return view('Administrativo.ajuda');
    });
    //View de Configurações
    Route::get('/configuracoes', function () {
        return view('Administrativo.configuracoes');
    });
    //akjdolaksjkldjaklsjlkdaksj klajskldjklasjlkdjkas 
    Route::get('configuracoes', 'RaspController@index')->name('raspberry.ip');
    //Raspberry dados
    Route::get('configuracoes/ver', 'RaspController@raspBerry')->name('raspberry.ip');
    //Passando ID do RaspBerry para chamar os dados referente ao ID selecionado
    Route::get('configuracoes/{id_raspberry}/editar', 'RaspController@editarRaspBerry')->name('editRaspberry.ip');
     //Passando ID do RaspBerry para chamar os dados referente ao ID selecionado
     Route::get('configuracoes/{id_raspberry}/listar', 'RaspController@editarRaspBerry')->name('listarRaspberry.ip');
    //Cadastrar RaspBerry
    Route::post('configuracoes/cadastrar', 'RaspController@adicionarRaspBerry')->name('cadastrarRaspberry');
    //Atualizar dados do RaspBerry
    Route::post('configuracoes/atualizar', 'RaspController@atualizarRaspBerry')->name('a5tualizarRaspberry');
    //Apagar RaspBerry
    Route::delete('configuracoes/{id_raspberry}/apagar', 'RaspController@deletarRaspBerry')->name('deletarRaspberry.ip');



    Route::any('rota', 'RegistroControlador@index')->name('555');

});