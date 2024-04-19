<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    use HasFactory;
    protected $table = 'processos'; // Nome da tabela
    protected $fillable = [    
        'idFuncionario',
        'idFuncionarioSolicitante',
        'seccao',
        'categoria',
        'natureza',
        'Request',
        'periodo',
        'estado',
        'deferimento',
        'idArquivo',
        'ratificador',
        
        //Anexos, Dependencias Tipo Documentos e Outras Imformacoes para se efectivar um determinado processo 
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'idFuncionarioSolicitante');
    }
   
}
