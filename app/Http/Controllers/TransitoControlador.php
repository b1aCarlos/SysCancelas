<?php

namespace App\Http\Controllers;

use App\Transito;
use App\Veiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransitoControlador extends Controller
{    
    /**
    * Função de retorno da view ne limpa os arquivos.
    * Finalizado, pronto para testes.
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //Limpando os arquivos de entrada e saída.
        $file_entrada = '../storage/app/public/entrada.txt';
        $file_saida = '../storage/app/public/saida.txt';
        
        //Limpa o arquivo de entrada
        if (unlink($file_entrada)) {
            $file_entrada_aberto = fopen($file_entrada, 'w+');
            if (file_exists($file_entrada)) {
                fclose($file_entrada_aberto);
            }
        }
        
        //Limpa o arquivo de saida
        if (unlink($file_saida)) {
            $file_saida_aberto = fopen($file_saida, 'w+');
            if (file_exists($file_saida)) {
                fclose($file_saida_aberto);
            }
        }
        
        if (file_exists($file_entrada) && file_exists($file_saida)) {
            return view('Administrativo.transito');
        } else {
            return view('Erro.erro');            
        }
    }
    
    /**
    * Função que cadastra o número do cartão.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    
    public function verificarCondutor(Request $request)
    {
        $numero_cartao = $request->cartaoRFID;
        $cancela_tipo = $request->cancela;
        
        $respose = array();
        
        if ((!empty($numero_cartao)) && ($cancela_tipo == 0 || $cancela_tipo == 1)) {            
            // ---------------------- Cancela de Entrada ---------------------- //
            if ($cancela_tipo == 0) {
                $file_entrada = '../storage/app/public/entrada.txt';
                //caso exista o arquivo.
                if (is_readable($file_entrada)) {
                    $arquivo_entrada = fopen($file_entrada, 'w+');
                    if ($arquivo_entrada != false) {
                        //verifica se o arquivo está limpo.
                        $conteudoArquivo = file($file_entrada);
                        if (empty($conteudoArquivo)) {
                            //escrever no arquivo txt
                            if (fwrite($arquivo_entrada, $numero_cartao)) {
                                $respose['data'] =  "Foi possivel escrever no arquivo.";
                            } else {
                                $respose['data'] =  "Não foi possível escrever no arquivo.";
                            }
                        }
                    }
                } 
                
                fclose($arquivo_entrada);
            }
            
            // ---------------------- Cancela de Saída ---------------------- //
            elseif ($cancela_tipo == 1) {
                $file_saida = '../storage/app/public/saida.txt';
                
                //caso exista o arquivo.
                if (is_readable($file_saida)) {
                    $arquivo_saida = fopen($file_saida, 'w+');
                    if ($arquivo_saida != false) {
                        //verifica se o arquivo está limpo.
                        $conteudoArquivo = file($file_saida);
                        if (empty($conteudoArquivo)) {
                            //escrever no arquivo txt
                            if (fwrite($arquivo_saida, $numero_cartao)) {
                                $respose['data'] =  "Não foi possível escrever no arquivo.";
                            } else {
                                $respose['data'] =  "Foi possivel escrever no arquivo.";
                            }
                        } 
                    }
                }
                //fechando arquivo.
                fclose($arquivo_saida);
            }
        }
        return response()->json($respose);
    }
    
    public function indexJson()
    {
        //Declaração de arrays
        $result_dados = array();
        
        //Caminho de arquivos de entrada/saída.
        $file_entrada_ler = '../storage/app/public/entrada.txt';
        $file_saida_ler = '../storage/app/public/saida.txt';
        
        //Verifica o tamanho dos dois arquivos.
        $size_file_entrada = filesize($file_entrada_ler);
        $size_file_saida = filesize($file_saida_ler);
        
        // -------------------- Cancela de Entrada --------------------------- //
        if ($size_file_entrada != 0 && $size_file_saida == 0) {
            //Ler o arquivo de entrada
            $arquivo_entrada = fopen($file_entrada_ler, 'r+');
            
            if ($arquivo_entrada) {
                $codigoCartao = fgets($arquivo_entrada);
                
                if (!empty($codigoCartao)) {
                    //Faz a consulta na tabela condutor
                    $verCondutor = DB::select('SELECT * FROM condutor WHERE cartaoRFID = ? and condutor.data_de_exclusao is null', [$codigoCartao]);
                    
                    if (!empty($verCondutor)) {
                        $result_dados['dadosCondutor'] = $verCondutor;
                        
                        foreach ($verCondutor as $condutorID) {
                            $condutor_id = $condutorID->condutor_id;
                        }
                        
                        //Faz a consulta na tabela veiculo
                        $verVeiculo = DB::select('SELECT * FROM veiculo WHERE condutor_id = ?', [$condutor_id]);
                        $result_dados['dadosVeiculos'] = $verVeiculo;
                        $result_dados['tipo_cancela'] = 2;
                        
                        return response()->json($result_dados);
                    }
                }
            }
        }
        
        // -------------------- Cancela de Saída --------------------------- //
        else if ($size_file_saida != 0 && $size_file_entrada == 0) {
            $arquivo_saida = fopen($file_saida_ler, 'r+');
            if ($arquivo_saida) {
                $codigoCartao = fgets($arquivo_saida);
                if (!empty($codigoCartao)) {
                    //Faz a consulta na tabela condutor
                    $verCondutor = DB::select('SELECT * FROM condutor WHERE cartaoRFID = ? and condutor.data_de_exclusao is null', [$codigoCartao]);
                    
                    if (!empty($verCondutor)) {
                        $result_dados['dadosCondutor'] = $verCondutor;
                        
                        foreach ($verCondutor as $condutorID) {
                            $condutor_id = $condutorID->condutor_id;
                        }
                        
                        //Faz a consulta na tabela veiculo
                        $verVeiculo = DB::select('SELECT * FROM veiculo WHERE condutor_id = ?', [$condutor_id]);
                        $result_dados['dadosVeiculos'] = $verVeiculo;
                        $result_dados['tipo_cancela'] = 3;
                        
                        return response()->json($result_dados);
                    }
                }
            }
        }
        
        // -------------------- Ultimo condutor --------------------------- //
        else {
            $ultimo_condutor = array('arquivo_limpo' => '1');
            
            $consulta_ultimo_cond = DB::select('SELECT condutor.condutor_id as condutor_id, condutor.nome as condutor_nome, condutor.imagem_condutor, identificacao, condutor.tipo as tipo_pessoa, condutor.setor_curso as curso_setor, condutor.telefone as contato, veiculo_id FROM transito INNER JOIN condutor ON condutor.condutor_id = transito.condutor_id WHERE condutor.data_de_exclusao is null ORDER BY transito.data_de_criacao DESC LIMIT 1');
            
            $ultimo_condutor['consultaUltimoCondutor'] = $consulta_ultimo_cond;   
            
            $condutor_id =  $consulta_ultimo_cond[0]->condutor_id;
            $veiculo_id =  $consulta_ultimo_cond[0]->veiculo_id;
            
            if (empty($veiculo_id)) {
                $ultimo_condutor['dadosVeiculos'] = 0;   
            } else{
                $ultimo_condutor['dadosVeiculos'] = DB::select('SELECT * FROM veiculo WHERE condutor_id = ?', [$condutor_id]);
            }
            
            return $ultimo_condutor;
        }
    }
    
    //Cadastro de transito automatico/manual
    public function transito(Request $request)
    {
        $transito = new Transito();

        $tipo_transito = $request->tipo_transito;
        $id_condutor = $request->condutor_id;
        $tipo_cancela = $request->tipo_cancela;
        
        if (($tipo_transito == 'automatico' && !empty($id_condutor)) && (!empty($tipo_cancela)) ) {
            
            if ($tipo_cancela == 2) {
                $transito->condutor_id = $id_condutor;
                $transito->id_tipo_transito_fk = 2;
                $transito->data_de_criacao = now();
                $transito->save();
                
                if ($transito) {
                    $file_entrada = '../storage/app/public/entrada.txt';
                    $file_mensagem = '../storage/app/public/mensagem.txt';
                    
                    //limpa o arquivo de entrada
                    if (unlink($file_entrada)) {
                        $file_entrada_aberto = fopen($file_entrada, 'w+');
                        if (file_exists($file_entrada)) {
                            fclose($file_entrada_aberto);
                            
                            //Escreve a mensagem, no arquivo de mensagem
                            $arquivo_mensagem = fopen($file_mensagem, 'w+');
                            
                            if ($arquivo_mensagem != false) {
                                //escrever a mensagem de erro.
                                if (!fwrite($arquivo_mensagem, 1)) {
                                    fclose($arquivo_mensagem);
                                }
                            }
                        }
                    } else {
                        echo "não deu bom";
                    }
                } else {
                    //retornar um erro no arquivo de mensagem
                }
            }
            //transito de saida
            else if($tipo_cancela == 3){
                $transito->condutor_id = $id_condutor;
                $transito->id_tipo_transito_fk = 3;
                $transito->data_de_criacao = now();
                $transito->ultima_atualizacao = now();
                $transito->save();
                
                if ($transito) {
                    $file_saida = '../storage/app/public/saida.txt';
                    $file_mensagem = '../storage/app/public/mensagem.txt';
                    
                    //limpa o arquivo de entrada
                    if (unlink($file_saida)) {
                        $file_saida_aberto = fopen($file_saida, 'w+');
                        if (file_exists($file_saida)) {
                            fclose($file_saida_aberto);
                            
                            //Escreve a mensagem, no arquivo de mensagem
                            $arquivo_mensagem = fopen($file_mensagem, 'w+');
                            
                            if ($arquivo_mensagem != false) {
                                //escrever a mensagem de erro.
                                if (!fwrite($arquivo_mensagem, 1));
                                fclose($arquivo_mensagem);
                            }
                        }
                    } else {
                        echo "não deu bom";
                    }
                }
            }
        }
        else
        {
            $veiculo_id = $request->veiculo_id;

            if ($tipo_cancela == 2) {
                $transito->condutor_id = $id_condutor;
                $transito->veiculo_id = $veiculo_id;
                $transito->id_tipo_transito_fk = 2;
                $transito->data_de_criacao = now();
                $transito->save();
                
                if ($transito) {
                    $file_entrada = '../storage/app/public/entrada.txt';
                    $file_mensagem = '../storage/app/public/mensagem.txt';
                    
                    //limpa o arquivo de entrada
                    if (unlink($file_entrada)) {
                        $file_entrada_aberto = fopen($file_entrada, 'w+');
                        if (file_exists($file_entrada)) {
                            fclose($file_entrada_aberto);
                            
                            //Escreve a mensagem, no arquivo de mensagem
                            $arquivo_mensagem = fopen($file_mensagem, 'w+');
                            
                            if ($arquivo_mensagem != false) {
                                //escrever a mensagem de erro.
                                if (!fwrite($arquivo_mensagem, 1)) {
                                    fclose($arquivo_mensagem);
                                }
                            }
                        }
                    } else {
                        echo "não deu bom";
                    }
                } else {
                    //retornar um erro no arquivo de mensagem
                }
            }
            //transito de saida
            else if($tipo_cancela == 3){
                $transito->condutor_id = $id_condutor;
                $transito->veiculo_id = $veiculo_id;
                $transito->id_tipo_transito_fk = 3;
                $transito->data_de_criacao = now();
                $transito->ultima_atualizacao = now();
                $transito->save();
                
                if ($transito) {
                    $file_saida = '../storage/app/public/saida.txt';
                    $file_mensagem = '../storage/app/public/mensagem.txt';
                    
                    //limpa o arquivo de entrada
                    if (unlink($file_saida)) {
                        $file_saida_aberto = fopen($file_saida, 'w+');
                        if (file_exists($file_saida)) {
                            fclose($file_saida_aberto);
                            
                            //Escreve a mensagem, no arquivo de mensagem
                            $arquivo_mensagem = fopen($file_mensagem, 'w+');
                            
                            if ($arquivo_mensagem != false) {
                                //escrever a mensagem de erro.
                                if (!fwrite($arquivo_mensagem, 1));
                                fclose($arquivo_mensagem);
                            }
                        }
                    } else {
                        echo "não deu bom";
                    }
                }
            }
            return response()->json("deu bom transito manual"); 
        }
    }

    public function buscaVeiculo(Request $request)
    {
        $veiculos = DB::select('SELECT veiculo.* FROM veiculo INNER JOIN condutor ON condutor.condutor_id = veiculo.condutor_id WHERE condutor.condutor_id = :id', ['id'=>$request->id]);
        return response()->json($veiculos);
    }
    
    //emitir som e apagar arquivo de mensagem.
    public function emitirMensagem()
    {
        $file_mensagem = '../storage/app/public/mensagem.txt';
        if (is_readable($file_mensagem)) {
            $arquivo_mensagem = fopen($file_mensagem, 'a+');
            $codigoMensagem = fgets($arquivo_mensagem);
            if (!empty($codigoMensagem)) {
                fclose($arquivo_mensagem);
                if (unlink($file_mensagem)) {
                    $file_mensagem_aberto = fopen($file_mensagem, 'w+');
                    fclose($file_mensagem_aberto);
                    return $codigoMensagem;
                }
            }
        }
    }
    
    //validar essa função
    public function ultimosTransitos()
    {
        $ultimosTransitos = DB::select('SELECT condutor.nome as condutor_nome  FROM transito INNER JOIN condutor ON condutor.condutor_id = transito.condutor_id ORDER by transito.ultima_atualizacao DESC LIMIT 11');
        
        return $ultimosTransitos;
    }
}
