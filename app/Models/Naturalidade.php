<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Naturalidade extends Model
{
    use HasFactory;
    protected $table = 'naturalidades'; // Nome da tabela

    protected $fillable = [
        'provincia',
        'municipio',
        'idPessoa',
    ];
}
