<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Raspberry;

class RaspController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultaTipo = DB::select('SELECT * FROM tipo_raspberry');
        return view("Administrativo.configuracoes", compact('consultaTipo'));
    }
    
    //Dados dos RaspBerry
    public function raspBerry()
    {
        //Trazendo dos os dados dos RaspBerry do banco de dados
        $raspberry = DB::select('SELECT tipo_raspberry.id_tipo_rasp as id_rasp,tipo_raspberry.nome_tipo_rasp as tipo_raspberry, id_raspberry, raspberry.nome as nome, raspberry.ip as ip FROM raspberry INNER JOIN tipo_raspberry ON raspberry.id_tipo = tipo_raspberry.id_tipo_rasp');
        
        //Criando dos botões via DataTables, e referenciando aos ID dos RaspBerry
        return DataTables::of($raspberry)
            ->addColumn('action', function ($raspberry) {
                return  '<a  onclick="statusRaspBerry(' . $raspberry->id_raspberry . ')" class="ui gren right floated icon button acoes"><i class="eye icon" ></i></a>' .
                        '<a  onclick="editarRaspberry(' . $raspberry->id_raspberry . ')" class="ui yellow right floated icon button acoes"><i class="edit icon" ></i></a>' .
                        '<a  onclick="deletaRaspBerry(' . $raspberry->id_raspberry . ')" class="ui red right floated icon button acoes"><i class="trash icon" ></i></a>';
            })->make(true);
    }


    public function adicionarRaspBerry(Request $request)
    {
        //Criando dados para a tabela Raspberry
        $adicionarraspberry = Raspberry::create([
            'nome' => $request->nomeRasp,
            'ip' => $request->ipDoRasp,
            'id_tipo' => $request->tipoRasp

        ]);
        return response()->json($request);
    }

    public function editarRaspBerry($id)
    {
        //Editando dado pelo ID selecionado
        $editardados = Raspberry::join('tipo_raspberry', 'tipo_raspberry.id_tipo_rasp', 'id_tipo')->find($id);
        return $editardados;
    }

    public function atualizarRaspBerry(Request $request)
    {
        //Atualizando dados do RaspBerry  
        $atualizardados = Raspberry::find($request->idRasp);
        $atualizardados->nome = $request->nomeRasp;
        $atualizardados->ip = $request->ipDoRasp;
        $atualizardados->id_tipo = $request->tipoRasp;
        $atualizardados->update();

        return $atualizardados;
    }

    public function deletarRaspBerry($id)
    {
        //Apagando usuario pelo ID
        Raspberry::destroy($id);
    }
}
