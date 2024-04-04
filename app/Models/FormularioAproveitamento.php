<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormularioAproveitamento extends Model
{
    protected $table = 'formulario_aproveitamentos'; // Nome da tabela

    protected $fillable = [
                    'a11',    'a12',    'a13',    'a14',    'a15',    'a16',    'a17',    'a18',    'a19',    'a110',    'a111',    'a112',    'a113',    'a114',
                    'a21',    'a22',    'a23',    'a24',    'a25',    'a26',    'a27',    'a28',    'a29',    'a210',    'a211',    'a212',    'a213',    'a214',
                    'a31',    'a32',    'a33',    'a34',    'a35',    'a36',    'a37',    'a38',    'a39',    'a310',    'a311',    'a312',    'a313',    'a314',
                    'a41',    'a42',    'a43',    'a44',    'a45',    'a46',    'a47',    'a48',    'a49',    'a410',    'a411',    'a412',    'a413',    'a414',
                    'a51',    'a52',    'a53',    'a54',    'a55',    'a56',    'a57',    'a58',    'a59',    'a510',    'a511',    'a512',    'a513',    'a514',
                    'a61',    'a62',    'a63',    'a64',    'a65',    'a66',    'a67',    'a68',    'a69',    'a610',    'a611',    'a612',    'a613',    'a614',
                    'matriculadosIAMF',
                    'matriculadosIAF',
                    'matriculadosFAMF',
                    'matriculadosFAF',
                    'aprovadosMF',
                    'aprovadosF',
                    'reprovadosMF',
                    'reprovadosF',
                    'transferidosEMF',
                    'transferidosEF',
                    'transferidosSMF',
                    'transferidosSF',
                    'desistentesMF',
                    'desistentesF',
                    'idDirector',
                    'idUnidadeOrganica',
                    'anoLectivo',
                    'trimestre',              
    ];
}
