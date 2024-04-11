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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->text('categoria');
            $table->text('Request');
            $table->unsignedBigInteger('funcionario');
            $table->unsignedBigInteger('idArquivo')->nullable();
            $table->unsignedBigInteger('idFuncionario')->nullable();
            $table->foreign('idFuncionario')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
