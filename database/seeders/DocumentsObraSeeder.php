<?php

namespace Database\Seeders;

use App\Models\DocumentsObra;
use Illuminate\Database\Seeder;

class DocumentsObraSeeder extends Seeder
{
    public function run(): void
    {
        DocumentsObra::factory(10)->create();
    }
}
