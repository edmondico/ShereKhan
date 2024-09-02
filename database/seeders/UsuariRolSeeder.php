<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UsuariRol;

class UsuariRolSeeder extends Seeder
{
    public function run()
    {
        UsuariRol::factory(10)->create();
    }
}
