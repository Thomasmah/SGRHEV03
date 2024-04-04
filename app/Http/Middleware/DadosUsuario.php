<?php

namespace App\Http\Middleware;

use App\Models\Funcionario;
use App\Models\Pessoa;
use Closure;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DadosUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $funcionario = Funcionario::where('numeroAgente', Auth::user()->numeroAgente)->first();
            if ($funcionario == null) {
                return $next($request);
            }
            session(['funcionario' => $funcionario]);
            $pessoa = Pessoa::where('id', $funcionario->idPessoa )->first();
            view()->share([
                'funcionarioLog' => $funcionario,
                'pessoaLog' => $pessoa,
            ]);
        }else {
         //   dd('Nao Logado Lote ao Midleware Dados Usuario para Configuarar um alerta de usuario nao logado implementado no Layout Guest');
        }
        return $next($request);
       
       
     
    }
}

