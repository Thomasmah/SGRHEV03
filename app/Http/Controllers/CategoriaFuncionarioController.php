<?php

namespace App\Http\Controllers;
use App\Models\CategoriaFuncionario;
use Illuminate\Http\Request;
class CategoriaFuncionarioController extends Controller
{
    //FOrmulario Create Edit
    public function formulario($id = null)
    {
       //Se o $id for nulo é a criacao de um novo registro se nao é edicao
       $categoriafuncionario = $id ? CategoriaFuncionario::find($id):null;
       return view('sgrhe/pages/forms/categoriafuncionario',compact('categoriafuncionario'));
    }
    //Read
    public function index()
    {
        $categoriafuncionarios = CategoriaFuncionario::all();
        //dd($categoriafuncionarios->all());
        return view('sgrhe/pages/tables/categoriafuncionario',compact('categoriafuncionarios'));
    }

   //Create
    public function store(Request $request)
    {
       // dd($request->all());
         $validardados=$request->validate([
            'categoria'=> ['string', 'max:255'],
            'municipio'=> ['string', 'max:10'],
            'salariobase'=> ['numeric']
            
        ]);

        $categoriafuncionario = CategoriaFuncionario::create([
            'categoria'=> $request->input('categoria'),
            'grau'=> $request->input('municipio'),
            'salariobase' => $request->input('salariobase')
        ]);
       if ($categoriafuncionario) {
        return redirect()->route('categoriafuncionarios.form')->with('success','Categoria '.$request->categoria.' Cadastrada com sucesso !');
       }else {
        return redirect()->back()->with('success','Erro ao Cadastrar a Categoria '.$request->categoria.'!')->withErrors($validardados)->withInput();
       }
    }

    //Update
    public function update(Request $request, string $id)
    {
         // dd($request->all());
         // Valide os dados recebidos do formulário;
    $validardados=$request->validate([
        'categoria'=> ['string', 'max:255'],
        'grau'=> ['string', 'max:255'],
        'salario'=> ['numeric'],
    ]);
        $categoriafuncionario = CategoriaFuncionario::where('id', $id)->first();
        $categoriafuncionario->categoria = $request->categoria;
        $categoriafuncionario->grau = $request->municipio;
        $categoriafuncionario->salariobase = $request->salariobase;
        //  Verificando e Salvando as Alteracoes do Registro
        if ($categoriafuncionario->save()) {
            return redirect()->route('categoriafuncionarios.index')->with('success', 'A Categoria de Funcionário , '.$request->categoria.' foi atualizado com sucesso!');
        }else {
            return redirect()->back()->with('error', 'Erro de actualização do Categoria de Funcionário '.$request->categoria.'!')->withErrors($validardados)->withInput();
        }
    }

    //Delete
    public function destroy(string $id)
    {
         //dd($id); //Teste de Debug And Dead
        // Encontrar o registro a ser excluído pelo ID
        $categoriafuncionario = CategoriaFuncionario::find($id);
        if ($categoriafuncionario) {
            // Exclua o registro
            $categoriafuncionario->delete();
            // Redirecione de volta para a página desejada após a exclusão
            return redirect()->back()->with('success', 'Registro excluído com sucesso!');
        } else {
            // O registro não foi encontrado, faça o tratamento apropriado (por exemplo, redirecione com uma mensagem de erro)
            return redirect()->back()->with('error', 'Erro de exclusao!');
        }
    }
}
