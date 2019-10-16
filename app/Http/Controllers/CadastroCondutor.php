<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Condutor;

class CadastroCondutor extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexListagem()
    {
        return view('Administrativo.cadastro-condutor-listagem');
    }

    public function indexJsonListagem()
    {
        $condutores = Condutor::select('condutor_id as id', 'nome', 'identificacao as matricula', 'setor_curso')->get();

        return Datatables::of($condutores)
            ->addColumn('action', function($condutores)
            {
                return '<a class="ui yellow icon button" id="editContato" onclick="editarCondutor('.$condutores->id.')"><i class="edit icon"></i></a> 
                <a class="ui red icon button" id="excluirCondutor" name="excluirCondutor" onclick="excluirCondutor('.$condutores->id.')"><i class="trash icon"></i></a>';
            })->make(true);
        return $condutores;
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
    public function destroy(Request $request)
    {
        $data = Condutor::where('condutor_id', $request->id)->update(['data_de_exclusao' => now()]);
        if ($data) {
            return response()->json(['deletado'=> 'Deletado com sucesso']);
        }
    }
}
