<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObraContrata;

class ObraContrataSeeder extends Seeder
{
    public function run()
    {
        ObraContrata::factory()->count(10)->create();
    }
}
