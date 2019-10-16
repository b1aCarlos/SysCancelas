<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Administrativo.dashboard');
    }

    public function indexJson()
    {
        $result = array();

        $tipo_usuario = DB::select('SELECT tipo, COUNT(*) as total FROM condutor GROUP BY tipo');
        $result['tipo_usuario'] = $tipo_usuario; 

        $carros = DB::select("SELECT COUNT(veiculo.tipo_veiculo) as quantidade_carro FROM veiculo WHERE veiculo.tipo_veiculo = ?", ['carro']);
        foreach ($carros as $carro) $result['quantidade_carro'] = $carro->quantidade_carro;

        $motos = DB::select("SELECT COUNT(veiculo.tipo_veiculo) as quantidade_moto FROM veiculo WHERE veiculo.tipo_veiculo = ?", ['moto']);
        foreach ($motos as $moto) $result['quantidade_moto'] = $moto->quantidade_moto;
        
        //CONSERTAR TEMPO MEDIO - PERGUNTA O MATEUSOOO PAULO
        // $tempo_medio = DB::select("SELECT (SELECT AVG(data_de_criacao) FROM transito WHERE tipo = 'entrada') AS a, (SELECT AVG(data_de_criacao) FROM transito WHERE tipo = 'saida') AS b, (SELECT SEC_TO_TIME(b - a)) AS media");
        // foreach ($tempo_medio as $media) $result['media'] = $media->media;

        return $result;
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function chartData()
    {

    }
}
