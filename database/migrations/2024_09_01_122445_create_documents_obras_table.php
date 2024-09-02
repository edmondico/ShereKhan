<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents_obras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra');
            $table->unsignedBigInteger('id_document');
            $table->unsignedBigInteger('id_treballador');
            $table->string('estat');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('id_obra')->references('id')->on('obras')->onDelete('cascade');
            $table->foreign('id_document')->references('id')->on('documents')->onDelete('cascade');
            $table->foreign('id_treballador')->references('id')->on('treballadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_obras');
    }
};
