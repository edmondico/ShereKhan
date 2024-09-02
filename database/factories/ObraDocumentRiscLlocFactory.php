<?php

namespace Database\Factories;

use App\Models\Obra;
use App\Models\DocumentRiscTreballador;
use Illuminate\Database\Eloquent\Factories\Factory;

class ObraDocumentRiscLlocFactory extends Factory
{
    protected $model = \App\Models\ObraDocumentRiscLloc::class;

    public function definition()
    {
        return [
            'id_obra' => Obra::factory(),
            'id_document_risc_lloc' => DocumentRiscTreballador::factory(),
        ];
    }
}
