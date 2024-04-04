<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;
    protected $table = 'arquivos'; // Nome da tabela

    protected $fillable = [
            'titulo',
            'categoria',
            'descricao',
            'arquivo',
            'caminho',
            'idFuncionario'
    ];
}
