<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riscos', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcio')->nullable();
            $table->boolean('epi')->default(false);
            $table->text('observacions')->nullable();
            $table->enum('grau_de_risc', ['baix', 'mitja', 'alt'])->nullable();
            $table->text('requisits')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riscos');
    }
};
