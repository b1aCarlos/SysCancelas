<?php

namespace App\Http\Controllers;

use App\Condutor;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;



class CadastrarCondutores extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        return view("Administrativo.cadastro-condutores");
    }
    
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($request)
    {
        
        // $create = Condutor::create([
        //     'nome' => $request->nome_pessoa,
        //     'tipo' => $request->tipo_pesssoa,
        //     'setor_curso' =>$request->curso_pessoa,
        //     'identificacao' => $request->identificacao_pessoa,
        //     'cartaoRFID' => (string) $request->numero_cartao,
        //     'imagem_condutor' => $request->identificacao_pessoa.".jpg",
        //     'telefone' => $request->telefone_pessoa,
        //     'email' => $request->email_pessoa
        //     ])->condutor_id;
            
            if ($request->hasFile('uploadFile')) {
                foreach ($request->file('uploadFile') as $arquivo) {
                    foreach ($request->detalhesFile as $detalhes) {
                        dd($detalhes);
                    }
                    // $image = $arquivo;
                    // dd($arquivo);
                    // $name = $image->getClientOriginalName();
                    // $destinationPath = public_path('images');
                    // $image->move($destinationPath, $name);
                    // $imageUpDB = Veiculo::create([
                    //     "condutor_id" => $create,
                    //     "tipo_veiculo" => 'teste',
                    //     "placa" => 'teste',
                    //     "marca" => 'teste',
                    //     "modelo" => 'teste',
                    //     "ano" => 2018,
                    //     "img_veiculo" => 'teste'

                    //     ]);
                    // }
                }

            }
        }
            
            public function validacaoForm(Request $request)
            {
                $response = array();
                
                //regras do validator para o formulário completo.
                $validator = \Validator::make($request->all(), [
                    'identificacao_pessoa' => 'required|numeric',
                    'nome_pessoa' => 'required|string|max:50',
                    'curso_pessoa' => 'required|min:3|string|max:50',
                    'telefone_pessoa' => 'required|string',
                    'numero_cartao' => 'required|numeric',
                    'tipo_pesssoa' => 'required|string',
                    'cpf_pessoa' => 'required|string',
                    'email_pessoa' => 'required|email',
                    'imagem_pessoa' => 'required',
                    'tabela_pesssoa' => 'required|numeric|max:1',
                    ]);
                    
                    if ($validator->fails()) {
                        $response = ["campos_vazios" => $validator->errors()];
                    } else {
                        $condutor_cadastrado = Condutor::where('cartaoRFID', $request->numero_cartao)->count();
                        //verificando se esse condutor já existe no banco do syscancelas
                        if (($condutor_cadastrado == 0 || $condutor_cadastrado == null)) {
                            $dados_condutor = CadastrarCondutores::create($request);
                            if ($dados_condutor) {
                                $response = ["sucesso" => "Cadastrado com sucesso"];
                            } else $response = ["erro" => "Não foi possivel cadastrar no banco."];
                        } 
                        else {
                            $response = ["condutor_cadastrado" => "Esse condutor já existe no sistema!"];
                        }
                    }
                    
                    return response()->json($response);
                }
                
                public function buscaButton(Request $request)
                {
                    $pesquisa = array();
                    $pesquisa['suggestions'] = DB::connection('bancoCentral')->table('pessoa')
                    ->select('nome', 'identificacao' ) 
                    ->join('pessoa_identificacao', 'pessoa_id_fk', 'pessoa_id')
                    ->where('nome', 'like', '%'.$request->data.'%')
                    ->orwhere('identificacao', 'like', '%'.$request->data.'%')
                    ->orwhere('cpf', 'like', '%'.$request->data.'%')
                    ->orwhere('numero_cartao', 'like', '%'.$request->data.'%')
                    ->get();
                    
                    $pesquisa = CadastrarCondutores::conversaoUTF8($pesquisa);
                    return $pesquisa;
                }
                
                
                public static function conversaoUTF8($data)
                {
                    if (is_string($data)) {
                        return utf8_encode($data);
                    } elseif (is_array($data)) {
                        $ret = [];
                        foreach ($data as $i => $d) {
                            $ret[$i] = self::conversaoUTF8($d);
                        }
                        return $ret;
                    } elseif (is_object($data)) {
                        foreach ($data as $i => $d) {
                            $data->$i = self::conversaoUTF8($d);
                        }
                        return $data;
                    } else {
                        return $data;
                    }
                }
                
                /**
                * Busca no Banco Central os dados da pessoa.
                *
                * @param  \Illuminate\Http\Request  $request
                * @return \Illuminate\Http\Response
                */
                public function buscarDadosCondutor(Request $request)
                {
                    $idenficacao = $nome_pessoa = $email = $cpf = $numero_cartao = $request->identificacao;
                    
                    $pessoa = DB::connection('bancoCentral')->select('SELECT 
                    pessoa_identificacao.identificacao as pessoa_identificacao,
                    pessoa.numero_cartao,
                    pessoa.nome, 
                    pessoa.email, 
                    pessoa.celular, 
                    pessoa.cpf, 
                    pessoa.identidade, 
                    pessoa.status, 
                    visitante.prazo_final, 
                    visitante.motivo, 
                    pessoa_tipo.attr as pessoa_tipo, 
                    setor.nome as nome_setor, 
                    curso.nome as nome_curso 
                    FROM pessoa 
                    LEFT JOIN pessoa_identificacao ON pessoa_identificacao.pessoa_id_fk = pessoa.pessoa_id 
                    LEFT JOIN pessoa_tipo_categoria as pessoaTipoCat ON pessoaTipoCat.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN pessoa_identificacao_categoria ON pessoa_identificacao_categoria.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN aluno ON aluno.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN mestrado ON mestrado.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN estagiario estagiario ON estagiario.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN servidor servidor ON servidor.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN terceirizado ON terceirizado.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN visitante visitante ON visitante.pessoa_identificacao_id_fk = pessoa_identificacao.pessoa_identificacao_id 
                    LEFT JOIN pessoa_tipo ON pessoa_tipo.pessoa_tipo_id = pessoa_identificacao.tipo_pessoa_id_fk 
                    LEFT JOIN setor ON setor.setor_id = pessoa_identificacao_categoria.setor_id_fk 
                    LEFT JOIN curso ON curso.curso_id = aluno.curso_id 
                    WHERE 
                    pessoa.email = :email 
                    or pessoa.nome = :nome 
                    or pessoa.cpf = :cpf 
                    or pessoa_identificacao.identificacao = :identificacao 
                    or pessoa.numero_cartao = :numero_cartao
                    and pessoa.status = :status 
                    ORDER BY tipo_pessoa_id_fk ASC', ['identificacao' => $idenficacao, 'numero_cartao' => $numero_cartao, 'cpf' => $cpf, 'nome' => $nome_pessoa, 'email'=>$email, 'status'=> 1]);
                    
                    $pessoa = CadastrarCondutores::conversaoUTF8($pessoa);
                    
                    return response()->json($pessoa);
                }
                
                /**
                * Validação do formulário veiculos com validate.
                *
                * @param  \Illuminate\Http\Request  $request
                * @return \Illuminate\Http\Response
                */
                public function validacaoFormVeiculos(Request $request)
                {
                    //regras do validator.
                    $validator = \Validator::make($request->all(), [
                        'marca' => 'required|max:30|min:3|alpha_dash',
                        'placa' => 'required|max:20|min:6|alpha_dash',
                        'modelo' => 'required|max:30|min:3|alpha_dash',
                        'tipo_veiculo' => 'required',
                        'cor' => 'required|alpha',
                        'ano' => 'required|numeric',
                        ]);
                        
                        //caso houver falha na validações.
                        if ($validator->fails()) {
                            //retorna uma requisição com o erros daquele name.
                            return response()->json(["erros" => $validator->errors()]);
                        }
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
                }
