<?php

namespace App\Http\Middleware;

use App\Models\Cargo;
use App\Models\Funcionario;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcessoAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       
        $nivelAcesso = Cargo::where('id', session()->only(['funcionario'])['funcionario']->idCargo)->first()->permissoes;
        $autorizados = [
            'Admin',
        ];
        if (in_array($nivelAcesso,$autorizados)) {
            return $next($request);
        }
       return response()->json(['error' => 'Acesso nao Autorizado']);

    }
}
