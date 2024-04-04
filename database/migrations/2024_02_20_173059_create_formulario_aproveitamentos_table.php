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
        Schema::create('formulario_aproveitamentos', function (Blueprint $table) {
            $table->id();
            $table->string('anoLectivo')->nullable();
            $table->string('trimestre')->nullable();
            $table->integer('a11')->nullable();    $table->integer('a12')->nullable();             $table->integer('a13')->nullable();            $table->integer('a14')->nullable();            $table->integer('a15')->nullable();            $table->integer('a16')->nullable();            $table->integer('a17')->nullable();            $table->integer('a18')->nullable();            $table->integer('a19')->nullable();            $table->integer('a110')->nullable();            $table->integer('a111')->nullable();            $table->integer('a112')->nullable();            $table->integer('a113')->nullable();            $table->integer('a114')->nullable();
            $table->integer('a21')->nullable();    $table->integer('a22')->nullable();             $table->integer('a23')->nullable();            $table->integer('a24')->nullable();            $table->integer('a25')->nullable();            $table->integer('a26')->nullable();            $table->integer('a27')->nullable();            $table->integer('a28')->nullable();            $table->integer('a29')->nullable();            $table->integer('a210')->nullable();            $table->integer('a211')->nullable();            $table->integer('a212')->nullable();            $table->integer('a213')->nullable();            $table->integer('a214')->nullable();
            $table->integer('a31')->nullable();    $table->integer('a32')->nullable();             $table->integer('a33')->nullable();            $table->integer('a34')->nullable();            $table->integer('a35')->nullable();            $table->integer('a36')->nullable();            $table->integer('a37')->nullable();            $table->integer('a38')->nullable();            $table->integer('a39')->nullable();            $table->integer('a310')->nullable();            $table->integer('a311')->nullable();            $table->integer('a312')->nullable();            $table->integer('a313')->nullable();            $table->integer('a314')->nullable();
            $table->integer('a41')->nullable();    $table->integer('a42')->nullable();             $table->integer('a43')->nullable();            $table->integer('a44')->nullable();            $table->integer('a45')->nullable();            $table->integer('a46')->nullable();            $table->integer('a47')->nullable();            $table->integer('a48')->nullable();            $table->integer('a49')->nullable();            $table->integer('a410')->nullable();            $table->integer('a411')->nullable();            $table->integer('a412')->nullable();            $table->integer('a413')->nullable();            $table->integer('a414')->nullable();
            $table->integer('a51')->nullable();    $table->integer('a52')->nullable();             $table->integer('a53')->nullable();            $table->integer('a54')->nullable();            $table->integer('a55')->nullable();            $table->integer('a56')->nullable();            $table->integer('a57')->nullable();            $table->integer('a58')->nullable();            $table->integer('a59')->nullable();            $table->integer('a510')->nullable();            $table->integer('a511')->nullable();            $table->integer('a512')->nullable();            $table->integer('a513')->nullable();            $table->integer('a514')->nullable();
            $table->integer('a61')->nullable();    $table->integer('a62')->nullable();             $table->integer('a63')->nullable();            $table->integer('a64')->nullable();            $table->integer('a65')->nullable();            $table->integer('a66')->nullable();            $table->integer('a67')->nullable();            $table->integer('a68')->nullable();            $table->integer('a69')->nullable();            $table->integer('a610')->nullable();            $table->integer('a611')->nullable();            $table->integer('a612')->nullable();            $table->integer('a613')->nullable();            $table->integer('a614')->nullable();
            $table->integer('matriculadosIAMF')->nullable();
            $table->integer('matriculadosIAF')->nullable();
            $table->integer('matriculadosFAMF')->nullable();
            $table->integer('matriculadosFAF')->nullable();
            $table->integer('aprovadosMF')->nullable();
            $table->integer('aprovadosF')->nullable();
            $table->integer('reprovadosMF')->nullable();
            $table->integer('reprovadosF')->nullable();
            $table->integer('transferidosEMF')->nullable();
            $table->integer('transferidosEF')->nullable();
            $table->integer('transferidosSMF')->nullable();
            $table->integer('transferidosSF')->nullable();
            $table->integer('desistentesMF')->nullable();
            $table->integer('desistentesF')->nullable();
            $table->unsignedBigInteger('idDirector');  
            $table->foreign('idDirector')->references('id')->on('funcionarios');
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
        Schema::dropIfExists('formulario_aproveitamentos');
    }
};
