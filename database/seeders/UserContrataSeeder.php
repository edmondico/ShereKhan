<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserContrata;

class UserContrataSeeder extends Seeder
{
    public function run()
    {
        UserContrata::factory()->count(10)->create();
    }
}
