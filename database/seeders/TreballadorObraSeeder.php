<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TreballadorObra;

class TreballadorObraSeeder extends Seeder
{
    public function run()
    {
        TreballadorObra::factory(10)->create();
    }
}
