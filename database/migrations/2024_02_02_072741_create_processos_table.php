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
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->integer('idFuncionario');
            $table->unsignedBigInteger('idFuncionarioSolicitante')->nullable();
            $table->string('seccao');
            $table->string('categoria');
            $table->string('natureza');
            $table->text('Request', 2000);   
            $table->string('periodo')->nullable();
            $table->string('estado')->nullable();
            $table->string('deferimento')->nullable();   
            $table->unsignedBigInteger('idArquivo')->nullable();
            $table->unsignedBigInteger('ratificador')->nullable();
            $table->foreign('idFuncionarioSolicitante')->references('id')->on('funcionarios')->onDelete('cascade'); 
            //Anexos, Dependencias Tipo Documentos e Outras Imformacoes para se efectivar um determinado processo 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
