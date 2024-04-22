<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeOrganica extends Model
{
    use HasFactory;
    protected $table = 'unidade_organicas'; // Nome da tabela

    protected $fillable = [
        'designacao',
        'descricao',
        'eqt',
        'decretoCriacao',
        'localidade',
        'telefone',
        'email',
        'nivelEnsino'
    ];
        // Relacionamento com a tabela Parentes
        public function funcionarios()
        {
            return $this->belongsTo(Funcionario::class);
        }
   
}
