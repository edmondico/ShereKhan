<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_contrata', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuari')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_contrata')->constrained('contratas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_contrata');
    }
};
