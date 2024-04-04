<?php

use App\Models\Cargo;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
$permissoes = Cargo::where('id', session()->only(['idCargo'])['idCargo'])->permissoes;

if ($agentes) {
//Continuar
}else{
  header('Location:/?error');
  exit();
}
?>