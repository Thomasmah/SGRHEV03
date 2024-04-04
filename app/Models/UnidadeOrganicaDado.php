<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeOrganicaDado extends Model
{
    use HasFactory;
    protected $table = 'unidade_organicas'; // Nome da tabela

    protected $fillable = [
      'anoLectivo',
      'Trimestre',
      'numeroAlunos',
      'numeroAlunosFemenino',
      'alunosAprovados',
      'alunosAprovadosFemenino',
      'alunosReprovados',
      'alunosReprovadosFemenino',
      'alunosTranferidos',
      'alunosTranferidosFemenino',
      'alunosDesistentes',
      'alunosDesistentesFemenino',
       'idUnidadeOrganica',
    ];
  
}
