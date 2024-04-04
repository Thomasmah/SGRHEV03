<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Seccoes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Registros
            //Unidades Organicas 
            DB::table('seccaos')->insert([
                'codNome' =>'Admin',
                'designacao' => 'Admin',
                'idChefe' => '',
                'email' => '',
            ]); 
            DB::table('seccaos')->insert([
                'codNome' =>'Secretaria',
                'designacao' => 'Secretaria',
                'idChefe' => '',
                'email' => '',
            ]); 
            DB::table('seccaos')->insert([
                'codNome' =>'RHPE',
                'designacao' => 'Recursos Humanos Planeamento e Estatística',
                'idChefe' => '',
                'email' => '',
            ]); 
            DB::table('seccaos')->insert([
                'codNome' =>'TIC',
                'designacao' => 'Tecnologias de Informação e Comunicação',
                'idChefe' => '',
                'email' => '',
            ]); 
            DB::table('seccaos')->insert([
                'codNome' =>'EdEnsino',
                'designacao' => 'Educação e Ensino',
                'idChefe' => '',
                'email' => '',
            ]); 
            DB::table('seccaos')->insert([
                'codNome' =>'Direcao',
                'designacao' => 'Direção Municipal',
                'idChefe' => '',
                'email' => '',
            ]); 
    }
}
