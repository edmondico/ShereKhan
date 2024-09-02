<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentRiscLlocTreballador;

class DocumentRiscLlocTreballadorSeeder extends Seeder
{
    public function run()
    {
        DocumentRiscLlocTreballador::factory(10)->create();
    }
}
