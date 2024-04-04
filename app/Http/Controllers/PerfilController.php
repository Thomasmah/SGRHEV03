<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\Models\Arquivo;
use App\Models\Cargo;
use App\Models\categoriaFuncionario;
use App\Models\Endereco;
use App\Models\Naturalidade;
use App\Models\Parente;
use App\Models\Pessoa;
use App\Models\Processo;
use App\Models\Seccao;
use App\Models\UnidadeOrganica;


use Illuminate\Http\Request;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show($idFuncionario)
    {
        $processos = Processo::where('idFuncionarioSolicitante', $idFuncionario)->get();
        $funcionario = Funcionario::where('id',$idFuncionario)->first();
        $pessoa = Pessoa::where('id',$funcionario->idPessoa)->first();
        $parente = Parente::where('id',$funcionario->idPessoa)->first();
        $naturalidade = Naturalidade::where('id',$funcionario->idPessoa)->first();
        $endereco = Endereco::where('id',$funcionario->idPessoa)->first();
        $cargo = Cargo::where('id',$funcionario->idCargo)->first();
        $unidadeOrganica = UnidadeOrganica::where('id',$funcionario->idUnidadeOrganica)->first();
        $categoriaFuncionario = CategoriaFuncionario::where('id',$funcionario->idCategoriaFuncionario)->first();
        $arquivos = Arquivo::where('idFuncionario',$funcionario->id);
        //dd($arquivos->where('categoria','fotodeperfil')->first()->arquivo);
        // dd($arquivos->where('categoria','fotodeperfil')->first()->arquivo);
        return view('sgrhe/perfilview',compact('funcionario','pessoa','parente','naturalidade','endereco','cargo','unidadeOrganica','categoriaFuncionario','arquivos','processos'));
    }


    
    public function timelineShow($idFuncionario)
    {

        //Determinando a Seccao do Fucnionario
        $funcionario = Funcionario::where('id',$idFuncionario)->first();
        $pessoa = Pessoa::where('id',$funcionario->idPessoa)->first();
        $parente = Parente::where('id',$funcionario->idPessoa)->first();
        $naturalidade = Naturalidade::where('id',$funcionario->idPessoa)->first();
        $endereco = Endereco::where('id',$funcionario->idPessoa)->first();
        $cargo = Cargo::where('id',$funcionario->idCargo)->first();
        $seccao = Seccao::where('id',$funcionario->idSeccao)->first();
        $unidadeOrganica = UnidadeOrganica::where('id',$funcionario->idUnidadeOrganica)->first();
        $categoriaFuncionario = CategoriaFuncionario::where('id',$funcionario->idCategoriaFuncionario)->first();
        $arquivos = Arquivo::where('idFuncionario',$funcionario->id);
        $processosMy = Processo::orderBy('created_at', 'desc')->where('idFuncionarioSolicitante', session()->only(['funcionario'])['funcionario']->id)->get();
        //dd($processosMy);
        $processos = Processo::orderBy('created_at', 'desc')->where('seccao', $seccao->codNome)->get();
        //dd($seccao);
        // dd($arquivos->where('categoria','fotodeperfil')->first()->arquivo);
        return view('sgrhe/perfilview-timeline',compact('funcionario','pessoa','parente','naturalidade','endereco','cargo','unidadeOrganica','categoriaFuncionario','arquivos','processos','processosMy'));
    }


    public function exibirfoto(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
