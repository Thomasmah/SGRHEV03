<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Naturalidade;
use App\Models\Parente;
use App\Models\Pessoa;
use App\Models\UnidadeOrganica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaController extends Controller
{
    //Formulario Create Edit pessoa
    public function formulario($id = null)
    {
       //Se o $id for nulo é a criacao de um novo registro se nao é edicao
       $pessoa = $id ? Pessoa::find($id):null;
       $parente = $id ? Parente::find($id):null;
       $naturalidade = $id ? Naturalidade::find($id):null;
       $endereco = $id ? Endereco::find($id):null;
       return view('sgrhe/pages/forms/pessoa',compact('pessoa','parente','naturalidade','endereco'));
    }
    public function index()
    {
        $pessoas = Pessoa::all();
        //dd($pessoas->all());
        return view('sgrhe/pages/tables/pessoas',compact('pessoas'));
    }
    public function store(Request $request) 
    {
       // dd($request->all());
        $request->validate([
            'nomeCompleto' => ['string', 'max:255','required'],
            'dataNascimento' => ['date','required','before:' .now()->subYears(18)->format('Y-m-d')],
            'genero'=> ['string', 'max:9','required'],
            'grupoSanguineo' => ['string','max:3'],
            'estadoCivil' => ['string'],
            'numeroBI' => ['required', 'string', 'max:14', 'unique:pessoas,numeroBI'],
            'validadeBI' => ['date','required','after_or_equal:'.now()],
            'provincia' => ['string', 'max:255','required'],
            'municipio' => ['string', 'max:255','required'],
            'nomePai' => ['string', 'max:255','required'],
            'nomeMae' => ['string', 'max:255','required'],
            'idPessoa' => ['integer'],
        ], [
                'dataNascimento.required' => 'Data de Nascimento é um campo obrigatorio!',
                'dataNascimento.before' => 'Registro só é valido para maiors de 18 anos de idade!',
                'nomeCompleto.required' => 'O campo Nome Completo é Obrigatório!',
                'numeroBI.required' => 'O número de Bilhete de Identidade é Obrigatório!',
                'numeroBI.unique' => 'O número de BI inserido ja está sendo utilizado por outro usuário!',
                'validadeBI.required' => 'Data de Validade BI é um campo obrigatoria!',
                'validadeBI.after_or_equal' => 'Bilhete de Identidade com data de validade expirada!',
                'nomePai.required' => 'Insira o nome do Pai!',
                'nomeMae.required' => 'Insira o nome da Mãe!',
            ]);

        $pessoa = Pessoa::create([
            'nomeCompleto' => $request->input('nomeCompleto'),
            'dataNascimento' => $request->input('dataNascimento'),
            'genero'=> $request->input('genero'),
            'grupoSanguineo' => $request->input('grupoSanguineo'),
            'estadoCivil' => $request->input('estadoCivil'),
            'numeroBI' => $request->input('numeroBI'),
            'validadeBI' => $request->input('validadeBI'),  
        ]);
        //Inicio da Transacao
        DB::beginTransaction();
        if ($pessoa) {
            $idPessoa = Pessoa::latest()->value('id');
            $parente = Parente::create([
                'nomePai' => $request->input('nomePai'),
                'nomeMae' => $request->input('nomeMae'),
                'idPessoa' => $idPessoa,
             ]);
             if ($parente) {
                $naturalidade = Naturalidade::create([
                    'provincia' => $request->input('provincia'),
                    'municipio' => $request->input('municipio'),
                    'idPessoa'  => $idPessoa,     
                ]);
                if ($naturalidade) {
                    $endereco = Endereco::create([
                        'idPessoa' => $idPessoa,
                        'provincia' => $request->input('provinciaEndereco'),
                        'municipio' => $request->input('municipioEndereco'),
                        'bairro' => $request->input('bairro'),
                        'zona' => $request->input('zona'),
                        'quarteirao' => $request->input('quarteirao'),
                        'rua' => $request->input('rua'),
                        'casa' => $request->input('casa'),
                    ]);
                    if ($endereco) {
                        DB::commit();
                        if ($request->input('cadastrar') == 'cadastrarPessoa') {
                            return redirect()->route('pessoas.form')->with('success','Pessoa Cadastrada com Sucesso!');
                        }else {
                            // 
                            return redirect()->route('funcionarios.verificarPessoa.funcionario', ['numeroBI' => $request->input('numeroBI')]);
                        }
                    }else {
                        DB::rollBack();
                        return redirect()->back()->with('error','Erro ao Adicionar Endereço');

                    }
                }else {
                    DB::rollBack();
                    return redirect()->back()->with('error','Erro ao Adicionar Naturalidade');

                }
             }else {
                DB::rollBack();
                return redirect()->back()->with('error','Erro ao Adicionar Parentesco');
            }
        }else {
            DB::rollBack();
            return redirect()->back()->with('error','Erro ao Cadastrar Pessoa');
        }
    }

    //Create
    public function update(Request $request, string $id)
    { 
        $request->validate([
            'nomeCompleto' => ['string', 'max:255','required'],
            'dataNascimento' => ['date','required','before:' .now()->subYears(18)->format('Y-m-d')],
            'genero'=> ['string', 'max:9','required'],
            'grupoSanguineo' => ['string','max:3'],
            'estadoCivil' => ['string'],
            'numeroBI' => ['required', 'string', 'max:14', 'unique:pessoas,numeroBI,'.$id],
            'validadeBI' => ['date','required','after_or_equal:'.now()],
            'provincia' => ['string', 'max:255','required'],
            'municipio' => ['string', 'max:255','required'],
            'nomePai' => ['string', 'max:255','required'],
            'nomeMae' => ['string', 'max:255','required'],
            'idPessoa' => ['integer'],
        ], [
                'dataNascimento.required' => 'Data de Nascimento é um campo obrigatorio!',
                'dataNascimento.before' => 'Registro só é valido para maiors de 18 anos de idade!',
                'nomeCompleto.required' => 'O campo Nome Completo é Obrigatório!',
                'numeroBI.required' => 'O número de Bilhete de Identidade é Obrigatório!',
                'numeroBI.unique' => 'O número de BI inserido ja está sendo utilizado por outro usuário!',
                'validadeBI.required' => 'Data de Validade BI é um campo obrigatoria!',
                'validadeBI.after_or_equal' => 'Bilhete de Identidade com data de validade expirada!',
                'nomePai.required' => 'Insira o nome do Pai!',
                'nomeMae.required' => 'Insira o nome da Mãe!',
            ]);

    $pessoa = Pessoa::find($id);
        // Encontre o registro a ser actualizado em Parentes com base na chave estrangeira
    $parentes = Parente::where('idPessoa', $id)->first();
    // Encontre o registro em Naturalidade com base na chave estrangeira
    $naturalidades = Naturalidade::where('idPessoa', $id)->first();
    // Atualize os campos do pesso$pessoa com os dados do formulário
            $pessoa->nomeCompleto = $request->nomeCompleto;
            $pessoa->dataNascimento = $request->dataNascimento;
            $pessoa->genero = $request->genero;
            $pessoa->grupoSanguineo = $request->grupoSanguineo;
            $pessoa->estadoCivil = $request->estadoCivil;
            $pessoa->numeroBI = $request->numeroBI;
            $pessoa->validadeBI = $request->validadeBI;
            $naturalidades->provincia = $request->provincia;
            $naturalidades->municipio = $request->municipio;
            $parentes->nomePai = $request->nomePai;
            $parentes->nomeMae = $request->nomeMae;
    // iniciando a transacao para as alterações no registro
    DB::beginTransaction();
    if ($pessoa->save()) {
        if ($naturalidades->save()) {
            if ($parentes->save()) {
                DB::commit();
                // Redirecionando para a Pagina de Index Funionarios
                return redirect()->route('pessoas.index')->with('success', 'Registro atualizado com sucesso.');
            }else {
                DB::rollBack();
                return redirect()->back()->with('error', 'Erro de actualização na tabela parentes! ')->withInput();
            }
        }else {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erro de actualização na tabela naturalidade! ')->withInput();
        }
    }else {
        DB::rollBack();
        return redirect()->back()->with('error', 'Erro de actualização na tabela pessoa! ')->withInput();
    }
   
    }
}
