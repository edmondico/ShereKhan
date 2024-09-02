<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObraRisc;

class ObraRiscSeeder extends Seeder
{
    public function run()
    {
        ObraRisc::factory(10)->create();
    }
}
