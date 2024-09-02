<?php

namespace Database\Factories;

use App\Models\DocumentsObra;
use App\Models\Obra;
use App\Models\Treballador;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentsObraFactory extends Factory
{
    protected $model = DocumentsObra::class;

    public function definition()
    {
        return [
            'id_obra' => Obra::factory(),
            'id_document' => $this->faker->randomDigitNotNull,
            'id_treballador' => Treballador::factory(),
            'estat' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
