<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\Endereco;
use App\Models\Naturalidade;
use App\Models\Parente;
use App\Models\Telefone;
use App\Models\Cargo;
use App\Models\categoriaFuncionario;
use App\Models\Seccao;
use App\Models\UnidadeOrganica;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;



class FuncionarioController extends Controller
{
 
    
    //Verificar Se criar ou Editar par Exibir funcionario
        public function formulario($id = null){
        //Se o $id for nulo é a criacao de um novo registro se nao é edicao
        $pessoa = $id ? Pessoa::where('id',$id)->first():null;
        $funcionario = $id ? Funcionario::where('idPessoa',$id)->first():null;
        $naturalidade = $id ? Naturalidade::where('idPessoa',$id)->first():null;
        $parente = $id ? Parente::where('idPessoa',$id)->first():null;
        //Pesquisa Pelo Id do Funcionario
        $opcoesCargo =  $id ? Cargo::where('id',$funcionario->idCargo)->first():null;
        $opcoesSeccaos =  $id ? Seccao::where('id',$funcionario->idSeccao)->first():null;
        //dd($opcoesSeccaos);
        //dd($opcoesCargo);
        $opcoesUnidadeOrganica = $id ?  UnidadeOrganica::where('id',$funcionario->idUnidadeOrganica)->first():null;
        $opcoesCategoriaFuncionario = $id ?  CategoriaFuncionario::where('id',$funcionario->idCategoriaFuncionario)->first():null;
        return view('sgrhe/pages/forms/funcionario',compact('pessoa','funcionario','naturalidade','parente','opcoesCargo','opcoesUnidadeOrganica','opcoesCategoriaFuncionario','opcoesSeccaos'));
     }

        //Verificar a Existencia  Pessoa Pré cadastrada
        public function verificarPessoa(Request $request){
        $validar = $request->validate([
            'numeroBI' => ['required'],
        ]);
        // Verifique se o Numero de Bilhete de Identidade existe na tabela pessoa
        $pessoa = Pessoa::where('numeroBI', $request->numeroBI)->first();
        if ($pessoa) {
            return view('sgrhe/pages/forms/funcionario', compact('pessoa'));//->with('feito', 'Pessoa encontrada com sucesso!');
           }else{
            return redirect()->back()->with('aviso','Não foi possível encontrar a pessoa!');
           } 
        }


