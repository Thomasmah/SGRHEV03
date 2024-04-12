<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapaEfectividadefalta extends Model
{
    use HasFactory;
    protected $table = 'mapa_efectividadefaltas'; // Nome da tabela

    protected $fillable = [
        'idMapaEfectividade',
        'numeroAgente',
        'nomeCompleto',
        'eqt',
        'faltasJustificadas',
        'faltasInjustificadas',
    ];
}
