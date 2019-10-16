<?php

namespace App\Http\Controllers;

use App\Condutor;
use App\Transito;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_decode;
use Yajra\DataTables\DataTables;

use PDF;

class RegistroControlador extends Controller
{

    public function index()
    {
        $consultaTipoTransito = DB::select('SELECT * FROM tipo_transito');
        //Retorna a View Registros
        return view('Administrativo.registros', compact('consultaTipoTransito'));
    }

    public function indexJson()
    {
        $registro = DB::select('SELECT 
        tipo_transito.descricao_tipo_transito,
        condutor.setor_curso as curos_setor,
        transito.id_tipo_transito_fk as transitoTipo,
        transito.data_de_criacao as dataDoTransito, condutor.nome,
        condutor.tipo, condutor.identificacao, condutor.telefone,
        condutor.email, veiculo.marca,
        veiculo.modelo, veiculo.ano, veiculo.placa,
        transito.transito_id 
        FROM transito 
        INNER JOIN veiculo ON transito.veiculo_id = veiculo.veiculo_id 
        INNER JOIN tipo_transito ON transito.id_tipo_transito_fk = tipo_transito.id_tipo_transito 
        INNER JOIN condutor ON veiculo.condutor_id = condutor.condutor_id  ORDER by dataDoTransito');

        return Datatables::of($registro)

            ->addColumn('action', function ($registro) {
                return '<a onclick="" class="ui icon  button" id="icon_vieww" target="_blank" ><i class="eye icon" id="icon_view"></i></a>';
            })
            ->make(true);
    }
    public function carregarTipoRegistro(Request $request)
    {
        $valorTipoTransito = $request->valorTipoTranstio;
        if ($valorTipoTransito == 1) {
            $consultaTipoTransito = DB::select('SELECT 
            tipo_transito.descricao_tipo_transito,
            condutor.setor_curso as curos_setor,
            transito.id_tipo_transito_fk as transitoTipo,
            transito.data_de_criacao as dataDoTransito, condutor.nome,
            condutor.tipo, condutor.identificacao, condutor.telefone,
            condutor.email, veiculo.marca,
            veiculo.modelo, veiculo.ano, veiculo.placa,
            transito.transito_id 
            FROM transito 
            INNER JOIN veiculo ON transito.veiculo_id = veiculo.veiculo_id 
            INNER JOIN tipo_transito ON transito.id_tipo_transito_fk = tipo_transito.id_tipo_transito 
            INNER JOIN condutor ON veiculo.condutor_id = condutor.condutor_id ');
        } else {

            $consultaTipoTransito = DB::select('SELECT 
            tipo_transito.descricao_tipo_transito,
            condutor.setor_curso as curos_setor,
            transito.id_tipo_transito_fk as transitoTipo,
            transito.data_de_criacao as dataDoTransito, condutor.nome,
            condutor.tipo, condutor.identificacao, condutor.telefone,
            condutor.email, veiculo.marca,
            veiculo.modelo, veiculo.ano, veiculo.placa,
            transito.transito_id 
            FROM transito 
            INNER JOIN veiculo ON transito.veiculo_id = veiculo.veiculo_id 
            INNER JOIN tipo_transito ON transito.id_tipo_transito_fk = tipo_transito.id_tipo_transito 
            INNER JOIN condutor ON veiculo.condutor_id = condutor.condutor_id 
            WHERE tipo_transito.id_tipo_transito = ?', [$valorTipoTransito]);
        }

        return Datatables::of($consultaTipoTransito)
            ->addColumn('action', function ($consultaTipoTransito) {
                return '<a onclick="" class="ui icon  button" id="icon_vieww" target="_blank" ><i class="eye icon" id="icon_view"></i></a>';
            })
            ->make(true);
    }
    // public function consultaPorData(Request $request)
    // {

    //     $dataDeEntrada = $request->dataDeEntrada;
    //     $dataDeSaida =  $request->dataDeSaida;
    //     $stringDataDeEntrada = $request->dataDeEntrada . '%';
    //     $stringDataDeSaida = $request->dataDeSaida . '%';
    //     if ($dataDeEntrada != null && $dataDeSaida == null) {
    //         $consultaDataEntrada = DB::select('SELECT 
    //         tipo_transito.descricao_tipo_transito,
    //         condutor.setor_curso as curos_setor,
    //         transito.id_tipo_transito_fk as transitoTipo,
    //         transito.data_de_criacao as dataDoTransito, condutor.nome,
    //         condutor.tipo, condutor.identificacao, condutor.telefone,
    //         condutor.email, veiculo.marca,
    //         veiculo.modelo, veiculo.ano, veiculo.placa,
    //         transito.transito_id 
    //         FROM transito 
    //         INNER JOIN veiculo ON transito.veiculo_id = veiculo.veiculo_id 
    //         INNER JOIN tipo_transito ON transito.id_tipo_transito_fk = tipo_transito.id_tipo_transito 
    //         INNER JOIN condutor ON veiculo.condutor_id = condutor.condutor_id 
    //         WHERE transito.data_de_criacao LIKE ?', [$stringDataDeEntrada]);

    //         return Datatables::of($consultaDataEntrada)
    //             ->addColumn('action', function ($consultaDataEntrada) {
    //                 return '<a onclick="" class="ui icon  button" id="icon_vieww" target="_blank" ><i class="eye icon" id="icon_view"></i></a>';
    //             })
    //             ->make(true);
    //     } else if ($dataDeSaida != null && $dataDeEntrada == null) {
    //         $consultaDataSaida = DB::select('SELECT tipo_transito.descricao_tipo_transito,
    //         condutor.setor_curso as curos_setor, 
    //         transito.id_tipo_transito_fk as transitoTipo, transito.data_de_criacao as dataDoTransito, 
    //         condutor.nome, condutor.tipo, condutor.identificacao, condutor.telefone, 
    //         condutor.email, veiculo.marca, veiculo.modelo, veiculo.ano, veiculo.placa, 
    //         transito.transito_id 
    //         FROM transito 
    //         INNER JOIN veiculo ON transito.veiculo_id = veiculo.veiculo_id 
    //         INNER JOIN tipo_transito ON transito.id_tipo_transito_fk = tipo_transito.id_tipo_transito 
    //         INNER JOIN condutor ON veiculo.condutor_id = condutor.condutor_id 
    //         WHERE transito.data_de_criacao LIKE ?', [$stringDataDeSaida]);

    //         return Datatables::of($consultaDataSaida)
    //             ->addColumn('action', function ($consultaDataSaida) {
    //                 return '<a onclick="" class="ui icon  button" id="icon_vieww" target="_blank" ><i class="eye icon" id="icon_view"></i></a>';
    //             })
    //             ->make(true);
    //     } else if($stringDataDeEntrada != null && $stringDataDeSaida != null) {
    //         dd("deu bom");
    //     }else{
    //         dd("aqui deu erro");
    //     }
    // }
}
