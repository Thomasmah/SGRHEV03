<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\MapaEfectividade;
use App\Models\MapaEfectividadefalta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

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
    public function formMapaEfectividade(string $idMapaEfectividade)
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
        $faltas = MapaEfectividadefalta::where('idMapaEfectividade', $idMapaEfectividade)->get();
        return view('sgrhe\pages\tables\form-mapa-efectividade', compact('funcionarios','idMapaEfectividade','faltas'));
    }

    
    public function addFuncionarioEfectividade(Request $request)
    {
        dd($request->all());
        //Validade de modo a evitar a duplcacao de funcionarios dentro do mesmo mapa de Efectividade
        $request->validate([
   
        ]);
        $funcionario = MapaEfectividadefalta::where('idMapaEfectividade', $request->input('idMapaEfectividade'))->where('numeroAgente', $request->input('numeroAgente'))->first();
        if ($funcionario == NULL) {
            DB::beginTransaction();
            $addFaltas = MapaEfectividadefalta::create([
                'idMapaEfectividade' => $request->input('idMapaEfectividade'),
                'numeroAgente' => $request->input('numeroAgente'),
                'nomeCompleto' => $request->input('nomeCompleto'),
                'eqt' => $request->input('unidadeOrganica'),
                'categoria' => $request->input('categoria'),
            ]);
            if ($addFaltas) {
                DB::commit();
                return redirect()->back()->with('success', 'O Funcionário(a) '.$request->input('nomeCompleto').', foi Adicionado ao Mapa com Sucesso!');//->route('form.mapa.efectividade', ['idMapaEfectividade' => $request->input('idMapaEfectividade')]);
            }else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Erro ao adicionar o Funcinario '.$request->input('nomeCompleto').'!');
            }
        }else {
            return redirect()->back()->with('error', 'O Funcionário '.$request->input('nomeCompleto').' já se encontra no Mapa!');
        }
 
      
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
        DB::beginTransaction();
        $mapaFaltas = MapaEfectividadefalta::where('idMapaEfectividade', $request->idMapaEfectividade)->where('numeroAgente', $request->numeroAgente)->first();
        $mapaFaltas->faltasJustificadas = $request->input('Justificadas');
        $mapaFaltas->faltasInjustificadas = $request->input('Injustificadas');
        $mapaFaltas->obs = $request->obs;
        if ($mapaFaltas->save()) {
            DB::commit();
            return redirect()->back()->with('success', 'Faltas aplicadas com sucesso ao Funcionário(a) '.$request->nomeCompleto.'!');
        }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro ao aplicadar faltas ao Funcionário(a) '.$request->nomeCompleto.'!');
        }
    }
    
    public function removerDoMapaEfectividade(Request $request)
    {
        //dd($request->all());
        $funcionario = MapaEfectividadefalta::where('idMapaEfectividade', $request->idMapaEfectividade)->where('numeroAgente', $request->numeroAgente)->first();
        DB::beginTransaction();
        if ($funcionario) {
            $funcionario->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Funcionário '.$request->nomeCompleto.', foi excluido(a) com sucesso!');
        }else{
            DB::rollBack();
            return redirect()->back()->with('success', 'Erro ao excluir o Funcionário(a) '.$request->nomeCompleto.'!');
        }
    }
    
}
