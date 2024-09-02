<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('permis_rol', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_permis');
            $table->unsignedBigInteger('id_rol');
            $table->timestamps();

            $table->foreign('id_permis')->references('id')->on('permisos')->onDelete('cascade');
            $table->foreign('id_rol')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permis_rol');
    }
};
