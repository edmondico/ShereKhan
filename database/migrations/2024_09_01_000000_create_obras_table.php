<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('obras', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('descripcio')->nullable();
            $table->string('ubicacio')->nullable();
            $table->date('data_inici')->nullable();
            $table->date('data_fi')->nullable();
            $table->decimal('presupost', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obras');
    }
};
