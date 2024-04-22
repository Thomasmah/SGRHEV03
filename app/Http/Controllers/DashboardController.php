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
                $mapaAproveitamento = FormularioAproveitamento::where('anoLectivo', '2023/2024')->get();

                //dd(session()->only(['idFuncionario']));
                return view('/dashboard',compact('unidadesOrganicas','funcionarios'));
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
