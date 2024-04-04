<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvaliacaoDesempenhoFuncionario extends Model
{
    use HasFactory;
    protected $table = 'avaliacao_desempenho_funcionarios'; // Nome da tabela

    protected $fillable = [ 
        'um',
        'dois',
        'tres',
        'quatro',
        'cinco',
        'seis',
        'total',
        'idAvaliador',
        'Request',
        'idFuncionario',
        'classificacao',
        'dataAvaliacao',
        'periodoAvaliacao',
        'estado',
        'idArquivo'
    ];



}
