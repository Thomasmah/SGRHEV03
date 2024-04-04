<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('bairro')->nullable();
            $table->string('zona')->nullable();
            $table->string('quarteirao')->nullable();
            $table->string('rua')->nullable();
            $table->string('casa')->nullable();  
            $table->unsignedBigInteger('idPessoa')->require();
            $table->foreign('idPessoa')->references('id')->on('pessoas')->onDelete('cascade');           
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enderecos');
    }
};
