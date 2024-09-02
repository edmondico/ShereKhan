<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentRiscTreballador;

class DocumentRiscTreballadorSeeder extends Seeder
{
    public function run()
    {
        DocumentRiscTreballador::factory()->count(10)->create();
    }
}
