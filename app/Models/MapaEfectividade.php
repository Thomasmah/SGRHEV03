<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapaEfectividade extends Model
{
    use HasFactory;
    protected $table = 'mapa_efectividades'; // Nome da tabela

    protected $fillable = [
        'dataPeriodo',
        'estado',
    ];
}
