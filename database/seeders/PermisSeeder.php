<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permis;

class PermisSeeder extends Seeder
{
    public function run()
    {
        Permis::factory(10)->create();
    }
}
