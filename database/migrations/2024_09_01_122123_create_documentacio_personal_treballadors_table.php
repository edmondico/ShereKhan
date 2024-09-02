<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documentacio_personal_treballador', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_treballador')->constrained('treballadors')->onDelete('cascade');
            $table->string('nom_document');
            $table->date('data_expedicio')->nullable();
            $table->enum('tipus_document', ['identificacio', 'formacio', 'contracte', 'altre']);
            $table->text('descripcio')->nullable();
            $table->text('observacions')->nullable();
            $table->enum('estat', ['pendent', 'validat', 'rebutjat'])->default('pendent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentacio_personal_treballador');
    }
};
