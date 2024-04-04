<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\FormularioAproveitamento;
use App\Models\Funcionario;
use App\Models\Pessoa;
use App\Models\UnidadeOrganica;
use App\Models\UnidadeOrganicaDado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnidadeOrganicaController extends Controller
{
        //Verificar Se criar ou Editar par Exibir funcionario
        public function formulario($id = null)
     {
        //Se o $id for nulo é a criacao de um novo registro se nao é edicao
        $UnidadeOrganica = $id ? UnidadeOrganica::find($id):null;
        return view('sgrhe/pages/forms/UnidadeOrganica',compact('UnidadeOrganica'));
     }

   //Read
    public function index()
    { 
         $permissoes = Cargo::where('id', session()->only(['funcionario'])['funcionario']->idCargo )->first()->permissoes;
        if (  $permissoes == 'Admin' ) {
            //Todos Os Privilegios
            $dados = UnidadeOrganica::all();
            return view('sgrhe/pages/tables/unidadeorganica',compact('dados'));
        }elseif($permissoes<=6 && $permissoes>=4){
            //Privilegios de Select para as Unidades Organicas
            $dados = UnidadeOrganica::all();
            return view('sgrhe/pages/tables/unidadeorganica',compact('dados'));
        }elseif ($permissoes<=3 && $permissoes>=2) {
            //Sera Redirecionad a Sua Unidade Organica com as Permissoes de Select e Create pra sua unidade Organica
            //Com o Acesso de Create para registros e Select
            $unidadeOrganicaSelected = UnidadeOrganica::where('id', session()->only(['funcionario'])['funcionario']->idUnidadeOrganica)->first();
            return view('sgrhe/unidade-organica-view',compact('unidadeOrganicaSelected','permissoes'));
        }elseif($permissoes <= 1){
            //Sem Acesso aos dados sobre unidade Organica e Sera Redirecionado ao Seu Perfil View
          
            route('perfil.show', ['idFuncionario' => session()->only(['funcionario'])['funcionario']->id ]);
        }


        $dados = UnidadeOrganica::all();
        return view('sgrhe/pages/tables/unidadeorganica',compact('dados'));
    }

    public function funcionariosUnidadeOrganica(Request $request){
        $dados = DB::select('
        Select pessoas.*, parentes.*, naturalidades.*, funcionarios.*
        From pessoas
          JOIN parentes ON pessoas.id=parentes.idPessoa
          JOIN naturalidades ON pessoas.id=naturalidades.idPessoa
          JOIN funcionarios ON pessoas.id=funcionarios.idPessoa
          Where idUnidadeOrganica = '.$request->idUnidadeOrganica );
          $designacaoUnidadeOrganica = $request->input('designacao');
        return view('sgrhe/pages/tables/funcionarios-unidade_organica',compact('dados','designacaoUnidadeOrganica'));

    }
//Ver Detalhes Da Unidade Orgânica 
    public function show(string $idUnidadeOrganica)
    {
            $unidadeOrganicaSelected = UnidadeOrganica::where('id', $idUnidadeOrganica)->first();
            $Funcionarios = Funcionario::where('idUnidadeOrganica', $idUnidadeOrganica);
            $aproveitamento = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('id', 1)->first();
            $aproveitamentoITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'I')->first();
            $aproveitamentoIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'II')->first();
            $aproveitamentoIIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'III')->first();
            //dd($aproveitamentoITrimestre);
            return view('sgrhe/unidade-organica-view',compact('unidadeOrganicaSelected','Funcionarios','aproveitamentoITrimestre','aproveitamentoIITrimestre','aproveitamentoIIITrimestre'));
    }

    //Dashboard Unidade Organica So Para Directores das Escolas
    
    public function dashboardUnidadeOrganicaShow(string $idUnidadeOrganica)
    {
            $unidadeOrganicaSelected = UnidadeOrganica::where('id', $idUnidadeOrganica)->first();
            $Funcionarios = Funcionario::where('idUnidadeOrganica', $idUnidadeOrganica);
            $aproveitamento = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('id', 1)->first();
            $aproveitamentoITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'I')->first();
            //dd($aproveitamentoITrimestre);
            $aproveitamentoIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'II')->first();
            $aproveitamentoIIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'III')->first();
            return view('sgrhe/unidade-organica-dashboard',compact('unidadeOrganicaSelected','Funcionarios','aproveitamentoITrimestre','aproveitamentoIITrimestre','aproveitamentoIIITrimestre'));
    }
    //Create
    public function store(Request $request)
    {
        $request->validate([
            'designacao' => ['required','string', 'max:255'],
            'descricao' => ['required','string', 'max:255'],
            'eqt' => ['required', 'string', 'max:255', 'unique:unidade_organicas,eqt'],
            'decretoCriacao' => ['string', 'max:255'],
            'localidade' => ['required','string', 'max:255'],
            'telefone' => ['string', 'max:255','unique:unidade_organicas,telefone'],
            'email' => ['email', 'max:255','unique:unidade_organicas,email'],
        ], [
            'eqt.unique' => 'A Unidade Orgânica '.$request->input('eqt').' já foi definida no Sistema!',
            'telefone.unique' => 'Telefone em uso em outra Instituição!',
            'email.unique' => 'Email em uso por outra Instituição!',
        ]);

    $registro=UnidadeOrganica::create([
        'designacao' => $request->input('designacao'),
        'descricao' => $request->input('descricao'),
        'eqt'=> $request->input('eqt'),
        'decretoCriacao' => $request->input('decretoCriacao'),
        'localidade' => $request->input('localidade'),
        'telefone' => $request->input('telefone'),
        'email' => $request->input('email')  
    ]); 
    if ($registro) {
        return redirect()->route('unidadeorganicas.form')->with('success', 'Unidade Orgânica, '.$request->designacao.' cadastrada com sucesso!');
    } else {
        
    }
    return redirect()->route('unidadeorganicas.form')->with('error', 'Erro ao cadastrar uma nova Unidade Orgânica!')->withErrors($request)->withInput();
    }
    //Update 
    public function update(Request $request, string $id)
    {   
        $request->validate([
            'designacao' => ['required','string', 'max:255'],
            'descricao' => ['required','string', 'max:255'],
            'eqt' => ['required', 'string', 'max:255', 'unique:unidade_organicas,eqt'.$id],
            'decretoCriacao' => ['string', 'max:255'],
            'localidade' => ['required','string', 'max:255'],
            'telefone' => ['string', 'max:255','unique:unidade_organicas,telefone'.$id],
            'email' => ['email', 'max:255','unique:unidade_organicas,email'.$id],
        ], [
            'eqt.unique' => 'A Unidade Orgânica '.$request->input('eqt').' já foi definida no Sistema!',
            'telefone.unique' => 'Telefone em uso por outra Instituição!',
            'email.unique' => 'Email em uso por outra Instituição!',
        
        ]);

        $UnidadeOrganica = UnidadeOrganica::where('id', $id)->first();
        $UnidadeOrganica->designacao = $request->designacao;
        $UnidadeOrganica->descricao = $request->descricao;
        $UnidadeOrganica->eqt = $request->eqt;
        $UnidadeOrganica->decretoCriacao = $request->decretoCriacao;
        $UnidadeOrganica->localidade = $request->localidade;
        $UnidadeOrganica->telefone = $request->telefone;
        $UnidadeOrganica->email = $request->email;
        // Salvando as Alteracoes do Registro
        if ($UnidadeOrganica->save()) {
            return redirect()->route('unidadeorganicas.index')->with('success', 'Unidade Orgânica, '.$request->designacao.' foi atualizada com sucesso.');

        }else {
            return redirect()->back()->with('error', 'Erro actualizar uma nova Unidade Orgânica '.$request->designacao.'!')->withErrors($request)->withInput();

        }


        // Redirecione de volta para a página de listagem ou para onde você desejar

    }

    public function formularioAproveitamentoUnidadeOrganica(string $idUnidadeOrganica){
            $unidadeOrganicaSelected = UnidadeOrganica::where('id', $idUnidadeOrganica)->first();
            $Funcionarios = Funcionario::where('idUnidadeOrganica', $idUnidadeOrganica);
            $aproveitamento = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('id', 1)->first();
            $aproveitamentoITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'I')->get();
            $aproveitamentoIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'II')->get();
            $aproveitamentoIIITrimestre = FormularioAproveitamento::where('idUnidadeOrganica', $idUnidadeOrganica)->where('trimestre', 'III')->get();
            return view('sgrhe\pages\forms\unidade-organica-formulario-aproveitamento',compact('unidadeOrganicaSelected','Funcionarios','aproveitamento','aproveitamentoITrimestre','aproveitamentoIITrimestre','aproveitamentoIIITrimestre'));

    }

}
