<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('llegit_treballador_riscos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra_document_risc_lloc');
            $table->unsignedBigInteger('id_treballador');
            $table->string('estat');
            $table->timestamps();

            $table->foreign('id_obra_document_risc_lloc')->references('id')->on('obra_documents_risc_lloc')->onDelete('cascade');
            $table->foreign('id_treballador')->references('id')->on('treballadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llegit_treballador_riscos');
    }
};
