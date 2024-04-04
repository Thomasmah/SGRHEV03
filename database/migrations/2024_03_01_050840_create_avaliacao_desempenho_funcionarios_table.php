<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avaliacao_desempenho_funcionarios', function (Blueprint $table) {
            $table->id();
            //Caracteristicas
            $table->integer('um');
            $table->integer('dois');
            $table->integer('tres');
            $table->integer('quatro');
            $table->integer('cinco');
            $table->integer('seis');
            $table->integer('total');
            $table->text('classificacao');
            $table->text('Request');
            $table->string('idArquivo')->nullable();
            $table->string('periodoAvaliacao');
            $table->date('dataAvaliacao');
            $table->unsignedBigInteger('idFuncionario');
            $table->foreign('idAvaliador')->references('id')->on('funcionarios');
            $table->unsignedBigInteger('idAvaliador');
            $table->string('estado')->nullable();
           

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao_desempenho_funcionarios');
    }
};
