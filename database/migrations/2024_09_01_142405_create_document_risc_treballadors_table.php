<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents_riscos_treballadors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_treballador');
            $table->unsignedBigInteger('id_risc');
            $table->string('nom_document');
            $table->date('vigencia');
            $table->date('data_expedicio');
            $table->text('observacions')->nullable(); // Cambiar a `text` para mayor capacidad
            $table->text('descripcio')->nullable(); // Cambiar a `text` para mayor capacidad
            $table->string('siglas');
            $table->string('estat');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_treballador')->references('id')->on('treballadors')->onDelete('cascade');
            $table->foreign('id_risc')->references('id')->on('riscos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_riscos_treballadors');
    }
};