     //Read
    public function index()
    {
          //Operacoes de join para varias tabelas relacionadas com funcionarios
          $dados = DB::select('
          select 
          funcionarios.id as id_funcionario, pessoas.id as id_pessoas, unidade_organicas.id as id_unidade_organica, categoria_funcionarios.categoria as categoria_unidade_organica, cargos.designacao as nomeCargo, 
          funcionarios.*, pessoas.*, categoria_funcionarios.*, unidade_organicas.*, cargos.*
              from funcionarios
              join pessoas on pessoas.id=funcionarios.idPessoa
              join categoria_funcionarios on categoria_funcionarios.id=funcionarios.idCategoriaFuncionario
              join unidade_organicas on unidade_organicas.id=funcionarios.idUnidadeOrganica
              join cargos on cargos.id=funcionarios.idCargo 
          ');
          $titulo = "Funcionários / Força de Trabalho";
          return view('sgrhe\pages\tables\funcionarios',compact('dados','titulo'));
    }
    public function indexFuncionariosInativos()
    {
          //Operacoes de join para varias tabelas relacionadas com funcionarios
          $dados = DB::select('
          select 
          funcionarios.estado as estado_funcionario, funcionarios.id as id_funcionario, pessoas.id as id_pessoas, unidade_organicas.id as id_unidade_organica, categoria_funcionarios.categoria as categoria_unidade_organica, cargos.designacao as nomeCargo, 
          funcionarios.*, pessoas.*, categoria_funcionarios.*, unidade_organicas.*, cargos.*
              from funcionarios
              join pessoas on pessoas.id=funcionarios.idPessoa
              join categoria_funcionarios on categoria_funcionarios.id=funcionarios.idCategoriaFuncionario
              join unidade_organicas on unidade_organicas.id=funcionarios.idUnidadeOrganica
              join cargos on cargos.id=funcionarios.idCargo 
            where funcionarios.estado = "Inactivo"
          ');
          $titulo = "Funcionários em estado Inactivo";
          return view('sgrhe\pages\tables\funcionarios',compact('dados','titulo'));
    }

  
//Create
    public function store(Request $request) {
       // dd($request->all());
       if ($request->idCargo == 4) {
        $funcionario = Funcionario::where('idUnidadeOrganica', $request->idUnidadeOrganica)->where('idCargo', 4)->exists();
        if ($funcionario) {
            return redirect()->back()->with('error', 'O Cargo à Director para essa Escola não se encontra Disponível ');
        }else{
            $request->validate([
                'idCargo' => [
                    Rule::unique('funcionarios')->where( function($query) {
                        $query->where('idCargo', 7);
                    })->ignore($request->idCargo),
                ],
            'numeroAgente' => ['numeric','required','unique:funcionarios,numeroAgente'],
            //'numeroBI' => ['required','unique:funcionarios,numeroBI'],
            'dataAdmissao' => ['date','required','before_or_equal:now'],
            'iban' => ['string','required','unique:funcionarios,iban'],
            'email' => ['email','max:255','nullable','unique:funcionarios,email'],
            'numeroTelefone' => ['between:9,14','unique:funcionarios,numeroTelefone'],    
            //'idPessoa'=> ['numeric','required','unique:funcionarios,idPessoa,except'.''],
            //'idUnidadeOrganica'=> ['numeric'],
            //'idCargo'=>['numeric'],
            // 'idCategoriaFuncionario' => ['required'],
            ],[
                'idCargo.unique' => 'O Cargo de Director Muninipal não está Disponível!',
                'numeroAgente.unique' => 'O Número de agente já está sendo utilizado por outro Funcionário!',
                //'numeroBI.unique' => 'O Número de Bilhete de Identidade já está sendo utilizado por outro Funcionário!',
                'numeroAgente.required' => 'O Número de Agente é Obrigatório!',
                'numeroAgente.numeric' => 'O Número de Agente deve ser um numero!',
                'dataAdmissao.before' => 'A data de Admissão deve ser antes do dia de Hoje!', 
                'dataAdmissao.required' => 'A data de Admissão é Obrigatória!',
                'iban.unique' => 'O Iban ja está sendo utilizado por outro Funcionário!',
                'email.unique' => 'O Email ja está sendo utilizado por outro Funcionário!', 
                'numeroTelefone.unique' => 'O Numero de Telefone já está sendo utilizado por outro Funcionário!',
            ]);
            DB::beginTransaction();
            $funcionario = Funcionario::create([
                'numeroAgente' => $request->input('numeroAgente'),
                'dataAdmissao' => $request->input('dataAdmissao'),
                'iban' => $request->input('iban'),
                'email' => $request->input('email'),
                'idPessoa' => $request->input('idPessoa'),
                'idUnidadeOrganica' => $request->input('idUnidadeOrganica'),
                'idCargo' => $request->input('idCargo'), 
                'idCategoriaFuncionario' => $request->input('idCategoriaFuncionario'),
                'numeroTelefone'=> $request->input('numeroTelefone'),
                'idSeccao'=> $request->input('idSeccao'),
                'estado'=> "Activo",

             ]);
            if ($funcionario) {
                DB::commit();
                return redirect()->back()->with('success', 'Funcionário Cadastrado com sucesso!');
            }else{
                DB::rollBack();
                return redirect()->back()->with('aviso', 'Erro de Cadastrado Funcionário!')->withErrors($request);
            }
        }
    }else{
        
        $request->validate([
            'idCargo' => [
                Rule::unique('funcionarios')->where( function($query) {
                    $query->where('idCargo', 7);
                })->ignore($request->idCargo),
            ],
        'numeroAgente' => ['numeric','required','unique:funcionarios,numeroAgente'],
        //'numeroBI' => ['required','unique:funcionarios,numeroBI'],
        'dataAdmissao' => ['date','required','before_or_equal:now'],
        'iban' => ['string','required','unique:funcionarios,iban'],
        'email' => ['email','max:255','nullable','unique:funcionarios,email'],
        'numeroTelefone' => ['between:9,14','unique:funcionarios,numeroTelefone'],    
        //'idPessoa'=> ['numeric','required','unique:funcionarios,idPessoa,except'.''],
        //'idUnidadeOrganica'=> ['numeric'],
        //'idCargo'=>['numeric'],
        // 'idCategoriaFuncionario' => ['required'],
        ],[
            'idCargo.unique' => 'O Cargo de Director Muninipal não está Disponível!',
            'numeroAgente.unique' => 'O Número de agente já está sendo utilizado por outro Funcionário!',
            //'numeroBI.unique' => 'O Número de Bilhete de Identidade já está sendo utilizado por outro Funcionário!',
            'numeroAgente.required' => 'O Número de Agente é Obrigatório!',
            'numeroAgente.numeric' => 'O Número de Agente deve ser um numero!',
            'dataAdmissao.before' => 'A data de Admissão deve ser antes do dia de Hoje!', 
            'dataAdmissao.required' => 'A data de Admissão é Obrigatória!',
            'iban.unique' => 'O Iban ja está sendo utilizado por outro Funcionário!',
            'email.unique' => 'O Email ja está sendo utilizado por outro Funcionário!', 
            'numeroTelefone.unique' => 'O Numero de Telefone já está sendo utilizado por outro Funcionário!',
        ]);
        DB::beginTransaction();
        $funcionario = Funcionario::create([
            'numeroAgente' => $request->input('numeroAgente'),
            'dataAdmissao' => $request->input('dataAdmissao'),
            'iban' => $request->input('iban'),
            'email' => $request->input('email'),
            'idPessoa' => $request->input('idPessoa'),
            'idUnidadeOrganica' => $request->input('idUnidadeOrganica'),
            'idCargo' => $request->input('idCargo'), 
            'idCategoriaFuncionario' => $request->input('idCategoriaFuncionario'),
            'numeroTelefone'=> $request->input('numeroTelefone'),
            'idSeccao'=> $request->input('idSeccao'),
            'estado'=> "Activo",

         ]);
        if ($funcionario) {
            DB::commit();
            return redirect()->back()->with('success', 'Funcionário Cadastrado com sucesso!');
        }else{
            DB::rollBack();
            return redirect()->back()->with('aviso', 'Erro de Cadastrado Funcionário!')->withErrors($request);
        }
    }
        
    }


    //Update
    public function update(Request $request, string $id)
    { 
           // dd($request->all());
           //Verificar se o Cargo de Director da Escla esta Elegivel
           if ($request->idCargo == 4) {
                $funcionario = Funcionario::where('idUnidadeOrganica', $request->idUnidadeOrganica)->where('idCargo', 4)->exists();
                if ($funcionario) {
                    return redirect()->back()->with('error', 'O Cargo à Director para essa Escola não se encontra Disponível ');
                }else{
                    $request->validate([
                        'idCargo' => [
                            Rule::unique('funcionarios')->where( function($query) {
                                $query->where('idCargo', 7);
                            })->ignore($request->idCargo),
                        ],
                    'numeroAgente' => ['numeric','required','unique:funcionarios,numeroAgente,'.$id],
                    'dataAdmissao' => ['date','required','before_or_equal:now'],
                    'iban' => ['string','required','unique:funcionarios,iban,'.$id], 
                    'email' => ['email','max:255','nullable','unique:funcionarios,email,'.$id],
                    'numeroTelefone' => ['between:9,14','unique:funcionarios,numeroTelefone,'.$id],    
                    ], [
                        'idCargo.unique' => 'O Cargo de Director Muninipal não está Disponível!',
                        'numeroAgente.unique' => 'O Número de agente ja está sendo utilizado por outro usuário!',
                        'numeroAgente.required' => 'O Número de Agente é Obrigatório!',
                        'numeroAgente.numeric' => 'O Número de Agente deve ser um numero!',
                        'dataAdmissao.before_or_equal' => 'A data de Admissão deve ser antes do dia de Hoje!', 
                        'dataAdmissao.required' => 'A data de Admissão é Obrigatória!',
                        'iba.unique' => 'O Iban ja está sendo utilizado por outro usuário!',
                        'email.unique' => 'O Email ja está sendo utilizado por outro usuário!', 
                        'numeroTelefone.unique' => 'O Numero de Telefone já está sendo utilizado por outro usuário!', 
                    ]);
                    DB::beginTransaction();
                    //Isolar ou identificar o Registro a Ser Alterado
                    $funcionario = Funcionario::where('id', $id)->first();
                    // $funcionario->dataAdmissao = $request->dataAdmissao;
                    $funcionario->numeroAgente = $request->numeroAgente;
                    $funcionario->idCategoriaFuncionario = $request->idCategoriaFuncionario;
                    $funcionario->idCargo = $request->idCargo;
                    $funcionario->idSeccao = $request->idSeccao;
                    $funcionario->idUnidadeOrganica = $request->idUnidadeOrganica;
                    $funcionario->iban = $request->iban;
                    $funcionario->email = $request->email;
                    $funcionario->dataAdmissao = $request->dataAdmissao;
                    $funcionario->numeroTelefone = $request->numeroTelefone;
                        // iniciando a transacao para as alterações no registro
                        if ($funcionario->save()) {
                            DB::commit();
                            return redirect()->route('funcionarios.index')->with('success', 'Registro atualizado com sucesso.');
                        }else {
                            DB::rollBack();
                            return redirect()->back()->with('error', 'Erro de Acualização nda Entidade Funionário! ')->withErrors($request);
                        }
                }
           }else{
            $request->validate([
                'idCargo' => [
                    Rule::unique('funcionarios')->where( function($query) {
                        $query->where('idCargo', 7);
                    })->ignore($request->idCargo),
                ],
            'numeroAgente' => ['numeric','required','unique:funcionarios,numeroAgente,'.$id],
            'dataAdmissao' => ['date','required','before_or_equal:now'],
            'iban' => ['string','required','unique:funcionarios,iban,'.$id], 
            'email' => ['email','max:255','nullable','unique:funcionarios,email,'.$id],
            'numeroTelefone' => ['between:9,14','unique:funcionarios,numeroTelefone,'.$id],    
            ], [
                'idCargo.unique' => 'O Cargo de Director Muninipal não está Disponível!',
                'numeroAgente.unique' => 'O Número de agente ja está sendo utilizado por outro usuário!',
                'numeroAgente.required' => 'O Número de Agente é Obrigatório!',
                'numeroAgente.numeric' => 'O Número de Agente deve ser um numero!',
                'dataAdmissao.before_or_equal' => 'A data de Admissão deve ser antes do dia de Hoje!', 
                'dataAdmissao.required' => 'A data de Admissão é Obrigatória!',
                'iba.unique' => 'O Iban ja está sendo utilizado por outro usuário!',
                'email.unique' => 'O Email ja está sendo utilizado por outro usuário!', 
                'numeroTelefone.unique' => 'O Numero de Telefone já está sendo utilizado por outro usuário!', 
            ]);
            DB::beginTransaction();
            //Isolar ou identificar o Registro a Ser Alterado
            $funcionario = Funcionario::where('id', $id)->first();
            // $funcionario->dataAdmissao = $request->dataAdmissao;
            $funcionario->numeroAgente = $request->numeroAgente;
            $funcionario->idCategoriaFuncionario = $request->idCategoriaFuncionario;
            $funcionario->idCargo = $request->idCargo;
            $funcionario->idSeccao = $request->idSeccao;
            $funcionario->idUnidadeOrganica = $request->idUnidadeOrganica;
            $funcionario->iban = $request->iban;
            $funcionario->email = $request->email;
            $funcionario->dataAdmissao = $request->dataAdmissao;
            $funcionario->numeroTelefone = $request->numeroTelefone;
                // iniciando a transacao para as alterações no registro
                if ($funcionario->save()) {
                    DB::commit();
                    return redirect()->route('funcionarios.index')->with('success', 'Registro atualizado com sucesso.');
                }else {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Erro de Acualização nda Entidade Funionário! ')->withErrors($request);
                }
           }
           
    }

    //Delete
    public function destroy(string $id)
    {
        //dd($id); //Teste de Debug And Dead
        // Encontrar o registro a ser excluído pelo ID
        $funcionario = Funcionario::find($id);
        if ($funcionario) {
            // Exclua o registro
            $funcionario->delete();
            // Redirecione de volta para a página desejada após a exclusão
            return redirect()->route('funcionarios.index')->with('success', 'Registro excluído com sucesso.');
        } else {
            // O registro não foi encontrado, faça o tratamento apropriado (por exemplo, redirecione com uma mensagem de erro)
            return redirect()->route('pessoas.index')->with('error', 'Registro não encontrado, out erro de exclusao');
        }
    }


    public function formularioAvaliarDesempenhoFuncionario(Request $request)
    {
        //Blade com dados do funcionário
        $funcionarioCandidato = Funcionario::where('id', $request->input('idFuncionario'))->first();
        $pessoaCandidato = Pessoa::where('id', $funcionarioCandidato->idPessoa)->first();
        $cargoCandidato = Cargo::where('id', $funcionarioCandidato->idCargo)->first();
        $seccaoCandidato = Seccao::where('id', $funcionarioCandidato->idSeccao)->first();
        $unidadeOrganicaCandidato = UnidadeOrganica::where('id', $funcionarioCandidato->idUnidadeOrganica)->first();
        $categoriaFuncionarioCandidato = CategoriaFuncionario::where('id', $funcionarioCandidato->idCategoriaFuncionario)->first();
        return view('sgrhe\pages\forms\formulario-avaliacao-desempenho', compact('funcionarioCandidato','cargoCandidato','seccaoCandidato','pessoaCandidato','unidadeOrganicaCandidato','categoriaFuncionarioCandidato'));

    }


}
