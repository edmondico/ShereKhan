<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ObraDocumentRiscLloc;

class ObraDocumentRiscLlocSeeder extends Seeder
{
    public function run()
    {
        ObraDocumentRiscLloc::factory()->count(10)->create();
    }
}
