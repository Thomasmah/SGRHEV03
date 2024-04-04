<?php

namespace App\Http\Controllers;

use App\Models\Habilitacao;

use Illuminate\Http\Request;

class HabilitacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());
          
        $validardados=$request->validate([
            'nivel'=> ['string', 'max:255'],
            'curso'=> ['string', 'max:255'],
            'instituicao'=> ['string', 'max:255'],
            'notaFinal'=> ['string', 'max:255'],
            'dataConclusao'=> ['date'],
            'idDocumento'=> ['string'],
            'status'=> ['string', 'max:255'],
            'idFuncionario'=> ['string'],
        ]);
      $idFuncionario=1;
      $idDocumento=1;
        Habilitacao::create([
            'nivel' => $request->input('nivel'),
            'curso' => $request->input('curso'),
            'instituicao'=> $request->input('instituicao'),
            'notaFinal'=> $request->input('notaFinal'),
            'dataConclusao'=> $request->input('dataConclusao'),
           // 'idDocumento'=>$idDocumento,
            'status' => $request->input('status'),
           // 'idFuncionario'=>$idFuncionario,
        ]);
       
        return redirect()->back()->withErrors($validardados)->withInput();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
