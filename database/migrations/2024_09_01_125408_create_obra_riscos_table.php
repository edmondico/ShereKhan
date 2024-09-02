<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obra_riscos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_obra');
            $table->unsignedBigInteger('id_risc');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_obra')->references('id')->on('obras')->onDelete('cascade');
            $table->foreign('id_risc')->references('id')->on('riscos')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obra_riscos');
    }
};
