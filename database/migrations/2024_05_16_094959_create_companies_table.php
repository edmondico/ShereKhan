<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('ubicacio')->nullable();
            $table->text('descripcio')->nullable();
            $table->text('observacions')->nullable();
            $table->string('responsable')->nullable();
            $table->string('nif')->unique();
            $table->string('color')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
