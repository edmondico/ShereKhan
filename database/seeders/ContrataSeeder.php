<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrata;

class ContrataSeeder extends Seeder
{
    public function run()
    {
        Contrata::factory(10)->create();
    }
}
