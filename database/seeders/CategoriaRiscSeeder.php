<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaRisc;

class CategoriaRiscSeeder extends Seeder
{
    public function run()
    {
        CategoriaRisc::factory(10)->create();
    }
}
