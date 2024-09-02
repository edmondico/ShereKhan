<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');  // Nombre del documento
            $table->string('descripcio')->nullable();  // Descripción del documento
            $table->string('siglas')->nullable();  // Siglas del documento
            $table->string('ruta')->nullable();  // Ruta del documento (si es necesario)
            $table->date('vigencia')->nullable();  // Fecha de vigencia
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
