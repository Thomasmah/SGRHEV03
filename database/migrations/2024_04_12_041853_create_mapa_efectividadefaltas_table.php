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
        Schema::create('mapa_efectividadefaltas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idMapaEfectividade');
            $table->integer('numeroAgente');
            $table->string('nomeCompleto');
            $table->string('eqt');
            $table->integer('faltasJustificadas');
            $table->integer('faltasInjustificadas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapa_efectividadefaltas');
    }
};
