<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\MapaEfectividade;
use App\Models\MapaEfectividadefalta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MapaEfectividadeController extends Controller
{
    public function indexMapasEfectividade()
    {
       $dados = MapaEfectividade::all();
       $numerOrdem = 1;
       $dados = $dados->mapWithKeys( function($dado)
       use(&$numerOrdem){
           $dado['numerOrdem'] = $numerOrdem ++;
           return [$dado->getKey() => $dado];
       });
       //dd($dados->all());
       return view('sgrhe\pages\tables\mapas-efectividade', compact('dados'));
    }

    /*
    Adicionar Mapa de Efectividades
     */
    public function formMapaEfectividade(Request $request)
    {
        $funcionarios = DB::select('
        select 
        funcionarios.id as id_funcionario, pessoas.id as id_pessoas, unidade_organicas.id as id_unidade_organica, categoria_funcionarios.categoria as categoria_unidade_organica, 
        funcionarios.*, pessoas.*, categoria_funcionarios.*, unidade_organicas.*
            from funcionarios
            join pessoas on pessoas.id=funcionarios.idPessoa
            join categoria_funcionarios on categoria_funcionarios.id=funcionarios.idCategoriaFuncionario
            join unidade_organicas on unidade_organicas.id=funcionarios.idUnidadeOrganica 
        ');
        $idMapaEfectividade = $request->input('idMapaEfectividade');     
        $faltas = MapaEfectividadefalta::where('idMapaEfectividade', $idMapaEfectividade)->get();
        $numerOrdem = 1;
        $faltas = $faltas->mapWithKeys( function($falta)
        use(&$numerOrdem){
            $falta['numerOrdem'] = $numerOrdem ++;
            return [$falta->getKey() => $falta];
        });
        return view('sgrhe\pages\tables\form-mapa-efectividade', compact('funcionarios','idMapaEfectividade','faltas'));
    }

    
    public function addFuncionarioEfectividade(Request $request)
    {
        //dd($request->all());
        //Verificar se 
        $request->validate([

        ]);

        $addFaltas = MapaEfectividadefalta::create([
            'idMapaEfectividade' => $request->input('idMapaEfectividade'),
            'numeroAgente' => $request->input('numeroAgente'),
            'nomeCompleto' => $request->input('nomeCompleto'),
            'eqt' => $request->input('unidadeOrganica'),
            'categoria' => $request->input('categoria'),
        ]);
        //Recuperação de dados do Formulario
        $funcionarios = DB::select('
        select 
        funcionarios.id as id_funcionario, pessoas.id as id_pessoas, unidade_organicas.id as id_unidade_organica, categoria_funcionarios.categoria as categoria_unidade_organica, 
        funcionarios.*, pessoas.*, categoria_funcionarios.*, unidade_organicas.*
            from funcionarios
            join pessoas on pessoas.id=funcionarios.idPessoa
            join categoria_funcionarios on categoria_funcionarios.id=funcionarios.idCategoriaFuncionario
            join unidade_organicas on unidade_organicas.id=funcionarios.idUnidadeOrganica 
        ');
        $idMapaEfectividade = $request->input('idMapaEfectividade');     
        $faltas = MapaEfectividadefalta::where('idMapaEfectividade', $idMapaEfectividade)->get();
        $numerOrdem = 1;
        $faltas = $faltas->mapWithKeys( function($falta)
        use(&$numerOrdem){
            $falta['numerOrdem'] = $numerOrdem ++;
            return [$falta->getKey() => $falta];
        });
        return view('sgrhe\pages\tables\form-mapa-efectividade', compact('funcionarios','idMapaEfectividade','faltas'));
       
    }

    /*
    Criar Mapa de Efectividade
     */
    public function criarMapaEfectividade(Request $request)
    {
        //dd($request->all());
        $mapa = MapaEfectividade::create([
            'dataPeriodo' => $request->input('data'),
            'estado' => 'Aberto'
        ]);
        
        if ($mapa) {
            return redirect()->back()->with('success','Novo mapa abento com Sucesso');
        }else{
            return redirect()->back()->with('error','Erro ao Criar um novo mapa');
        }
        
        
    }

    //Listar Funcionarios
    public function indexFuncionarios()
    {
       //Operacoes de join para varias tabelas relacionadas com funcionarios
       $dados = DB::select('
        select 
        funcionarios.id as id_funcionario, pessoas.id as id_pessoas, unidade_organicas.id as id_unidade_organica, categoria_funcionarios.categoria as categoria_unidade_organica, 
        funcionarios.*, pessoas.*, categoria_funcionarios.*, unidade_organicas.*
            from funcionarios
            join pessoas on pessoas.id=funcionarios.idPessoa
            join categoria_funcionarios on categoria_funcionarios.id=funcionarios.idCategoriaFuncionario
            join unidade_organicas on unidade_organicas.id=funcionarios.idUnidadeOrganica 
       ');  
       return view('sgrhe\pages\tables\form-mapa-efectividade',compact('dados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
 


     /* Remove the specified resource from storage.
     */
    public function aplicarFaltas(Request $request)
    {
        dd($request->all());
    }
}
