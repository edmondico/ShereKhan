<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tipus_docs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('descripcio')->nullable();
            $table->string('siglas')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipus_docs');
    }
};
