<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('parentes', function (Blueprint $table) {
            $table->id();
            $table->string('nomePai');
            $table->string('nomeMae'); 
            $table->unsignedBigInteger('idPessoa')->nullable();
            $table->foreign('idPessoa')->references('id')->on('pessoas')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parentes');
    }
};
