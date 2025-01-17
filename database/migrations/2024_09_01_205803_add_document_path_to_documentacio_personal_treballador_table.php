<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentacio_personal_treballador', function (Blueprint $table) {
            $table->string('document_path')->nullable()->after('estat'); // Añade el campo después de 'estat'
        });
    }

    public function down(): void
    {
        Schema::table('documentacio_personal_treballador', function (Blueprint $table) {
            $table->dropColumn('document_path');
        });
    }
};
