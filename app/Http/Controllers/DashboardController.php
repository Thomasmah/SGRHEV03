<?php

namespace App\Http\Controllers;
use App\Models\Cargo;
use App\Models\FormularioAproveitamento;
use App\Models\Funcionario;
use App\Models\UnidadeOrganica;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
 
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
                $matriculadosIAMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
               // $matriculadosIAFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');

                $aprovadosMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
                //$aprovadosFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
                
                $reprovadosMFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');
               // $reprovadosFI = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get()->sum('total');

                    //II Trimestre
                    $matriculadosIAMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$matriculadosIAFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');

                    $aprovadosMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$aprovadosFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    
                    $reprovadosMFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');
                    //$reprovadosFII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get()->sum('total');

                        //III Trimestre
                        $matriculadosIAMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                       // $matriculadosIAFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');

                        $aprovadosMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        //$aprovadosFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                        $reprovadosMFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        //$reprovadosFIII = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                        //Final Trimestre
                         $matriculadosIAMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                         // $matriculadosIAFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(matriculadosIAMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
  
                          $aprovadosMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          //$aprovadosFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(aprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          
                          $reprovadosMFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosMF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                          //$reprovadosFFinal = FormularioAproveitamento::select('idUnidadeOrganica', DB::raw('SUM(reprovadosF) as total'))->where('anoLectivo', $anoLectivo)->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get()->sum('total');
                        
                          //Trimestre I
                          $SubControlI = FormularioAproveitamento::select('idUnidadeOrganica')->where('trimestre', 'I')->groupBy('idUnidadeOrganica')->get();
                          $SubControlNonIs = UnidadeOrganica::whereNotIn('id', $SubControlI)->get();
                          $SubControlInIs = UnidadeOrganica::whereIn('id', $SubControlI)->get();
                          
                          
                          //Trimestre II
                          $SubControlII = FormularioAproveitamento::select('idUnidadeOrganica')->where('trimestre', 'II')->groupBy('idUnidadeOrganica')->get();
                          $SubControlNonIIs = UnidadeOrganica::whereNotIn('id', $SubControlII)->get();
                          $SubControlInIIs = UnidadeOrganica::whereIn('id', $SubControlII)->get();
                          
                          //Trimestre III
                          $SubControlIII = FormularioAproveitamento::select('idUnidadeOrganica')->where('trimestre', 'III')->groupBy('idUnidadeOrganica')->get();
                          $SubControlNonIIIs = UnidadeOrganica::whereNotIn('id', $SubControlIII)->get();
                          $SubControlInIIIs = UnidadeOrganica::whereIn('id', $SubControlIII)->get();
                          
                          //Trimestre Final
                          $SubControlFinal = FormularioAproveitamento::select('idUnidadeOrganica')->where('trimestre', 'Final')->groupBy('idUnidadeOrganica')->get();
                          $SubControlNonFinals = UnidadeOrganica::whereNotIn('id', $SubControlFinal)->get();
                          $SubControlInFinals = UnidadeOrganica::whereIn('id', $SubControlFinal)->get();

                          //dd($SubControlInIs);
                return view('/dashboard',compact('SubControlInIs','SubControlNonIs','SubControlInIIs','SubControlNonIIs','SubControlInIIIs','SubControlNonIIIs','SubControlInFinals','SubControlNonFinals','aprovadosMFIII','reprovadosMFIII','aprovadosMFFinal','aprovadosMFII','reprovadosMFII','aprovadosMFI','reprovadosMFI','reprovadosMFFinal','matriculadosIAMF','matriculadosIAMFI','matriculadosIAF','matriculadosIAMFII','matriculadosIAMFIII','matriculadosIAMFFinal','unidadesOrganicas','funcionarios'));
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
