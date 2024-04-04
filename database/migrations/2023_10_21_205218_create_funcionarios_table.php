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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('numeroAgente');
            $table->date('dataAdmissao');
            $table->string('iban');
            $table->string('email');
            $table->string('estado')->nullable();
            $table->string('avaliacaoCorrente')->nullable();
            $table->string('numeroTelefone')->nullable();
            $table->unsignedBigInteger('idPessoa')->nullable();
            $table->foreign('idPessoa')->references('id')->on('pessoas')->onDelete('cascade'); 
            $table->unsignedBigInteger('idUnidadeOrganica')->nullable();
            $table->foreign('idUnidadeOrganica')->references('id')->on('unidade_organicas'); 
            $table->unsignedBigInteger('idSeccao')->nullable();
            $table->foreign('idSeccao')->references('id')->on('seccaos'); 
            $table->unsignedBigInteger('idCargo')->nullable();
            $table->foreign('idCargo')->references('id')->on('cargos');
            $table->unsignedBigInteger('idCategoriaFuncionario')->nullable();
            $table->foreign('idCategoriaFuncionario')->references('id')->on('categoria_funcionarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
