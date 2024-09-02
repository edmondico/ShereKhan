<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('usuari_permis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuari');
            $table->unsignedBigInteger('id_permis');
            $table->timestamps();

            $table->foreign('id_usuari')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_permis')->references('id')->on('permisos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuari_permis');
    }
};
