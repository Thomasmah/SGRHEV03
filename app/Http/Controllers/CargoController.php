<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use Illuminate\Http\Request;

class CargoController extends Controller
{

    //Fromulario Create Edit Cargo
      public function formulario($id = null)
    {
       //Se o $id for nulo é a criacao de um novo registro se nao é edicao
       $cargo = $id ? Cargo::find($id):null;
       return view('sgrhe/pages/forms/cargo',compact('cargo'));
    }
    public function index()
    {
        $dados = Cargo::all();
       // dd($dados->all());
        return view('sgrhe/pages/tables/cargo',compact('dados'));
    
    }

    //Create
    public function store(Request $request)
    {
       $request->validate([
            'designacao'=> ['required','string', 'max:255',],
            'descrisao'=> ['string', 'max:255'],
            'permissoes'=> ['required','string', 'max:255'],
            //'seccao'
        ],[
            'designacao.required' => 'O Campo designação é obrigatório',
            'permissoes.required' => 'Defina permissoes para  o cargo!'
        ]);

        $cargo=Cargo::create([
            'designacao'=> $request->input('designacao'),
            'descrisao' => $request->input('descrisao'),
            'permissoes' => $request->input('permissoes'),
        ]);
       if ($cargo) {
        return redirect()->back()->with('success', 'O cargo, '.$request->designacao.' Cadastrado com sucesso!');
       }else {
        return redirect()->back()->with('error', 'O cargo, '.$request->designacao.' Cadastrado com sucesso!')->withErrors($request)->withInput();
       }
        
    }

  //Update
    public function update(Request $request, string $id)
    {
        $request->validate([
            'designacao'=> ['required','string', 'max:255',],
            'descrisao'=> ['string', 'max:255'],
            'permissoes'=> ['required','string', 'max:255'],
            //'seccao'
        ],[
            'designacao.required' => 'O Campo designação é obrigatório',
            'permissoes.required' => 'Defina permissoes para  o cargo!'
        ]);

   
        $cargo = Cargo::where('id', $id)->first();
        $cargo->designacao = $request->designacao;
        $cargo->descrisao = $request->descrisao;
        $cargo->permissoes = $request->permissoes;
        // Salvando as Alteracoes do Registro
        
        // Redirecione de volta para a página de listagem ou para onde você desejar
        if ($cargo->save()) {
            return redirect()->route('cargos.index')->with('success', 'O cargo, '.$request->designacao.' foi atualizado com sucesso.');
        }else {
            return redirect()->back()->with('error', 'Erro de actulizacao do cargo '.$request->designacao.'!')->withErrors($request)->withInput();
        }

    }

    //Delete
    public function destroy(string $id)
    {
         //dd($id); //Teste de Debug And Dead
        // Encontrar o registro a ser excluído pelo ID
        $cargo = Cargo::find($id);
        if ($cargo) {
            // Exclua o registro
            $cargo->delete();
            // Redirecione de volta para a página desejada após a exclusão
            return redirect()->back()->with('success', 'Registro excluído com sucesso.');
        } else {
            // O registro não foi encontrado, faça o tratamento apropriado (por exemplo, redirecione com uma mensagem de erro)
            return redirect()->back()->with('error', 'Registro não encontrado, out erro de exclusao');
        }
    }
}
