<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seccao extends Model
{
    use HasFactory;
    protected $table = 'seccaos'; // Nome da tabela
    protected $fillable = [    
        'codNome',
       'designacao',
       'idChefe',
       'email',
        //Anexos, Dependencias Tipo Documentos e Outras Imformacoes para se efectivar um determinado processo 
    ];
}
