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
        Schema::create('habilitacaos', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->string('instituicao');
            $table->string('status');
            $table->string('nivel')->nullable();
            $table->integer('notaFinal')->nullable();
            $table->string('anoConclusao')->nullable();
            $table->unsignedBigInteger('idFuncionario')->nullable();
            $table->unsignedBigInteger('idArquivo')->nullable();
            $table->foreign('idArquivo')->references('id')->on('arquivos')->onDelete('cascade'); 
       
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilitacaos');
    }
};
