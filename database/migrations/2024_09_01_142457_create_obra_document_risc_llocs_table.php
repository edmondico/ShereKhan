<?php

// Migración: create_obra_documents_risc_lloc_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obra_documents_risc_lloc', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra');
            $table->unsignedBigInteger('id_document_risc_lloc');
            $table->timestamps();

            $table->foreign('id_obra')->references('id')->on('obras')->onDelete('cascade');
            $table->foreign('id_document_risc_lloc')->references('id')->on('documents_riscos_treballadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obra_documents_risc_lloc');
    }
};
