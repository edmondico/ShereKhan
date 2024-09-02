<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsuariPermis;

class UsuariPermisSeeder extends Seeder
{
    public function run()
    {
        UsuariPermis::factory(10)->create();
    }
}
