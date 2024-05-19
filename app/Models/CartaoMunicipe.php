<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaoMunicipe extends Model
{
    
    use HasFactory;
    protected $table = 'cartao_municipes'; // Nome da tabela

    protected $fillable = [
        'idArquivo',
        'areaResidencia',
        'validadeCM',
        'idEndereco',
    ];
}
