<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\MapaEfectividade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MapaEfectividadeController extends Controller
{
    public function indexMapasEfectividade()
    {
       $dados = MapaEfectividade::all();
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
        return view('sgrhe\pages\tables\form-mapa-efectividade', compact('funcionarios'));
    }

    
    public function adicionarFuncionarios()
    {
        dd('Cheguei aqui');
    }

    /*
    Criar Mapa de Efectividade
     */
    public function criarMapaEfectividade(Request $request)
    {
        dd('Cheguei aqui');
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
    public function destroy(string $id)
    {
        //
    }
}
