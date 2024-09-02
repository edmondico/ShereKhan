<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipusDoc;

class TipusDocSeeder extends Seeder
{
    public function run()
    {
        TipusDoc::factory()->count(10)->create();
    }
}
