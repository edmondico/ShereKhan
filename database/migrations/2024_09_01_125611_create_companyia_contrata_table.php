<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('companyia_contrata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_companyia');
            $table->unsignedBigInteger('id_contrata');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_companyia')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('id_contrata')->references('id')->on('contratas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companyia_contrata');
    }
};
