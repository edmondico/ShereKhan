<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obra_contratas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra');
            $table->unsignedBigInteger('id_contrata');
            $table->timestamps();

            $table->foreign('id_obra')->references('id')->on('obras')->onDelete('cascade');
            $table->foreign('id_contrata')->references('id')->on('contratas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obra_contratas');
    }
};
