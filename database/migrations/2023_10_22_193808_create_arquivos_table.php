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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('categoria');
            $table->text('descricao');
            $table->string('arquivo');
            $table->string('caminho');
            $table->unsignedBigInteger('idFuncionario')->require();
            $table->foreign('idFuncionario')->references('id')->on('funcionarios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};
