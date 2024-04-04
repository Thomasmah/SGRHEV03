<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;
    protected $table = 'cargos'; // Nome da tabela

    protected $fillable = [
        'codNome',
        'designacao',
        'descrisao',
        'permissoes',
    ];
}
