<?php

namespace Database\Seeders;

use App\Models\Obra;
use Illuminate\Database\Seeder;

class ObraSeeder extends Seeder
{
    public function run(): void
    {
        Obra::factory(10)->create();
    }
}
