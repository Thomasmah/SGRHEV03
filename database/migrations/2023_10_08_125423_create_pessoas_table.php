<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePessoasTable extends Migration
{
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nomeCompleto');
            $table->date('dataNascimento');
            //$table->enum('genero', ['feminino', 'masculino']);
            $table->string('genero');
            $table->string('grupoSanguineo')->nullable();
            $table->string('estadoCivil');
            $table->string('numeroBI', 14); 
            $table->date('validadeBI');
           $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}