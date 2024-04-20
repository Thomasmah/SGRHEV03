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
        Schema::create('fotos_unidade_organicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idArguivo')->nullable();
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
        Schema::dropIfExists('fotos_unidade_organicas');
    }
};
