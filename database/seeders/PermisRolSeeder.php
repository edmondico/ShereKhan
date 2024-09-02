<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermisRol;

class PermisRolSeeder extends Seeder
{
    public function run()
    {
        PermisRol::factory(10)->create();
    }
}
