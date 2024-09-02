<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentacioPersonalTreballador;

class DocumentacioPersonalTreballadorSeeder extends Seeder
{
    public function run()
    {
        DocumentacioPersonalTreballador::factory()->count(10)->create();
    }
}
