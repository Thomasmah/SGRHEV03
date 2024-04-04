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
        Schema::create('unidade_organicas', function (Blueprint $table) {
            $table->id();
            $table->string('designacao');
            $table->string('descricao');
            $table->string('eqt')->nullable();
            $table->string('decretoCriacao')->nullable();
            $table->string('localidade')->nullable();
            $table->string('telefone')->nullable();
            $table->string('email')->nullable();
            //$table->integer('numeroAlunos')->nullable();
            //Ids e todas a Foreign Keys

            //$table->unsignedBigInteger('idDirector')->nullable();
            //$table->foreign('idDirector')->references('id')->on('funcionarios');
            //$table->unsignedBigInteger('idSubDirectorPedagogico')->nullable();
            //$table->foreign('idSubDirectorPedagogico')->references('id')->on('funcionarios');
            //$table->unsignedBigInteger('idSubDirectorAdministractivo')->nullable();
            //$table->foreign('idSubDirectorAdministractivo')->references('id')->on('funcionarios');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidade_organicas');
    }
};
