<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocumentEmpresa;

class DocumentEmpresaSeeder extends Seeder
{
    public function run()
    {
        // Asegúrate de que el modelo `DocumentEmpresa` esté utilizando la tabla correcta.
        DocumentEmpresa::factory()->count(10)->create();
    }
}
