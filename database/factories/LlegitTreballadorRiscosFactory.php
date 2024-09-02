<?php

namespace Database\Factories;

use App\Models\ObraDocumentRiscLloc;
use App\Models\Treballador;
use Illuminate\Database\Eloquent\Factories\Factory;

class LlegitTreballadorRiscosFactory extends Factory
{
    protected $model = \App\Models\LlegitTreballadorRiscos::class;

    public function definition()
    {
        return [
            'id_obra_document_risc_lloc' => ObraDocumentRiscLloc::factory(),
            'id_treballador' => Treballador::factory(),
            'estat' => $this->faker->randomElement(['read', 'unread']),
        ];
    }
}
