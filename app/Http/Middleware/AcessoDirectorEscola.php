<?php

namespace App\Http\Middleware;

use App\Models\Cargo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AcessoDirectorEscola
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
            '3',
            '4',
            '5',
            '6',
            'Admin',
        ];
        if (in_array($nivelAcesso,$autorizados)) {
            return $next($request);
        }
       return response()->json(['error' => 'Acesso nao Autorizado']);
    }
}
