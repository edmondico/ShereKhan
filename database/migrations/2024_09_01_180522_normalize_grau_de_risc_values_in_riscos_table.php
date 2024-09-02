<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class NormalizeGrauDeRiscValuesInRiscosTable extends Migration
{
    public function up()
    {
        DB::table('riscos')
            ->where('grau_de_risc', 'alt')
            ->update(['grau_de_risc' => 'Alt']);

        DB::table('riscos')
            ->where('grau_de_risc', 'baix')
            ->update(['grau_de_risc' => 'Baix']);

        DB::table('riscos')
            ->where('grau_de_risc', 'mitja')
            ->update(['grau_de_risc' => 'Mitjà']);
    }

    public function down()
    {
        DB::table('riscos')
            ->where('grau_de_risc', 'Alt')
            ->update(['grau_de_risc' => 'alt']);

        DB::table('riscos')
            ->where('grau_de_risc', 'Baix')
            ->update(['grau_de_risc' => 'baix']);

        DB::table('riscos')
            ->where('grau_de_risc', 'Mitjà')
            ->update(['grau_de_risc' => 'mitja']);
    }
}
