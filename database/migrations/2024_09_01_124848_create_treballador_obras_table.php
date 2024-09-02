<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('treballadors_obra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra');
            $table->unsignedBigInteger('id_treballador');
            $table->string('funcion');
            $table->date('data_entrada_obra');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_obra')->references('id')->on('obras')->onDelete('cascade');
            $table->foreign('id_treballador')->references('id')->on('treballadors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treballadors_obra');
    }
};
