<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Treballador;

class TreballadorSeeder extends Seeder
{
    public function run()
    {
        Treballador::factory(10)->create();
    }
}
