<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriaFuncionario extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Categoria Funcionario
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '13º',
            'salariobase' => '1123879',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '12º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '11º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '10º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '9º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '8º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '7º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '6º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '5º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '4º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '3º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '2º',
            'salariobase' => '90000',
        ]);
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Professor do Ensino Primário e Secundário',
            'grau' => '1º',
            'salariobase' => '90000',
        ]);

        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Técnico',
            'grau' => '3º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Técnico',
            'grau' => '2º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Técnico',
            'grau' => '1º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Auxiliar de Limpeza',
            'grau' => '3º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Auxiliar de Limpeza',
            'grau' => '2º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Auxiliar de Limpeza',
            'grau' => '1º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Operário Qualifiado',
            'grau' => '3º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Operário Qualifiado',
            'grau' => '2º',
            'salariobase' => '90000',
        ]); 
        DB::table('categoria_funcionarios')->insert([
            'categoria' => 'Operário Qualifiado',
            'grau' => '1º',
            'salariobase' => '90000',
        ]); 
    }
}
