<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionarios'; // Nome da tabela

    protected $fillable = [
        'numeroAgente',
        'dataAdmissao',
        'idSeccao',
        'iban',
        //'email',
        'idPessoa', 
        'idUnidadeOrganica',
        'idCargo', 
        'idCategoriaFuncionario',
        'numeroTelefone',
        'avaliacaoCorrente',
        'estado'
    ];
}
