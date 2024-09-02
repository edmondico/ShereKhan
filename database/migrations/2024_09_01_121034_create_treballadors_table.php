<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('treballadors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_contrata')->constrained('contratas');
            $table->string('nom');
            $table->string('cognom');
            $table->string('dni')->unique();
            $table->string('mail')->nullable();
            $table->string('telefon')->nullable();
            $table->date('data_naixement')->nullable();
            $table->enum('genere', ['M', 'F'])->nullable();
            $table->foreignId('id_responsable')->nullable()->constrained('treballadors');
            $table->string('telefon_empresa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('treballadors');
    }
};
