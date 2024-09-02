<?php

// Migración: create_document_risc_lloc_treballadors_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('document_risc_lloc_treballador', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_document_risc_lloc');
            $table->unsignedBigInteger('id_treballador');
            $table->timestamps();

            // Cambiar la referencia a la tabla correcta
            $table->foreign('id_document_risc_lloc')->references('id')->on('documents_riscos_treballadors')->onDelete('cascade');
            $table->foreign('id_treballador')->references('id')->on('treballadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_risc_lloc_treballador');
    }
};
