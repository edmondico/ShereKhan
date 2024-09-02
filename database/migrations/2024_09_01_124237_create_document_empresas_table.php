<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents_empresa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contrata');
            $table->string('nom_document');
            $table->string('vigencia')->nullable();
            $table->date('data_expedicio')->nullable();
            $table->string('siglas')->nullable();
            $table->string('estat')->nullable();
            $table->string('descripcio')->nullable();
            $table->string('observacions')->nullable();
            $table->timestamps();

            $table->foreign('id_contrata')->references('id')->on('contratas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents_empresa');
    }
};
