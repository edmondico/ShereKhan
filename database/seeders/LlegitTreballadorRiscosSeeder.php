<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LlegitTreballadorRiscos;

class LlegitTreballadorRiscosSeeder extends Seeder
{
    public function run()
    {
        LlegitTreballadorRiscos::factory()->count(10)->create();
    }
}

