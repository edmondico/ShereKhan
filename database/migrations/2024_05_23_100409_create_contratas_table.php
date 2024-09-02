<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contratas', function (Blueprint $table) {
            $table->id();
            $table->string('nom_fiscal');
            $table->string('nom_comercial');
            $table->string('direccio')->nullable();
            $table->string('mail')->nullable();
            $table->string('telefon')->nullable();
            $table->string('responsable')->nullable();
            $table->string('cif')->unique();
            $table->string('logo')->nullable();
            $table->string('color')->nullable();
            $table->text('descripcio_activitat')->nullable();
            $table->string('codi_postal')->nullable();
            $table->string('poblacion')->nullable();
            $table->string('provincia')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contratas');
    }
};
