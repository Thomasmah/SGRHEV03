<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosUnidadeOrganica extends Model
{
    use HasFactory;
    protected $table = 'fotos_unidade_organicas'; // Nome da tabela

    protected $fillable = [
    'idArguivo',
    'idUnidadeOrganica',
    ];

}
