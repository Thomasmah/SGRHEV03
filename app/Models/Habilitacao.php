<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habilitacao extends Model
{
    use HasFactory;
    protected $table = 'habilitacaos'; // Nome da tabela

    protected $fillable = [
        'nivel',
        'curso',
        'instituicao',
        'notaFinal',
        'anoConclusao',
        'idArquivo',
        'status' ,
        'idFuncionario',
    ];
}
