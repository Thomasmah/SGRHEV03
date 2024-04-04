<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BI extends Model
{
    use HasFactory;
    protected $table = 'b_i_s'; // Nome da tabela

    protected $fillable = [
       'numeroBI',
       'dataValidade',
       'idArquivo',
       'idFuncionario'
    ];
}
