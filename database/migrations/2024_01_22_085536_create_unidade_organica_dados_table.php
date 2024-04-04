<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('unidade_organica_dados', function (Blueprint $table) {
            $table->id();
            $table->string('anoLectivo')->nullable();
            $table->string('Trimestre')->nullable();
            $table->integer('numeroAlunos')->nullable();
            $table->integer('numeroAlunosFemenino')->nullable();
            $table->integer('alunosAprovados')->nullable();
            $table->integer('alunosAprovadosFemenino')->nullable();
            $table->integer('alunosReprovados')->nullable();
            $table->integer('alunosReprovadosFemenino')->nullable();
            $table->integer('alunosTranferidos')->nullable();
            $table->integer('alunosTranferidosFemenino')->nullable();
            $table->integer('alunosDesistentes')->nullable();
            $table->integer('alunosDesistentesFemenino')->nullable();
            $table->unsignedBigInteger('idUnidadeOrganica')->nullable();
            $table->foreign('idUnidadeOrganica')->references('id')->on('unidade_organicas')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidade_organica_dados');
    }
};
