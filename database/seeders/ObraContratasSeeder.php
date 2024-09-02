<?php

namespace Database\Seeders;

use App\Models\ObraContratas;
use Illuminate\Database\Seeder;

class ObraContratasSeeder extends Seeder
{
    public function run(): void
    {
        ObraContratas::factory(10)->create();
    }
}

