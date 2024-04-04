<?php
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
$agenteLogado = Auth::user()->numeroAgente;
$agentes =  Funcionario::where('numeroAgente',$agenteLogado)->exists();
if ($agentes) {
//Continuar
}else{
  header('Location:/?error');
  exit();
}
?>