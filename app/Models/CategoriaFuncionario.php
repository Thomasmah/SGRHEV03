<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoriaFuncionario extends Model
{
    use HasFactory;
    protected $table = 'categoria_funcionarios'; // Nome da tabela

    protected $fillable = [
        'categoria',
        'grau',
        'salariobase',
     
    ];
}
