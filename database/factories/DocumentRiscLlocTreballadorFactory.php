<?php

namespace Database\Factories;

use App\Models\DocumentRiscLlocTreballador;
use App\Models\DocumentRiscLloc;
use App\Models\Treballador;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentRiscLlocTreballadorFactory extends Factory
{
    protected $model = DocumentRiscLlocTreballador::class;

    public function definition()
    {
        return [
            'id_document_risc_lloc' => DocumentRiscLlocTreballador::factory(),
            'id_treballador' => Treballador::factory(),
        ];
    }
}
