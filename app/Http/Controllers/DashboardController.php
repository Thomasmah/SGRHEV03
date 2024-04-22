<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Permissoes;
use App\Models\Arquivo;
use App\Models\Cargo;
use App\Models\categoriaFuncionario;
use App\Models\Endereco;
use App\Models\FormularioAproveitamento;
use App\Models\Funcionario;
use App\Models\Naturalidade;
use App\Models\Parente;
use App\Models\Pessoa;
use App\Models\UnidadeOrganica;
use App\Models\UnidadeOrganicaDado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Models\User;
use Database\Seeders\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //Mostrar Dados 
    public function indexUnidadesOrganicas() {
       
       
    }
    public function indexFuncionarios() {

    }
    public function index(){
        //Verificar Se O Usuario tem Perfil concluido
     
        $agenteLogado = Auth::user()->numeroAgente;
        $agente =  Funcionario::where('numeroAgente',$agenteLogado)->exists();
        if ($agente) {
            $FUNCIONARIO = Funcionario::where('numeroAgente', $agenteLogado)->first();
            $PERMISSOES = Cargo::where('id', $FUNCIONARIO->idCargo)->first()->permissoes;
            if ($PERMISSOES === 'Admin' || $PERMISSOES >= 4) {
                     //Carregando os Dados do Dashboard
                $unidadesOrganicas = UnidadeOrganica::all();
                $funcionarios = Funcionario::all();
                $dataActual = now();
                //Determinar o Ano Lectivo sabendo que Ele comeca sempre em setembro
                if ($dataActual->format('n') > 9) {
                    $anoLectivo = $dataActual->format('Y').'/'.($dataActual->format('Y') + 1);
                }else {
                    $anoLectivo = ($dataActual->format('Y') - 1).'/'.$dataActual->format('Y');
                } 
               // $dados = DB::select('');
                //dd($dados);
                $matriculadosIAMF = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total_ultimo_registro'))->whereIn('id', function($query) {
                    $query->select( DB::raw('MAX(id)'))->from('formulario_aproveitamentos')->groupBy('idUnidadeOrganica');
                })->groupBy('idUnidadeOrganica')->get()->sum('total_ultimo_registro');

                $matriculadosIAF = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAF) as total_ultimo_registro'))->whereIn('id', function($query) {
                    $query->select( DB::raw('MAX(id)'))->from('formulario_aproveitamentos')->groupBy('idUnidadeOrganica');
                })->groupBy('idUnidadeOrganica')->get()->sum('total_ultimo_registro');
                
                //Organizar Pequiza por Trimestre  para fazer a clusterizacao

                //I Trimestre
                $matriculadosIAMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
               // $matriculadosIAFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');

                $aprovadosMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
                //$aprovadosFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
                
                $reprovadosMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
               // $reprovadosFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');

                    //II Trimestre
                    $matriculadosIAMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$matriculadosIAFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');

                    $aprovadosMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$aprovadosFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    
                    $reprovadosMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$reprovadosFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');

                        //III Trimestre
                        $matriculadosIAMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                       // $matriculadosIAFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');

                        $aprovadosMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        //$aprovadosFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                        $reprovadosMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        //$reprovadosFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                        //Final Trimestre
                         $matriculadosIAMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                         // $matriculadosIAFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
  
                          $aprovadosMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          //$aprovadosFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          
                          $reprovadosMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          //$reprovadosFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                return view('/dashboard',compact('aprovadosMFIII','reprovadosMFIII','aprovadosMFFinal','aprovadosMFII','reprovadosMFII','aprovadosMFI','reprovadosMFI','reprovadosMFFinal','matriculadosIAMF','matriculadosIAMFI','matriculadosIAF','matriculadosIAMFII','matriculadosIAMFIII','matriculadosIAMFFinal','unidadesOrganicas','funcionarios'));
            }else{
                //Redirecionando para a routa de Dashboard Escola se For director de escola ou tecnico da Escola
                if ($PERMISSOES === 'Admin' || $PERMISSOES >= 2){
                    //Redirecionanado para a Linha de Tempo Pessoal
                    $idUO = $FUNCIONARIO->idUnidadeOrganica;
                    return redirect()->route('dashboard.unidade.organica.how', ['idUnidadeOrganica' => "$idUO"]);
                }else{
                    //Redirecionar o funcionario comum para a sua Timeline
                    $idF = $FUNCIONARIO->id;
                    return redirect()->route('timeline.show', ['idFuncionario' => "$idF"]);
                }
            }
      
        }else{
        header('Location:/?error');
        exit();
        } 
    }
}
