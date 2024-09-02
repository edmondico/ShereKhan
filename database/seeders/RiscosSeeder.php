<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Riscos;

class RiscosSeeder extends Seeder
{
    public function run()
    {
        Riscos::factory()->count(10)->create();
    }
}
