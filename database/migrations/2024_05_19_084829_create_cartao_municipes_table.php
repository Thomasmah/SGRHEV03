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
        Schema::create('cartao_municipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idArquivo')->nullable();
            $table->string('areaResidencia')->require();
            $table->date('validadeCM')->require();
            $table->unsignedBigInteger('idEndereco')->require();
            $table->foreign('idEndereco')->references('id')->on('enderecos')->onDelete('cascade');           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartao_municipes');
    }
};
