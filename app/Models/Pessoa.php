<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas'; // Nome da tabela

    protected $fillable = [
        'nomeCompleto',
        'dataNascimento',
        'genero',
        'grupoSanguineo',
        'estadoCivil',
        'numeroBI',
        'validadeBI',
    ];

    // Relacionamento com a tabela Naturalidade
    public function naturalidade()
    {
        return $this->belongsTo(Naturalidade::class, 'idNaturalidade');
    }

    // Relacionamento com a tabela Parentes
    public function parentes()
    {
        return $this->belongsTo(Parente::class, 'idParentes');
    }
     // Relacionamento com a tabela Parentes
     public function funcionarios()
     {
         return $this->belongsTo(Funcionario::class, 'idPessoa');
     }

    // Relacionamento com a tabela Enderecos
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'idEndereco');
    }

}
