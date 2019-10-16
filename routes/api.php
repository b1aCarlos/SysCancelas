<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/admin/cancelas','TransitoControlador@verificarCondutor');
Route::get('/transito', 'TransitoControlador@indexJson');
Route::get('/transito/emitirsom', 'TransitoControlador@emitirsom')->name('emitirsom');
Route::get('/registros', 'RegistroControlador@indexJson')->name("buscandoregistros");
Route::get('/registros/pdf', 'RegistroControlador@gerarPdf');
Route::get('/cadastroCondutores', 'CadastroCondutores@indexJson');

//Rota GET para popular dados para a tabela da view cadastro-condutor-listagem
Route::get('/cadatros/condutores/listagem', 'CadastroCondutor@indexJsonListagem')->name('api.condutores.listagem');