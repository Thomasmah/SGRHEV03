<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parente extends Model
{
    use HasFactory;
    protected $table = 'parentes'; // Nome da tabela

    protected $fillable = [
        'nomePai',
        'nomeMae',
        'idPessoa',
    ];
}
